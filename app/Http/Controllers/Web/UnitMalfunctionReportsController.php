<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\Units;
use Vanguard\UnitMalfunction;
use Vanguard\MechanicTask;
use Vanguard\UnitMalfunctionReport;

use Auth;
use DB;

class UnitMalfunctionReportsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units =  Units::pluck('unit_number');
        
        $malfunctions = UnitMalfunction::get();
        
        return view('mechanic.reportmalfunction', compact('units', 'malfunctions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $report = new UnitMalfunctionReport;
        
        $report->unit = $request->unit;
        $report->mileage = $request->mileage;
        $report->added_by = Auth::User()->id;
        $report->comments = $request->comments;
        $report->save();
        
        $problems = $request->get('problem');
        
        //dd($problems);
        
        for ($i = 0; $i < count($request->problem); $i++) {
        $answers[] = [
            'pid' => $report->id,
            'task' => $request->problem[$i],
            'comments' => $request->pcomment[$i],
            'status' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'unit_id' => $report->unit,
        ];
        }
        MechanicTask::insert($answers);
        
        
        return redirect()->route('dashboard');
   
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
}
