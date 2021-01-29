<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\ScholarshipApplication;
use Vanguard\ScholarshipOppurtunities;
use Vanguard\ScholarshipContract;
use Vanguard\ClassRoomEnrolledStudent;
use Vanguard\ClassRoom;


use Vanguard\Repositories\Permission\PermissionRepository;
use Vanguard\Repositories\Role\RoleRepository;
use DB;
use PDF;
use Carbon;

use Illuminate\Support\Facades\Storage;
use Mail;
use Vanguard\Mail\ScholarshipEntranceExamMail;
use Vanguard\Mail\ScholarshipAcceptancemail;

class ScholarshipController extends Controller
{
    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->middleware('auth');
        
       // $this->middleware('permission:logistics')->only('index', 'overview');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scholarships = ScholarshipOppurtunities::
            with(['applicants' => function ($q) {$q->orderBy('student');}])
          ->orderBy('start_date')->get();
          
          $students = ScholarshipApplication::where('status', 5)->get();
          
          $classes = ClassRoom::get();
        
        return view('education.scholarship', compact('scholarships', 'students', 'classes'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contract($id)
    {
        //Find the student info whom is signing the document
        $student = ScholarshipApplication::find($id);
        
        return view('scholarships.create', compact('student'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function entrance_mail($id)
    {
        //Find the student info whom is signing the document
        $so = ScholarshipOppurtunities::find($id);
        
        $apps = ScholarshipApplication::where('oppurtunity_id', $id)->where('status', 1)->where(function($q){ $q->where('reading', 0); $q->orWhere('math', 0); $q->orWhere('emt', 0); })->get()->toArray();
        
        $count =count($apps);
        
        Mail::to($apps)->send(new ScholarshipEntranceExamMail($id));
        
        if (Mail::failures()) {
        return back()->with('error', 'The email has failed to send.');
    }
        $apps = ScholarshipApplication::where('oppurtunity_id', $id)->where('status', 1)->where(function($q){ $q->where('reading', 0); $q->orWhere('math', 0); $q->orWhere('emt', 0); })->get();
        
        foreach($apps as $row){
            $u = ScholarshipApplication::find($row->id);
            
            $u->acceptance_letter = date('Y-m-d');
            
            $u->save();
        }
        
        return back()->with('success', 'You have sent an email to '.$count.' students.');
        
        
        return back()->with(['success', 'You have sent an email to '.$count.' studnets.']);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function acceptance_mail($id)
    {
        //Find the student info whom is signing the document
        $so = ScholarshipOppurtunities::find($id);
        
        $apps = ScholarshipApplication::where('oppurtunity_id', $id)->where('status', 2)->get();
        
        $count =count($apps);
        
        $apps->toArray();
        
        Mail::to($apps)->send(new ScholarshipAcceptancemail($id));
        
        if (Mail::failures()) {
        return back()->with('error', 'The email has failed to send.');
    }
        $apps = ScholarshipApplication::where('oppurtunity_id', $id)->where('status', 2)->get();
        
        foreach($apps as $row){
            $u = ScholarshipApplication::find($row->id);
            
            $u->acceptance_letter = date('Y-m-d');
            
            $u->save();
        }
        
        return back()->with('success', 'You have sent an email to '.$count.' students.');
    }
    
    /* *
     * Save Signature
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contract_signature(Request $request)
    {
        //Find the student info whom is signing the document
        $student = ScholarshipApplication::find($request->student);
        
        //create new signature
        $signature = new ScholarshipContract;
       
        //Get image from ajax, encode then decode the image to store//
        $data_uri = $request->signature;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        
        //store the decoded image//
        $storagePath = Storage::put('/signatures/'.$request->student.'_scholarship_signature.png', $decoded_image);
        $sig = 'signatures/'.$request->student.'_scholarship_signature.png';
        //store the file in the db//
        $signature->student_id = $request->student;
        $signature->signature = $sig;
        
        view()->share('sig', $sig);
        view()->share('student', $student);
        
        $pdf = PDF::loadView('scholarships.reports.contract', compact('sig', 'student'))->output();
        
        $name = $request->student.'scholarship_contract.pdf';
        
        $disk = Storage::disk('public');
        $disk->put($name, $pdf);
        
        $signature->file = $disk->path($name);
      
        
        
        
        $signature->save();

  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scholarships.create');
    }
    
    /**
     * Add Students to course.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addNewCourse(Request $request)
    {
        $scholarships = ScholarshipApplication::where('oppurtunity_id', $request->oid)->where('status', 2)->get();
        
        if($scholarships){
            foreach($scholarships as $row)
            {
            $enrollCheck = ClassRoomEnrolledStudent::where('classroom_id', $request->cid)->where('scholarship_id', $row->id)->first();
            
            if(!$enrollCheck){
            $enroll = new ClassRoomEnrolledStudent;  
            $enroll->classroom_id = $request->cid;
            $enroll->temp_name = $row->last_name.', '.$row->first_name;
            $enroll->scholarship_id = $row->id;
            $enroll->save();
            
            $row->status = 4;
            $row->save();
            }
            
            }
        }
        return back();
        
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
        //dd($request->status);
        
        $up = ScholarshipApplication::find($id);
        
        //dd($up);
        
        $up->status = $request->status;
        $up->reading = $request->reading;
        $up->emt = $request->emt;
        $up->math = $request->math;
        
        $up->save();
        
         return back()->with('success', 'You have updated the students status.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function scholarship_pdf ($id)
    {
        $scholarship = ScholarshipOppurtunities::
            with(['applicants' => function ($q){ $q->orderBy('student'); }])
            
          ->find($id);
        
       // return view('education.reports.scholarshipclass',compact('scholarship'));
        
       

       view()->share('scholarship',$scholarship);

      // pass view file
    
            $pdf = PDF::loadView('education.reports.scholarshipclass');
            // download pdf
            
            $course= $scholarship->school_name.'_'.Carbon::parse($scholarship->start_date)->format('m-d-Y');
            //return $pdf->download($course.'.pdf');
            return view('education.reports.scholarshipclass', compact('scholarship'));
    }
    
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function studentInfo ($id)
    {
        $scholarship = ScholarshipOppurtunities::
            with(['applicants' => function ($q){ $q->orderBy('last_name');  }])
            
          ->find($id);
        
       // return view('education.reports.scholarshipclass',compact('scholarship'));
        
       

       view()->share('scholarship',$scholarship);

      // pass view file
    
            $pdf = PDF::loadView('scholarships.reports.studentInfo');
            // download pdf
            
            $course= $scholarship->school_name.'_studentInfo_'.Carbon::parse($scholarship->start_date)->format('m-d-Y');
            return $pdf->download($course.'.pdf');
        
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roster ($id)
    {
        $scholarship = ScholarshipOppurtunities::
            with(['applicants' => function ($q){ $q->where('status', 2); $q->orderBy('student');  }])
            
          ->find($id);
        
       // return view('education.reports.scholarshipclass',compact('scholarship'));
        
       

       view()->share('scholarship',$scholarship);

      // pass view file
    
            $pdf = PDF::loadView('scholarships.reports.roster');
            // download pdf
            
            $course= $scholarship->school_name.'_roster_'.Carbon::parse($scholarship->start_date)->format('m-d-Y');
            return $pdf->download($course.'.pdf');

            //return view('scholarships.reports.roster', compact('course'));
    }

    public function ScholarshipIndex ($id)
    {
        $course = ScholarshipOppurtunities::
        with(['applicants' => function ($q){  $q->orderBy('student');  }])
        ->where('id', $id)
            ->find($id);

        $applicants = ScholarshipApplication::where('oppurtunity_id', $id)->get();
        //dd($course->applicants);
        return view('scholarships.scholarshipIndex', compact('course'));
    }

    public function studentUpdate (Request $request)
    {

        //dd($request->student);
        foreach ($request->student as $student) {

            $update = ScholarshipApplication::find($student);
            $update->status = $request->status;
            $update->save();

        }

        return back();
    }
}
