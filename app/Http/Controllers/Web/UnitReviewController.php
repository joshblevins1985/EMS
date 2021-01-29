<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\UnitReviews;
use Vanguard\Employee;
use Vanguard\Units;
use Vanguard\DrivingAssessmentQuestions;
use Carbon\Carbon;

use Auth;

class UnitReviewController extends Controller
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
        $reviews= UnitReviews::paginate(10);
        
        $units = Units::orderBy('unit_number')->where('status', 1)->get()
            ->keyBy('id')
            ->map(function ($unit){
                return"{$unit->unit_number}";
            });  
        
        return view('unitreviews.index', compact('reviews', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit= false;
        
        $employees = Employee::orderBy('last_name')->where('status', 5)->get()
            ->keyBy('user_id')
            ->map(function ($employee){
                return"{$employee->last_name}, {$employee->first_name}";
            });
            
        $units = Units::orderBy('unit_number')->where('status', 1)->get()
            ->keyBy('id')
            ->map(function ($unit){
                return"{$unit->unit_number}";
            });    
            
        return view('unitreviews.show', compact('edit', 'employees', 'units') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ur = new UnitReviews;
        
        $ur->date_requested = Carbon::now()->toDateTimeString() ;
        $ur->date_reviewed = Carbon::now()->toDateTimeString();
        $ur->unit_id = $request->unit_id;
        $ur->reason_reviewed = $request->reason_reviewed;
        $ur->added_by = Auth::user()->id;
        
        $ur->save();
        
        
        
        $reviews= UnitReviews::paginate(10);
        
        $units = Units::orderBy('unit_number')->where('status', 1)->get()
            ->keyBy('id')
            ->map(function ($unit){
                return"{$unit->unit_number}";
            });  
        
        return redirect('/unitreview/'.$ur->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit= false;
        
        $employees = Employee::orderBy('last_name')->where('status', 5)->get()
            ->keyBy('user_id')
            ->map(function ($employee){
                return"{$employee->last_name}, {$employee->first_name}";
            });
            
        
            
        //dd($employee);
        
        $units = Units::orderBy('unit_number')->where('status', 1)->get()
            ->keyBy('id')
            ->map(function ($unit){
                return"{$unit->unit_number}";
            });
            
        $questions= DrivingAssessmentQuestions::get();
        
        $review = UnitReviews::with('unit', 'driver_assessments', 'driver_assessments.employee')->find($id);
        
        return view('unitreviews.show', compact('edit','employees', 'units', 'questions', 'review'));
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
