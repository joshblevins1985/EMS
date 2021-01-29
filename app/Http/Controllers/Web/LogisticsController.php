<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\NarcoticLog;
use Vanguard\Medications;
use Vanguard\NarcoticBoxes;
use Vanguard\ControlledSubstances;
use Vanguard\NarcoticWaste;
use Vanguard\Station;
use Vanguard\Units;
use Vanguard\Employee;
use Mail;
use Vanguard\Mail\WrongSignIn;
use Vanguard\Mail\NarcoticNotificationOut;
use Vanguard\Mail\NarcoticNotificationIn;
use Vanguard\BoxNotes;
use Vanguard\User;
use Vanguard\NarcoticAudit;

use Vanguard\Repositories\Permission\PermissionRepository;
use Vanguard\Repositories\Role\RoleRepository;

use Auth;
use DB;

class LogisticsController extends Controller
{
     public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->middleware('auth');
        
        $this->middleware('permission:logistics')->only('index', 'overview');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $narcoticlog= NarcoticLog::with('NarcoticBox', 'Employees')->orderBy('time_out')->get();

        $controlled = ControlledSubstances::orderBy('expiration', 'asc')->get();

        $boxes = NarcoticBoxes::orderBy('box_number', 'asc')->get();

        $rx = Medications::where('controlled', '1')->get()
            ->keyBy('id')
            ->map(function ($rx){
                return"{$rx->trade_name}  -  {$rx->brand_name}";
            });

        $nb = NarcoticBoxes::orderBy('box_number', 'asc')->get()
            ->keyBy('id')
            ->map(function ($nb){
                return"{$nb->box_number}";
            });

        $nb2 = NarcoticBoxes::orderBy('box_number', 'asc')->get()
            ->keyBy('id')
            ->map(function ($nb2){
                return"{$nb2->box_number}";
            });

        $cs = Medications::get();

        $stations = Station::where('status', 0)->get();

        $use = NarcoticWaste::with('employee')
            ->select('paramedic',DB::raw('count(*) as count'))
            ->groupby('paramedic')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();

        $useavg = $use->avg('count');

        $nw = NarcoticWaste::with(['vial' => function($query) 
    {
        $query->select('medication', DB::Raw('MONTH(created_at) month'),DB::raw('count(*) as use_count'));
        $query->groupBy('medication', 'month');
    }, 'vial.medications'])
        ->withCount(['vial'])
        ->get();
        
    foreach($nw as $n)
    {
            
        $n->month;
        $n->medication;
        $n->use_count; 
    }
        
        $waste = NarcoticWaste::with('boxinfo', 'vial', 'employee', 'vial.Medications')->where('status', '0')->get();


        /*
       $mcount = NarcoticWaste::with('vial', 'vial.medication')
               ->select('created_at', DB::raw('count(*) as count'), DB::raw('count(IF(vial.medication.id = 1,1,NULL)) Versed'), DB::raw('count(vial.medication = 2,1,NULL)) Morphine'), DB::raw('count(vial.medication = 3,1,NULL)) Ketamine'), DB::raw('count(vial.medication = 4,1,NULL)) Fentanyl') , DB::raw('count(vial.medication = 5,1,NULL)) Norcuron') )
               ->groupBy('vial.medication.id')
               ->get();
       */

