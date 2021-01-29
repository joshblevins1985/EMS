<?php

namespace Vanguard\Http\Controllers\Web;

use Maatwebsite\Excel\Facades\Excel;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\DrivingAssessments;
use Vanguard\UnitReviews;
use Vanguard\Employee;
use Vanguard\Units;
use Vanguard\DrivingAssessmentQuestions;
use Vanguard\DrivingAssessmentAttachement;
use Vanguard\Export\CamraReviewExport;


use Auth;
use DateTime;
use PDF;
use Illuminate\Support\Facades\Storage;
use Carbon;
use DB;

class DrivingAssessmentsController extends Controller
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
        $noeval = Employee::whereDoesntHave('driver_eval')->where('driver', '>' , 0)->where('status', 5)->get();
        
        $eval = Employee::whereHas('driver_eval')->where('driver', '>' , 0)->where('status', 5)->get();
        
        $da = DrivingAssessments::with('attachments', 'admin', 'employee', 'employee.employeepositions')->where('performance_rating', '<', 80)->whereNull('printed')->get();
        
        return view('education.driver', compact('noeval', 'eval', 'da'));
    }

    public function excell()
    {
        return Excel::download(new CamraReviewExport, 'CameraReview'.'.xlsx');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $start = $request->date_review_submit . ' ' . $request->start_time;

        $end = $request->date_review_submit . ' ' . $request->end_time;

        //   dd($start);

        $available_score = DrivingAssessmentQuestions::sum('p');

        $start_date = new DateTime($start);
        $since_start = $start_date->diff(new DateTime($end));

        $total_score = $request->q1 + $request->q2 + $request->q3 + $request->q4 + $request->q5 + $request->q6 + $request->q7 + $request->q8 + $request->q9 + $request->q10 + $request->q11 +
            $request->q12 + $request->q13 + $request->q14 + $request->q15 + $request->q16 + $request->q17 + $request->q18 + $request->q19 + $request->q20 + $request->q21 + $request->q22 + $request->q23;

        //  dd($available_score);
        $score = $total_score / $available_score * 100;

        //dd($score);

        $driverass = new DrivingAssessments;

        $driverass->employee_id = $request->user_id;
        $driverass->date_of_evaluation = $request->date_submit;
        $driverass->evaluator = Auth::User()->id;
        $driverass->start_time = $start;
        $driverass->end_time = $end;
        $driverass->total_time = $since_start->i;
        $driverass->performance_rating = $score;
        $driverass->reason_for_evaluation = $request->reason;
        $driverass->comments = $request->comments;
        $driverass->response_type = $request->drive_type;
        $driverass->q1 = $request->q1;
        $driverass->q2 = $request->q2;
        $driverass->q3 = $request->q3;
        $driverass->q4 = $request->q4;
        $driverass->q5 = $request->q5;
        $driverass->q6 = $request->q6;
        $driverass->q7 = $request->q7;
        $driverass->q8 = $request->q8;
        $driverass->q9 = $request->q9;
        $driverass->q10 = $request->q10;
        $driverass->q11 = $request->q11;
        $driverass->q12 = $request->q12;
        $driverass->q13 = $request->q13;
        $driverass->q14 = $request->q14;
        $driverass->q15 = $request->q15;
        $driverass->q16 = $request->q16;
        $driverass->q17 = $request->q17;
        $driverass->q18 = $request->q18;
        $driverass->q19 = $request->q19;
        $driverass->q20 = $request->q20;
        $driverass->q21 = $request->q21;
        $driverass->q22 = $request->q22;
        $driverass->q23 = $request->q23;
        $driverass->pid = $request->pid;
        $driverass->unit = $request->unit;

        $driverass->save();
        
        //dd($request->photo);
        
        if ($request->hasFile('photo')) {

            $allowedfileExtension = ['jpg', 'png', 'PNG', 'pdf', 'PDF', 'avi', 'mp4'];

            $files = $request->file('photo');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension, $allowedfileExtension);

            //dd($check);

                if ($check) {
                    
                    $c= 0;
                        
                    foreach ($request->photo as $attachment) {
                        ++$c;
                        $filename= $driverass->id.'_'.$request->date_submit.'_'.$c.'.'.$extension;
                        
                        //dd($filename); 
                        
                        $filename = $attachment->storeAs('driving_assessment', $filename );

                        $attachment = new DrivingAssessmentAttachement;
                        $attachment->assessment_id = $driverass->id;
                        $attachment->file = $filename;
                        $attachment->save();


                    }

                    return redirect()->back();

                } else {

                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload PNG, png , jpg.</div>';

                }

            }

        }
            
   
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $da = DrivingAssessments::with('attachments', 'admin', 'employee', 'employee.employeepositions')->find($id);
        $dq = DrivingAssessmentQuestions::get();
    
            
        return view('unitreviews.assessment_show', compact('da', 'dq'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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
    public function dapdf($id)
    {
        $da = DrivingAssessments::with('attachments', 'admin', 'employee', 'employee.employeepositions')->find($id);
        $dq = DrivingAssessmentQuestions::get();
    
      view()->share('da',$da);
      view()->share('dq',$dq);
        
    	// pass view file
            $pdf = PDF::loadView('unitreviews.report');
            // download pdf
            return $pdf->download('driver_assessment.pdf');
            
        return redirect()->back();


    }
    public function getVideo(Video $video)
{
    $name = $video->name;
    $fileContents = Storage::disk('local')->get("{$video}");
    $response = Response::make($fileContents, 200);
    $response->header('Content-Type', "video/mp4");
    return $response;
}

    /* *
     * Save Signature
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveSignature(Request $request)
    {
        //Find Assessment in DB//
        $signature = DrivingAssessments::find($request->assid);
       
        //Get image from ajax, encode then decode the image to store//
        $data_uri = $request->signature;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        
        //store the decoded image//
        $storagePath = Storage::put('/signatures/'.$request->assid.'_driver_signature.png', $decoded_image);
        
        //store the file in the db//
        $signature->signature = 'signatures/'.$request->assid.'_driver_signature.png';
        $signature->date_signed = Carbon::now();
        $signature->save();

  
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dapdfall()
    {
        $da = DrivingAssessments::with('attachments', 'admin', 'employee', 'employee.employeepositions')->where('performance_rating', '<', 80)->whereNull('printed')->get();
        foreach($da as $row)
            {
                $dau = DrivingAssessments::find($row->id);
                
                $dau->printed = 1;
                
                $dau->save();
            }
        $dq = DrivingAssessmentQuestions::get();
    
      view()->share('da',$da);
      view()->share('dq',$dq);
        
    	// pass view file
            $pdf = PDF::loadView('unitreviews.reportall');
            // download pdf
            return $pdf->download('driver_assessment_all.pdf');
            
            
            
        return redirect()->back();


    }
    
    public function daweekly() 
    {
        $da = DrivingAssessments::select(DB::raw('WEEK(date_of_evaluation) monname'), DB::raw('SUM(total_time) time'))->groupBy('monname')->get() ; 
        
        $employee_count = DrivingAssessments::select(DB::raw('count(*) count'), 'employee_id', DB::raw('avg(performance_rating) score'))->orderBy('score')->groupBy('employee_id')->take(5)->get();
        
        //dd($employee_count->pluck('Employee.last_name'));
        
        $lastname = $employee_count->map(function ($employee_count) {
                                        return"{$employee_count->Employee->first_name} {$employee_count->Employee->last_name}";
                                    });
                                    
      $da_bad = DrivingAssessments::where('performance_rating', '<', 80)->get();
        
        return view('unitreviews.reports.weekly', compact('da', 'employee_count', 'lastname', 'da_bad'));
    }

}
