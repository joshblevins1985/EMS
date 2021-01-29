<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Notifications\WrongNarcoticSignIn;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
use Vanguard\NarcoticLog;
use Vanguard\NarcoticBoxes;
use Vanguard\Employee;
use Vanguard\Units;
use Vanguard\Station;
use Vanguard\User;
use Vanguard\ControlledSubstances;
use Mail;
use Vanguard\Mail\WrongSignIn;
use Vanguard\Mail\NarcoticNotificationOut;
use Vanguard\Mail\NarcoticNotificationIn;
use Illuminate\Http\Request;
use Vanguard\BoxNotes;
use Vanguard\NarcoticAudit;
use Vanguard\DrugBag;
use Vanguard\DrugBagSealLog;

class NarcoticLogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('timeclock.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $response = "" ;
      $drugBags = DrugBag::get();

        //dd($request->ip());
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
        //Check if box exists if not return message...

        //if box does not exist
        if (!$box) {
            $response = "Box does not exist.";


        } //if the box does exists
        else {
            //check if the box is not signed back in
            $narclog = NarcoticLog::
            with('Employees')
                ->where('box', $box->id)
                ->where('status', '2')
                ->first();
            // Get the medications that are associated with the narcotic box.

            $medications = ControlledSubstances::where('location', $box->id)->paginate(4,['*'], 'medications');

            $urx = ControlledSubstances::where('location', $box->id)->get()
                ->keyBy('id')
                ->map(function ($urx) {
                    return "V-". sprintf('%08d', $urx->id ) ." {$urx->medications->trade_name} - {$urx->lot_number}";
                });



        }

        if(!$box)
        {
            $boxinfo = "No box was found.";
        }else
        {
            $boxinfo = $box->box_number;
        }
 //Add the log to system log...
            app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Narcotic box Box # '. $boxinfo .' has been scanned.');

        return view('timeclock.narcotic', compact('units', 'box', 'response', 'narclog', 'medications', 'stations', 'urx', 'drugBags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check if rfid exisits.....

        $employee = Employee::where('rfid', $request->out_signature)->first();

        if($employee){


             // Checking out narcotic box...

        // Validate required fields...


        $this->validate($request, [
            'seal' => 'required',
            'tamper_seal' => 'required',
            'out_signature' => 'required|',
            'witness_out' => 'required'
        ]);

        // Strip all but first 10 characters of RFID fields
        $outsignature = substr($request->out_signature, 0, 10);
        $witnessout = substr($request->witness_out, 0, 10);


        $box = NarcoticBoxes::find($request->box);

        if($box->status == 2){
            return view('timeclock.index')->with('success', 'You have successfully signed out your narcotics.');
        }else{

           // dd('checking out');
          // Add data to data base...
        $narclog = new NarcoticLog;

        $narclog->box = $request->box;
        $narclog->time_out = $request->time_out;
        $narclog->out_signature = $outsignature;
        $narclog->witness_out = $witnessout;
        $narclog->seal = $request->seal;
        $narclog->tamper_seal = $request->tamper_seal;
        $narclog->status = $request->status;
        $narclog->drug_bag_id = $request->drugBag;
        $narclog->drug_bag_seal_out = $request->bag_seal;

        $narclog->save();

        //Update Narcotic Box Status and input to log.
        $box = NarcoticBoxes::find($request->box);
        $box->status = 2;
        $box->save();

        if($request->drugBag){
        $bag = DrugBag::find($request->drugBag);

        $bag->status = 2;
        $bag->save();


        $bagLog = new DrugBagSealLog;

        $bagLog->bag_id = $request->drugBag;
        $bagLog->user_id = $outsignature;
        $bagLog->status = 2;
        $bagLog->save();
    }

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


        if ($request->seal != $box['seal']) {

            //::to($users)->send(new NarcoticSealNotificationOut($narcoticbox, $box, $employeeout));

            //Create Audit Incident...

            $audit = new NarcoticAudit ;

            $audit->narcotic_box_id = $box['id'];
            $audit->narcotic_log_id = $narclog->id;
            $audit->employee_id = $employeeout['id'];
            $audit->audit_type = 1;
            $audit->incident = "The inputted seal number does not match the seal number on file.";
            $audit->status = 0;

            $audit->save();

            //add box note;

            $boxnote = new BoxNotes;

            $boxnote->added_by = 0;
            $boxnote->note = "The inputted seal number does not match the seal number on file.";
            $boxnote->box = $box['id'];

            $boxnote->save();

        }

        //Check if seal matches box seal notify administration / logistics if not...

        if ($request->tamper_seal != $box['tamper_seal']) {

            //Mail::to($users)->send(new NarcoticTamperSealNotificationOut($narcoticbox, $box, $employeeout));

             //Create Audit Incident...

            $audit = new NarcoticAudit ;

            $audit->narcotic_box_id = $box['id'];
            $audit->narcotic_log_id = $narclog->id;
            $audit->employee_id = $employeeout['id'];
            $audit->audit_type = 1;
            $audit->incident = "The inputted tamper seal number does not match the tamper seal number on file.";
            $audit->status = 0;

            $audit->save();

            //add box note;

            $boxnote = new BoxNotes;

            $boxnote->added_by = 0;
            $boxnote->note = "The inputted tamper seal number does not match the tamper seal number on file.";
            $boxnote->box = $box['id'];

            $boxnote->save();

        }


        if ($request->out_signature == $request->witness_out) {

          //  Mail::to($users)->send(new NarcoticTamperSealNotificationOut($narcoticbox, $box, $employeeout));

             //Create Audit Incident...

            $audit = new NarcoticAudit ;

            $audit->narcotic_box_id = $box['id'];
            $audit->narcotic_log_id = $narclog->id;
            $audit->employee_id = $employeeout['id'];
            $audit->audit_type = 4;
            $audit->incident = "This box has been signed out without the appropriate witness. Employee has witnessed their own sign out.";
            $audit->status = 0;

            $audit->save();

            //add box note;

            $boxnote = new BoxNotes;

            $boxnote->added_by = 0;
            $boxnote->note = $employeeout['first_name'].' '.$employeeout['last_name'].'  has signed out this box without the appropriate witness. Employee has witnessed their own sign in';

            $boxnote->box = $box['id'];

            $boxnote->save();

        }




        return view('timeclock.index')->with('success', 'You have successfully signed out your narcotics.');
        }


        }else{

           return view('timeclock.norfid');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::where('rfid', $request->out_signature)->first();

        if($employee){
            // Validate required fields...



        $this->validate($request, [
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
        $narclog->drug_bag_id = $request->drugBag;
        $narclog->drug_bag_seal_out = $request->bag_seal;

        $narclog->save();

        //Update Narcotic Box Status and input to log.
        $box = NarcoticBoxes::find($request->box);
        $box->status = 1;
        $box->save();

        if($request->drugBag){
        $bag = DrugBag::find($request->drugBag);

        $bag->status = 1;
        $bag->save();


        $bagLog = new DrugBagSealLog;

        $bagLog->bag_id = $request->drugBag;
        $bagLog->user_id = $insignature;
        $bagLog->status = 1;
        $bagLog->save();
    }



        // Build queries for mail notification of check out...
        $narcoticbox = NarcoticLog::find($id)->toArray();

        $box = NarcoticBoxes::find($narcoticbox['box'])->toArray();

        $employeeout = Employee::where('rfid', $narcoticbox['out_signature'])->firstOrFail()->toArray();
        $employeein = Employee::where('rfid', $narcoticbox['in_signature'])->firstOrFail()->toArray();

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

            //Create Audit Incident...

            $audit = new NarcoticAudit ;

            $audit->narcotic_box_id = $box['id'];
            $audit->narcotic_log_id = $narclog->id;
            $audit->employee_id = $employeeout['id'];
            $audit->audit_type = 4;
            $audit->incident = 'This narcotic box has been signed in by ' . $employeeout['first_name'] . ' ' . $employeeout['last_name'] . ' and signed back in by ' . $employeein['first_name'] . ' ' . $employeein['last_name'] . '.  This is a violation of company policy.';
            $audit->status = 0;


            $audit->save();

        }

         if ($request->seal != $box['seal']) {

            //Mail::to($users)->send(new NarcoticSealNotificationOut($narcoticbox, $box, $employeeout));

            //Create Audit Incident...

            $audit = new NarcoticAudit ;

            $audit->narcotic_box_id = $box['id'];
            $audit->narcotic_log_id = $narclog->id;
            $audit->employee_id = $employeeout['id'];
            $audit->audit_type = 1;
            $audit->incident = "The inputted seal number does not match the seal number on file.";
            $audit->status = 0;

            $audit->save();

            //add box note;

            $boxnote = new BoxNotes;

            $boxnote->added_by = 0;
            $boxnote->note = "The inputted seal number does not match the seal number on file.";
            $boxnote->box = $box['id'];

            $boxnote->save();



        }

        //Check if seal matches box seal notify administration / logistics if not...

        if ($request->tamper_seal != $box['tamper_seal']) {

            //Mail::to($users)->send(new NarcoticTamperSealNotificationOut($narcoticbox, $box, $employeeout));

             //Create Audit Incident...

            $audit = new NarcoticAudit ;

            $audit->narcotic_box_id = $box['id'];
            $audit->narcotic_log_id = $narclog->id;
            $audit->employee_id = $employeeout['id'];
            $audit->audit_type = 1;
            $audit->incident = "The inputted tamper seal number does not match the tamper seal number on file.";
            $audit->status = 0;

            $audit->save();

            //add box note;

            $boxnote = new BoxNotes;

            $boxnote->added_by = 0;
            $boxnote->note = "The inputted tamper seal number does not match the tamper seal number on file.";
            $boxnote->box = $box['id'];

            $boxnote->save();

        }

        if ($request->in_signature == $request->witness_in) {

          //  Mail::to($users)->send(new NarcoticTamperSealNotificationOut($narcoticbox, $box, $employeeout));

             //Create Audit Incident...

            $audit = new NarcoticAudit ;

            $audit->narcotic_box_id = $box['id'];
            $audit->narcotic_log_id = $narclog->id;
            $audit->employee_id = $employeeout['id'];
            $audit->audit_type = 4;
            $audit->incident = $employeein['first_name'].' '.$employeein['last_name'].'  has signed in this box without the appropriate witness. Employee has witnessed their own sign in.';
            $audit->status = 0;

            $audit->save();

            //add box note;

            $boxnote = new BoxNotes;

            $boxnote->added_by = 0;
            $boxnote->note = "This box has been signed out without the appropriate witness. Employee has witnessed their own sign out.";
            $boxnote->box = $box['id'];

        }

        if(!$box)
        {
            $boxinfo = "No box was found.";
        }else
        {
            $boxinfo = $box['box_number'];
        }
 //Add the log to system log...
            app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Narcotic box Box # '. $boxinfo .' has been scanned.');


        return view('timeclock.index')->with('success', 'You have successfully signed out your narcotics.');
        }else{

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        return view('timeclock.norfid');
    }

    public function narcoticStatus(Request $request)

    {

        $clientIP = request()->ip();



        $station = Station::where('narcotic_computer', $clientIP)->first();

        if($station){
            $station->nc_last_connection = date('Y-m-d H:i:s');
            $station->nc_status = 1;

            $station->save();


        }else{

        }



        return response()->json(['success'=>'Got Simple Ajax Request.']);

    }

}
