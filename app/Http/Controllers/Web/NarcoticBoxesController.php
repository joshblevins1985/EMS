<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\NarcoticBoxes;
use Vanguard\Station;
use Vanguard\SealLog;
use Vanguard\NarcoticLog;
use Vanguard\BoxNotes;
use Vanguard\ControlledSubstances;
use Vanguard\VialLog;
use Vanguard\NarcoticWaste;
use Vanguard\NarcoticAudit;


use Auth;
use DB;




class NarcoticBoxesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boxes= NarcoticBoxes::with('BoxStations')->orderBy('box_number')->paginate('10');
        
        $station = Station::pluck('station', 'id');
        
        $stationlist = Station::where('status', 0)->get();
        
        $scount = NarcoticBoxes::
                select('station', DB::raw('count(*) as count')) 
                ->groupBy('station')
                ->get();
                
        $bcount = NarcoticBoxes::
                select('status', DB::raw('count(*) as count')) 
                ->groupBy('status')
                ->get();
        
        return view('logistics.boxlist', compact('boxes', 'station', 'stationlist' , 'scount', 'bcount'));
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
        
        $this->validate(request(),[
            'rfid' => 'required'
            
            
            ]);
        $box = NarcoticBoxes::create($request->all());
        
       
        
        $seal_log = new SealLog;
        
        $seal_log->seal = $request->seal;
        $seal_log->tamper_seal = $request->tamper_seal;
        
        $seal_log->new_seal = 'New Box';
        $seal_log->new_tamper_seal = 'New Box';
        
        $seal_log->box = $box->id;
        $seal_log->employee = Auth::User()->id;
        $seal_log->reason = '1';
        
        $seal_log->save();
        
        
        
        app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log( auth()->user()->present()->nameOrEmail .' created a new narcotic box.');
        
         return redirect()->route('narcoticbox.index');
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $box= NarcoticBoxes::find($id);
        
        $waste = NarcoticWaste::with('employee')->where('box', $box->id)->orderBy('created_at', 'desc')->get();
        
        $logs= NarcoticLog::with('Employees', 'EmployeesIn')->where('box', $id)->orderBy('created_at', 'desc')->paginate(2);
        
        $notes= BoxNotes::with('Employees')->where('box', $id)->orderBy('created_at', 'desc')->paginate(4,['*'], 'notes');
        
        $seals= SealLog::with('Employees')->where('box', $id)->orderBy('created_at', 'desc')->paginate('3',['*'], 'seals');
        
        $cs = ControlledSubstances::with('Medications')->where('status', 3)->orWhere('status', 5)->get()
            ->keyBy('id')
                    ->map(function ($cs){
                        return $cs->medications->trade_name.' - '.sprintf('%08d', $cs->id );
                    });
                    
        $medications = ControlledSubstances::where('location', $id)->get();
        
        
        
        return view('logistics.box', compact('box', 'logs', 'notes', 'seals', 'cs', 'medications', 'waste'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function log(Request $request)
    {
        $box = NarcoticBoxes::
                where('rfid', '$request->rfid')
                ->first();
                
        if(!$box){
            $box = 0;
            $response = "Box does not exist.";
            
            return view('timeclock.narcotic', compact('box', 'response'));
        }
        
        
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
    public function boxreport(Request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));
        $box = $request->box;
        
        $boxes = NarcoticBoxes::find($box);
        
        $notes = BoxNotes::
            where('box', $box)
            ->whereBetween('created_At',[$start, $end])
            ->get();
            
        $nlog = NarcoticLog::
            where('box', $box)
            ->whereBetween('created_At',[$start, $end])
            ->get();
            
        $vlog = VialLog::with('vial', 'vial.medications', 'stat')
            ->where('location', $box)
            ->whereBetween('created_At',[$start, $end])
            ->get();
            
        $waste = NarcoticWaste::where('box', $boxes->id)->get();
        
        $audit = NarcoticAudit::where('narcotic_box_id', $boxes->id)->get();
            

         return view('logistics.reports.boxreport', compact('boxes', 'start', 'end', 'notes', 'nlog', 'vlog', 'waste', 'audit'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function stationboxreport(Request $request)
    {
        $search_date = date('Y-m-d', strtotime($request->start));
        //dd($search_date);

        $station = Station::find($request->station);
        
        //$log = NarcoticBoxes::with(['NarcoticLog' => function ($q) use($request){  $q->whereDate('time_out', $request->start_submit); }], 'NarcoticLog.EmployeesIn', 'NarcoticLog.Employees')->where('station', $request->station)->get();
        
        $log = NarcoticLog::with(['NarcoticBox'=> function ($q) use($request){ $q->where('station', $request->station); $q->orderBy('box_number'); }], 'NarcoticBox.BoxStations')->whereDate('time_out', $search_date)->get();
            
        $start = $request->start;
        
         return view('logistics.reports.stationboxreport', compact('station', 'log', 'start'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function stationboxreportbydate(Request $request)
    {
        $station = Station::find($request->station);

        $log = NarcoticBoxes::whereHas('NarcoticLog', 
        function($q) use($request) 
        {$q->whereBetween('time_out', [$request->start_submit, $request->end_submit]);})
        ->with('NarcoticLog', 'NarcoticLog.Employees', 'NarcoticLog.EmployeesIn')
        ->where('station', $request->station)->get();
        
        //dd($log);
            
        $start = $request->start;
        
         return view('logistics.reports.stationboxreportbydate', compact('station', 'log', 'start'));
    }
    
    
    
        
}