        $mcount = ControlledSubstances::
        select('medication', DB::raw('count(*) as count'), DB::raw('count(IF(status = 3,1,NULL)) safe'), DB::raw('count(IF(status = 4,1,NULL)) box'), DB::raw('count(IF(status = 8,1,NULL)) destroyed') )
            ->groupBy('medication')
            ->get();
        return view('logistics.index', compact('narcoticlog', 'controlled', 'boxes', 'nb', 'rx', 'nb2', 'mcount', 'cs', 'stations', 'use', 'useavg', 'nw', 'waste'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function overview()
    {
        $narcoticlog= NarcoticLog::with('NarcoticBox', 'Employees')->orderBy('time_out', 'desc')->take(50)->get();

        $controlled = ControlledSubstances::orderBy('expiration', 'asc')->get();

         $boxes = NarcoticBoxes::orderBy('box_number')->get();
    
        $elogs = NarcoticLog::with('Employees', 'drugbaginfo')->where('status', 2)->orderBy('time_out', 'desc')->take(50)->get();
    
        


        $rx = Medications::where('controlled', '1')->get()
            ->keyBy('id')
            ->map(function ($rx){
                return"{$rx->trade_name}  -  {$rx->brand_name}";
            });

        $nb = NarcoticBoxes::orderBy('box_number', 'asc')->get()
            ->keyBy('id')
            ->map(function ($nb){
                return"{$nb->box_number}";
            });
            

        $nb2 = NarcoticBoxes::orderBy('box_number', 'asc')->get()
            ->keyBy('id')
            ->map(function ($nb2){
                return"{$nb2->box_number}";
            });
            
        $stations = Station::where('status', 0)->orderBy('station', 'asc')->get();
            

        $cs = Medications::get();

        $stations = Station::where('status', 0)->get();

        $use = NarcoticWaste::with('employee')
            ->select('paramedic',DB::raw('count(*) as count'))
            ->groupby('paramedic')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();

        $useavg = $use->avg('count');

        $nw = NarcoticWaste::with(['vial' => function($query) 
    {
        $query->select('medication', DB::Raw('MONTH(created_at) month'),DB::raw('count(*) as use_count'), DB::Raw('MONTH(created_at) monnum'));
        $query->groupBy('medication', 'month');
    }, 'vial.medications'])
        ->withCount(['vial'])
        ->get();
        
      
        
    foreach($nw as $n)
    {
            
        $n->month;
        $n->medication;
        $n->use_count; 
    }
        
        $waste = NarcoticWaste::with('boxinfo', 'vial', 'employee', 'vial.Medications')->where('status', '0')->get();


        /*
       $mcount = NarcoticWaste::with('vial', 'vial.medication')
               ->select('created_at', DB::raw('count(*) as count'), DB::raw('count(IF(vial.medication.id = 1,1,NULL)) Versed'), DB::raw('count(vial.medication = 2,1,NULL)) Morphine'), DB::raw('count(vial.medication = 3,1,NULL)) Ketamine'), DB::raw('count(vial.medication = 4,1,NULL)) Fentanyl') , DB::raw('count(vial.medication = 5,1,NULL)) Norcuron') )
               ->groupBy('vial.medication.id')
               ->get();
       */

        $mcount = ControlledSubstances::
        select('medication', DB::raw('count(*) as count'), DB::raw('count(IF(status = 3,1,NULL)) safe'), DB::raw('count(IF(status = 4,1,NULL)) box'), DB::raw('count(IF(status = 8,1,NULL)) destroyed') )
            ->groupBy('medication')
            ->get();
            
            
        $narcotic_audit = NarcoticAudit::where('status', '0')->with('employee', 'audits')->orderBy('created_at', 'desc')->take(50)->get();
        
        $month = time();
        for ($i = 1; $i <= 4; $i++) {
          $month = strtotime('last month', $month);
          $months[] = date("M", $month);
        }
        
        $months= json_encode($months);
        //dd(json_encode($months));
        
        $med_counts = NarcoticWaste::select(DB::Raw('MONTH(created_at) monname'))
        ->with(['vial'=> function($q){
            $q->select(DB::raw('count(IF(status = 1,1,NULL)) versed_count'),
            DB::raw('count(IF(status = 2,1,NULL)) ms_count'),
            DB::raw('count(IF(status = 3,1,NULL)) ketamine_count'));
           
            $q->groupBy('medication');
            
        }])->orderBy('monname', 'desc')->groupBy('monname')->get();
        
        return view('logistics.overview', compact('narcoticlog', 'controlled', 'boxes', 'nb', 'rx', 'nb2', 'mcount', 'cs', 'stations', 'use', 'useavg', 'nw', 'waste', 'elogs', 'narcotic_audit', 'stations', 'months', 'med_counts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function safereport(Request $request)
    {
        $med = $request->med;

        $medssafe = ControlledSubstances::where('medication', $med)->where('status', '3')->get();

        return view('logistics.reports.safereport', compact('medssafe'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mnbindex()
    {
        $narcoticboxes = NarcoticBoxes::orderBy('box_number')->get()
                    ->keyBy('rfid')
                    ->map(function ($narcoticboxes){
                        return"{$narcoticboxes->box_number}";
                    });
        
        return view('logistics.mnbindex', compact('narcoticboxes'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function mnbcreate(Request $request)
    {
        //check if rfid field is filled completed....
        $this->validate($request, [
            'rfid' => 'required',

        ]);
        // Get all active units for list...
        $units = Units::whereIn('type', [1,2,3])->orderBy('status', 'asc')->orderBy('unit_number', 'asc')->pluck('unit_number', 'id');
        // Get all active stations for list...
        $stations = Station::where('status', '0')->pluck('station', 'id');
        //Get scanned box data...
        $box = NarcoticBoxes::
        where('rfid', $request->rfid)
            ->orWhere('box_number', $request->rfid)
            ->first();
            
        // Get list of employees//
        
        $employees = Employee::where('rfid', '>', 0)->orderBy('last_name')->get()
                    ->keyBy('rfid')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
                    
        //Check if box exists if not return message...

        //if box does not exist
        if (!$box) {
            $response = "Box does not exist.";

            //Add the log to system log...
            app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Narcotic box RFID # '. $request->rfid.' has been scanned.');
        } //if the box does exists
        else {
            //check if the box is not signed back in
            $narclog = NarcoticLog::
            with('Employees')
                ->where('box', $box->id)
                ->where('status', '2')
                ->first();
            // Get the medications that are associated with the narcotic box.

            $medications = ControlledSubstances::where('location', $box->id)->paginate('5');

            $urx = ControlledSubstances::where('location', $box->id)->get()
                ->keyBy('id')
                ->map(function ($urx) {
                    return "V-". sprintf('%08d', $urx->id ) ." {$urx->medications->trade_name} - {$urx->lot_number}";
                });

            $response = 'Box Exists';

        }

    $edit= false;

        return view('logistics.mnbcreate', compact('units', 'box', 'response', 'narclog', 'medications', 'stations', 'urx', 'employees', 'edit'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function mnbstore(Request $request)
    {
        // Checking out narcotic box...

        // Validate required fields...


        $this->validate($request, [
            'unit' => 'required',
            'seal' => 'required',
            'tamper_seal' => 'required',
            'out_signature' => 'required',
            'witness_out' => 'required'
        ]);

        // Strip all but first 10 characters of RFID fields
        $outsignature = substr($request->out_signature, 0, 10);
        $witnessout = substr($request->witness_out, 0, 10);

        // Add data to data base...
        $narclog = new NarcoticLog;

        $narclog->box = $request->box;
        $narclog->time_out = $request->time_out;
        $narclog->out_signature = $outsignature;
        $narclog->witness_out = $witnessout;
        $narclog->seal = $request->seal;
        $narclog->tamper_seal = $request->tamper_seal;
        $narclog->unit = $request->unit;
        $narclog->status = $request->status;

        $narclog->save();

        //Update Narcotic Box Status and input to log.
        $box = NarcoticBoxes::find($request->box);
        $box->status = 2;
        $box->save();


        // Build queries for mail notification of check out...
        $narcoticbox = $narclog->toArray();

        $box = $box->toArray();

        $employeeout = Employee::where('rfid', $narclog->out_signature)->first()->toArray();

        $users = User::whereHas(
            'roles', function ($q) {
            $q->where('name', 'logistics');

        }
        )->get()->toArray();

        //Notify logistic users of box check out
        Mail::to($users)->send(new NarcoticNotificationOut($narcoticbox, $box, $employeeout));

        //Check if seal matches box seal notify administration / logistics if not...
        /*

        if ($request->seal != $box['seal']) {

            Mail::to($users)->send(new NarcoticSealNotificationOut($narcoticbox, $box, $employeeout));

        }

        //Check if seal matches box seal notify administration / logistics if not...

        if ($request->tamper_seal != $box['tamper_seal']) {

            Mail::to($users)->send(new NarcoticTamperSealNotificationOut($narcoticbox, $box, $employeeout));

        }
        */

       

        return redirect()->route('logistic.overview')->with('success', 'You have successfully signed out your narcotics.');


    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function mnbupdate(Request $request, $id)
    {
        // Validate required fields...


        $this->validate($request, [
            'unit' => 'required',
            'seal_in' => 'required',
            'tamper_seal_in' => 'required',
            'in_signature' => 'required',
            'witness_in' => 'required'
        ]);

        // Strip all but first 10 characters of RFID fields
        $insignature = substr($request->in_signature, 0, 10);
        $witnessin = substr($request->witness_in, 0, 10);

        // Add data to data base...
        $narclog = NarcoticLog::find($id);

        $narclog->box = $request->box;
        $narclog->in_signature = $insignature;
        $narclog->witness_in = $witnessin;
        $narclog->seal_in = $request->seal_in;
        $narclog->tamper_seal_in = $request->tamper_seal_in;
        $narclog->unit = $request->unit;
        $narclog->status = $request->status;
        $narclog->time_in = $request->time_in;

        $narclog->save();

        //Update Narcotic Box Status and input to log.
        $box = NarcoticBoxes::find($request->box);
        $box->status = 1;
        $box->save();



        // Build queries for mail notification of check out...
        $narcoticbox = NarcoticLog::find($id)->toArray();

        $box = NarcoticBoxes::find($narcoticbox['box'])->toArray();

        $employeeout = Employee::where('rfid', $narcoticbox['out_signature'])->first()->toArray();
        $employeein = Employee::where('rfid', $narcoticbox['in_signature'])->first()->toArray();

        $users = User::whereHas(
            'roles', function ($q) {
            $q->where('name', 'logistics');

        }
        )->get()->toArray();

        Mail::to($users)->send(new NarcoticNotificationIn($narcoticbox, $box, $employeeout, $employeein));

        if ($request->in_signature != $narclog->out_signature) {
            $users = User::whereHas(
                'roles', function ($q) {
                $q->where('name', 'logistics');
                $q->orWhere('name', 'company.admin');
            }
            )->get()->toArray();


            Mail::to($users)->send(new WrongSignIn($narcoticbox, $box, $employeeout));

            //Add Box Note for sign in
            $note = new BoxNotes;
            $note->added_by = '0';
            $note->note = 'This narcotic box has been signed in by ' . $employeeout['first_name'] . ' ' . $employeeout['last_name'] . ' and signed back in by ' . $employeein['first_name'] . ' ' . $employeein['last_name'] . '.  This is a violation of company policy.';
            $note->box = $box['id'];
            $note->save();

        }



        
        return redirect()->route('logistic.overview')->with('success', 'You have successfully signed out your narcotics.');
    }
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function wastetable()
    {
      $wastes = NarcoticWaste::with('vial', 'vial.Medications')->orderBy('created_at', 'DESC')->paginate(10);
      
      return view('logistics.wasteforms', compact('wastes'));
    }

}
