<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\BadRunSheet;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\Attendance;
use Vanguard\schedule;
use Vanguard\Employee;
use Vanguard\AttendanceOccurance;
use Vanguard\Protocols;
use Vanguard\QaQi;
use Vanguard\EmployeeEncounters;
use Vanguard\Station;
use Vanguard\User;
use Vanguard\QaDefficiencies;

use Mail;
use Vanguard\Mail\NewEncounter;
use Vanguard\Mail\EmployeeResponse;
use Vanguard\Mail\GoodQANotification;
use Vanguard\Mail\DeficientQANotification;

use Auth;
use DB;
use PDF;

class QaQiController extends Controller
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
    public function index(Request $request)
    {
        $employees = Employee::orderBy('last_name')->get()
            ->keyBy('user_id')
            ->map(function ($employee){
                return"{$employee->last_name}, {$employee->first_name}";
            });

        $protocols = Protocols::orderBy('section', 'number')->get()
            ->keyBy('id')
            ->map(function ($protocol){
                return"{$protocol->section}-{$protocol->number}-{$protocol->region} {$protocol->title}";
            });
        $name= $request->name;
        
        $qa= QaQi::with('protocols', 'employee')->where('employee_id', 'like', '%'.$name.'%')->orderBy('id', 'desc')->paginate('10');

        return view('education.qaqiindex', compact('employees', 'protocols', 'qa'));
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

        $protocols = Protocols::orderBy('section', 'number')->get()
            ->keyBy('id')
            ->map(function ($protocol){
                return"{$protocol->section}-{$protocol->number}-{$protocol->region} {$protocol->title}";
            });
            
                           

        

        return view('education.qaqicreate', compact('employees', 'protocols', 'edit'));
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
            'date' => 'required',
            'employee_id'=> 'required',
            'location' => 'required',
            'grade' => 'required',
            'comments' => 'required',

        ]);
        
        $percent = $request->q1 + $request->q2 + $request->q3 + $request->q4 + $request->q5 + $request->q6 + $request->q7 + $request->q8 + $request->q9 + $request->q10;
        
        $percent = $percent / 150;
        
        $percent = round($percent * 100);
        
        $percent = $percent - $request->minus;

        $qa = new QaQi;

        $qa->date = $request->date;
        $qa->employee_id = $request->employee_id;
        $qa->location = $request->location;
        $qa->protocol = $request->protocol;
        $qa->grade = $request->grade;
        $qa->comments = $request->comments;
        $qa->added_by = Auth::User()->id;
        $qa->q1 = $request->q1;
        $qa->q2 = $request->q2;
        $qa->q3 = $request->q3;
        $qa->q4 = $request->q4;
        $qa->q5 = $request->q5;
        $qa->q6 = $request->q6;
        $qa->q7 = $request->q7;
        $qa->q8 = $request->q8;
        $qa->q9 = $request->q9;
        $qa->q10 = $request->q10;
        $qa->percent = $percent;
 
       $qa->save();
       
        $defficiencies = $request->get('deficiencies');
        

        if(!$defficiencies){
            dd($request->get('deficiencies'));
        }else{
        for ($idx = 0; $idx < count($defficiencies); $idx++)
        {
            $values = new QaDefficiencies();
            $values->pid = $qa->id;
            $values->defficiency= $defficiencies[$idx];

            $values->save();
        }
        }
        
  

      

       $deficiencies = QaDefficiencies::where('pid', $qa->id)->get();
       
       $deficiencies->toArray();

        
        
        if ($request->hasFile('pdf')) {
           // dd('has file');

            $allowedfileExtension = ['jpg', 'png', 'PNG', 'pdf', 'PDF'];

            $files = $request->file('pdf');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension, $allowedfileExtension);

//dd($check);

                if ($check) {


                    foreach ($request->pdf as $attachment) {


                        $filename = $attachment->storeAs('qaqi', $qa->id . '.pdf');
                        
                         
                        $qa->file = $filename;
                        
                        $qa->save();


                    }


                } else {

                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload PNG, png , jpg.</div>';

                }

            }

        }
        
        $employee = Employee::where('user_id', $qa->employee_id)->first()->toArray();
        

        if(!$qa){

        }elseif($qa->grade == 1)
        {
        
                $defficiency = QaDefficiencies::where('pid', $qa->id)->get();
              
              view()->share('qa',$qa);
              view()->share('defficiency',$defficiency);
              
              // pass view file
            $pdf = PDF::loadView('education.qapdf')->setPaper('a4');
                
                $qa= QaQi::with('protocols', 'employee','employee.employeepositions', 'addedby')->orderBy('date')->find($qa->id)->toArray();
                
                
                Mail::send('emails.qa.goodqanotification', $qa, function($message) use($pdf, $qa, $employee, $request)
                {
                   $message->to($employee['email'])->subject('Satisfactory QA/QI Report');
                   
                   $message->attachData($pdf->output(), 'qaqi_report.pdf');
                   if($request->hasFile('pdf'))
                   {
                       $message->attach('https://peasi.app/storage/app/qaqi/'.$qa['id'].'.pdf');
                   }
                });

            //$qa->toArray();

           // Mail::to($employee['email'])->send(new GoodQANotification($qa));

        }elseif($qa->grade == 2){

             $defficiency = QaDefficiencies::where('pid', $qa->id)->get();
              
              view()->share('qa',$qa);
              view()->share('defficiency',$defficiency);
              
              // pass view file
            $pdf = PDF::loadView('education.qapdf')->setPaper('a4');
                
                $qa= QaQi::with('protocols', 'employee','employee.employeepositions', 'addedby')->orderBy('date')->find($qa->id)->toArray();
                
                $deficiencies = $defficiency->toArray();
                
                Mail::send('emails.qa.deficientqanotification', $qa, function($message) use($pdf, $qa, $employee, $deficiencies)
                {
                   $message->to($employee['email'])->subject('Satisfactory QA/QI Report');
                   
                   $message->attachData($pdf->output(), 'qaqi_report.pdf');
                });
            
            //$qa->toArray();

           // Mail::to($employee['email'])->send(new DeficientQANotification($qa, $deficiencies));
            
            $encounter = new EmployeeEncounters;

                $encounter->doi = $request->date;
                $encounter->user_id = $request->employee_id;
                $encounter->encounter_type = 1;
                $encounter->department =  2;
                $encounter->policy = 14;
                $encounter->follow_up = 2;
                $encounter->fu_date = date('Y-m-d', strtotime('+ 1 week'));
                $encounter->incident_report = "Employees' patient care report was reviewed and found to be insuffient in treatment or documentation. $request->comments";
                $encounter->plan = "Review of random patient care reports for next 30 days";
                $encounter->associated = $request->associated;
                $encounter->added_by = Auth::User()->id;
                $encounter->status = 4;

                $encounter->save();

        }

        if(!$request->eresponse)
        {

        }elseif($request->eresponse == 2){
            $encounter = new EmployeeEncounters;

            $encounter->doi = $request->date;
            $encounter->user_id = $request->employee_id;
            $encounter->encounter_type = 1;
            $encounter->department =  2;
            $encounter->policy = 14;
            $encounter->follow_up = 2;
            $encounter->fu_date = date('Y-m-d', strtotime('+ 1 week'));
            $encounter->incident_report = $request->comments;
            $encounter->plan = "Review of random patient care reports for next 30 days";
            $encounter->associated = $request->associated;
            $encounter->added_by = Auth::User()->id;
            $encounter->status = 2;

            $encounter->save();

            $notification = EmployeeEncounters::find($encounter->id)->toArray();



            $users = User::whereHas(
                'roles', function($q){
                $q->where('name', 'company.compliance');
                $q->orWhere('name', 'company.admin');
                $q->orWhere('name', 'company.training');
                $q->orWhere('id', 450);
            }
            )->get()->toArray();

            Mail::to($users)->send(new NewEncounter($notification, $employee));

            Mail::to($employee['email'])->send(new EmployeeResponse($notification, $employee));
        }
        
        

        return redirect()->route('qaqi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        

        $qa= QaQi::with('protocols', 'employee','employee.employeepositions')->orderBy('date')->find($id);
        
        $defficiency = QaDefficiencies::where('pid', $id)->get();

        return view('education.qaqishow', compact('qa', 'defficiency'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function qapdf($id)
    {
        $qa= QaQi::with('protocols', 'employee','employee.employeepositions', 'addedby')->orderBy('date')->find($id);
        
        $defficiency = QaDefficiencies::where('pid', $id)->get();
      
      view()->share('qa',$qa);
      view()->share('defficiency',$defficiency);
        
    	// pass view file
            $pdf = PDF::loadView('education.qapdf')->setPaper('a4');
            // download pdf
            return $pdf->download($qa->employee->first_name.'_'.$qa->employee->first_name.'_'.$qa->id.'.pdf');
            
        return view('education.qaqishow', compact('qa', 'defficiency'));


    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit= true;
        $qa = QaQi::find($id);
        $employees = Employee::orderBy('last_name')->get()
            ->keyBy('user_id')
            ->map(function ($employee){
                return"{$employee->last_name}, {$employee->first_name}";
            });

        $protocols = Protocols::orderBy('section', 'number')->get()
            ->keyBy('id')
            ->map(function ($protocol){
                return"{$protocol->section}-{$protocol->number}-{$protocol->region} {$protocol->title}";
            });

        

        return view('education.qaqiedit', compact('employees', 'protocols', 'qa', 'edit'));
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
        $percent = $request->q1 + $request->q2 + $request->q3 + $request->q4 + $request->q5 + $request->q6 + $request->q7 + $request->q8 + $request->q9 + $request->q10;
        
        $percent = $percent / 150;
        
        $percent = round($percent * 100);
        
        $qa = QaQi::find($id);

        $qa->date = $request->date;
        $qa->employee_id = $request->employee_id;
        $qa->location = $request->location;
        $qa->protocol = $request->protocol;
        $qa->grade = $request->grade;
        $qa->comments = $request->comments;
        $qa->added_by = Auth::User()->id;
        $qa->q1 = $request->q1;
        $qa->q2 = $request->q2;
        $qa->q3 = $request->q3;
        $qa->q4 = $request->q4;
        $qa->q5 = $request->q5;
        $qa->q6 = $request->q6;
        $qa->q7 = $request->q7;
        $qa->q8 = $request->q8;
        $qa->q9 = $request->q9;
        $qa->q10 = $request->q10;
        $qa->percent = $percent;

       $qa->save();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function acknowledge(Request $request, $id)
    {
        $qa = QaQi::find($id);

        $qa->acknowledged = Auth::User()->id;
        $qa->acknowledged_date = date('Y-m-d', strtotime('now'));
        
        $qa->save();
        
        return redirect('/qaqi/'.$id);
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createreport()
    {
        

        return view('education.qacreatereport');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {
        $start = $request->start_submit;
        $end = $request->end_submit;
        
        $qa_count = QaQi::whereBetween('created_at', [$start, $end])->select('grade',  DB::raw('count(*) as count'))
        ->orderBy('grade')
        ->groupBy('grade')    
        ->get();
        
        $qas = Employee::with(['qa' => function ($query) use ($start, $end){ $query->whereBetween('created_at', [$start, $end]); }], 'qa.deficiencies')->whereHas('qa', function ($query) use ($start, $end) {
    $query->whereBetween('created_at', [$start, $end]);
})->get();

        
        return view('education.qareport', compact('start', 'end', 'qa_count', 'qas'));
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reportpdf($start, $end)
    {

        
        $qa_count = QaQi::whereBetween('created_at', [$start, $end])->select('grade',  DB::raw('count(*) as count'))
        ->whereBetween('created_at', [$start, $end])
        ->orderBy('grade')
        ->groupBy('grade')    
        ->get();
        
        $qas = Employee::with(['qa' => function ($query) use ($start, $end){ $query->whereBetween('created_at', [$start, $end]); }], 'qa.deficiencies')->whereHas('qa', function ($query) use ($start, $end) {
    $query->whereBetween('created_at', [$start, $end]);
})->get();

      view()->share('start',$start);
      view()->share('end' ,$end);
      view()->share('qa_count',$qa_count);
      view()->share('qas',$qas);
        
    	// pass view file
    
            $pdf = PDF::loadView('education.qareportpdf');
            // download pdf
            return $pdf->download('qareport.pdf');
            
        // return view('education.qareport');


    }

    public function reportmgrpdf($start, $end)
    {
        $regionals = Station::where('status', 0)->groupBy('regional_manager')->orderby('regional_manager')->get();
        $managers = Station:: whereNotIn('manager', [804, 986, 450, 942, 549])->where('status', 0)->groupBy('manager')->get();

        $concerns = QaQi::whereBetween('created_at', [$start, $end])->where('percent', '<', 80)->groupBy('employee_id')
            ->select('*',  DB::raw('count(*) as count'))
            ->selectRaw('count(case when percent >= 70 and percent <= 79 then 1 end) as step1')
            ->selectRaw('count(case when percent >= 60 and percent <= 69 then 1 end) as step2')
            ->selectRaw('count(case when percent >= 50 and percent <= 59 then 1 end) as step3')
            ->selectRaw('count(case when percent <= 49  then 1 end) as step4')
            ->get();

        $brs = Station::where('status', 0)->orderBy('station_id')->get();

        view()->share('start',$start);
        view()->share('end' ,$end);
        view()->share('regionals', $regionals);
        view()->share('managers', $managers);
        view()->share('concerns', $concerns);
        view()->share('brs', $brs);

        // pass view file

       // $pdf = PDF::loadView('education.qamgrreportpdf');
        // download pdf
        //return $pdf->download('qamgrreport.pdf');

         return view('education.qamgrreportpdf');

        $qas = Employee::with(['qa' => function ($query) use ($start, $end){ $query->whereBetween('created_at', [$start, $end]); }], 'qa.deficiencies')->whereHas('qa', function ($query) use ($start, $end) {
            $query->whereBetween('created_at', [$start, $end]);
        })->get();

    }
    


    
    
}
