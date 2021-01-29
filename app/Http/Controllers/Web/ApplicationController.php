<?php


namespace Vanguard\Http\Controllers\Web;

use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\ApplicationEducation;

use Vanguard\MobileCarrier;
use Vanguard\EmployeePositions;
use Vanguard\Station;
use Vanguard\Employee;
use Vanguard\User;
use Vanguard\EmploymentHistory;
use Vanguard\StateCertificationTypes;
use Vanguard\StateCertifications;
use Vanguard\PreInterview;
use Vanguard\ApplicationCertification;
use Vanguard\EmployeeAbcCertification;
use Validator;


use Vanguard\Support\Enum\UserStatus;

use Illuminate\Support\Facades\Mail;
use Vanguard\Mail\NewApplicationEmail;

use PDF;
use Carbon;
use DB;

class ApplicationController extends Controller
{
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

        $mobilecarriers = MobileCarrier::pluck('label', 'id');
        $employeepositions = EmployeePositions::where('appliable', 1)->pluck('label', 'id');
        $station = Station::pluck('station', 'id');
        $certification = ApplicationCertification::pluck('certification', 'id');
        $cert_level = StateCertificationTypes::get();
        return view('hr.application2', compact('mobilecarriers', 'employeepositions', 'station', 'cert_level', 'certification'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users'
        ]);
        //dd($validator);
        if ($validator->fails()) {
            return view('hr.applicationExists');
        }

        try {

            // Create Empty Arrays //
            $payload = [
                'stateCertifications' => [],
                'employeeAbcCertifications' => [],
                'employeeEducationHx' => [],
                'employeeEmploymentHx' => [],
            ];

            // *** END Arrays //

            // Start New Employee Application Transaction //

            DB::transaction(function () use ($request, $payload) {

                
                // Create User //

                $user = User::create(['email' => $request->personal_email, 'password' => '$2y$10$zTHNdHboXWHJ.xmC6WYyQ.ndgmWUTehZPD2I4UY2ut38b3.5Zv85q', 'first_name' => $request->first_name, 'last_name' => $request->last_name, 'role_id' => '17', 'country_id' => null, 'username' => null, 'status' => UserStatus::ACTIVE]);

                // *** END Create User //

                // Insert Applicants Demographic Data to Company DB//

                $employee = new Employee;

                $employee->user_id = $user->id;
                $employee->eid = $request->eid;
                $employee->rfid = $request->rfid;
                $employee->first_name = $request->first_name;
                $employee->middle_name = $request->middle_name;
                $employee->last_name = $request->last_name;
                $employee->prefered_name = $request->prefered_name;
                $employee->dob = $request->dob_submit;
                $employee->ssn = encrypt($request->ssn);
                $employee->ethnicity = $request->ethnicity;
                $employee->personal_email = $request->personal_email;
                $employee->phone = $request->phone;
                $employee->phone_mobile = $request->phone_mobile;
                $employee->phone_carrier = $request->phone_carrier;
                $employee->street_number = $request->street_number;
                $employee->route = $request->route;
                $employee->address_2 = $request->address_2;
                $employee->state = $request->state;
                $employee->postal_code = $request->postal_code;
                $employee->primary_station = $request->primary_station;
                $employee->primary_position = $request->primary_position;
                $employee->status = 1;
                $employee->doh = $request->doh_submit;
                $employee->driver = $request->driver;
                $employee->dod = $request->dod_submit;
                $employee->nd_reason = $request->nd_reason;
                $employee->driver_note = $request->driver_note;
                $employee->drivers_license = $request->drivers_license;
                $employee->drivers_license_expiration = $request->drivers_license_expiration;
                $employee->driver_license_state = $request->driver_license_state;


                $employee->save();

                // *** END Insert Applicants Demographic Data to Company DB//
                
              
                
               //dd(date('Y-m-d', strtotime($request->sc['expiration'][0])));
                if($request->sc){
                    $sc = $request->sc;
                    // Insert Applicants State Certifcations//
                    //dd($request->sc['state']);
                     foreach ($request->sc['state'] as $key => $value) {
                         //dd($sc['certification_level'][$key]);
                            $date = date('Y-m-d', strtotime($sc['expiration'][$key]));
                            //dd($date);
                            StateCertifications::create([
                                'user_id' => $employee->user_id,
                                'state' => $value,
                                'certification_level' => $sc['certification_level'][$key],
                                'expiration' => Carbon::parse($date)->toDateTimeString(),
                                'status' => 1
                            ]);
                        }
                }
                

                // *** END Insert Applicants State Certifcations//

                // Insert Applicants Alphabet Certifcations//
                
                if($request->abc){
                    $abc = $request->abc;
                   
                     foreach ($request->abc['certification_type'] as $key => $value) {
                         
                            $date = date('Y-m-d', strtotime($abc['expiration'][$key]));
                            //dd($date);
                            EmployeeAbcCertification::create([
                                'user_id' => $employee->user_id,
                                'certification_type' => $value,
                                'cert_number' => $sc['cert_number'][$key],
                                'expiration' => Carbon::parse($date)->toDateTimeString(),
                                'status' => 1
                            ]);
                        }
                }
                
                // *** END Insert Applicants Alphabet Certifcations//

                // Insert Applicants Education Hisotry//
                 if($request->education){
                    $education = $request->education;
                   
                     foreach ($request->education['completed'] as $key => $value) {
                         
                            
                            //dd($date);
                            ApplicationEducation::create([
                                'application_id' => $employee->user_id,
                                'completed' => $value,
                                'school' => $education['school'][$key],
                                'state' => $education['state'][$key],
                                'degree' => $education['degree'][$key],
     
                            ]);
                        }
                }


                // *** END Insert Applicants Education Hisotry//

                // Insert Applicants Employement History//
                if($request->employment){
                    $employment = $request->employment;
                   
                     foreach ($request->employment['start'] as $key => $value) {
                         
                            
                            //dd($date);
                            EmploymentHistory::create([
                                'pid' => $employee->user_id,
                                'start' => $value,
                                'end' => $employment['start'][$key],
                                'end' => $employment['end'][$key],
                                'name' => $employment['name'][$key],
                                'address' => $employment['address'][$key],
                                'wage' => $employment['wage'][$key],
                                'leave' => $employment['leave'][$key],
                            ]);
                        }
                }
                // *** End Insert Applicants Employement History//

// Insert Applicants Pre-Employment Questions //

                $pi = new PreInterview;

                $pi->year_pdrive = $request->year_pdrive;
                $pi->year_cdrive = $request->year_cdrive;
                $pi->year_edrive = $request->year_edrive;
                $pi->emswork = $request->emswork;
                $pi->ems_years = $request->ems_years;

                $pi->save();

// *** END Insert Applicants Pre-Employment Questions //

//Build Email to send to administration//
    $employee = Employee::where('user_id', $employee->user_id)->first();

                if ($employee) {

                    $managers = Station::find($employee->primary_station)->first();

                    if ($managers) {
                        if ($managers->manager == $managers->regional_manager) {
                            Mail::to([$managers->mgr->email, 'aevans@peasi.net', 'jblevins@peasi.net', 'madkins2@peasi.net', 'madkins@peasi.net', 'tadkins@peasi.net', 'restep@peasi.net', 'bestep@peasi.net'])->send(new NewApplicationEmail($employee));
                        } else {
                            Mail::to([$managers->mgr->email, $managers->Regional->email, 'aevans@peasi.net', 'jblevins@peasi.net', 'madkins2@peasi.net', 'madkins@peasi.net', 'tadkins@peasi.net', 'restep@peasi.net', 'bestep@peasi.net'])->send(new NewApplicationEmail($employee));
                        }
                    }
                }
// *** END Notification

            });




            //dd($managers);


            return view('hr.appcomplete');

            // ***END Insert Applicants Pre-Employment Questions //

            //Get Success Response and Return to User//
            return response()->json([
                'status' => 'success',
                'errors' => false,
                'payload' => $payload
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'errors' => [
                    $e->getMessage()
                ],
                'payload' => null
            ], 422);
        }


    }

    public function storeNew(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users'
        ]);
        //dd($validator);
        if ($validator->fails()) {
            return view('hr.applicationExists');
        }else{
            // Create User //

            $user = User::create(['email' => $request->email, 'password' => '$2y$10$zTHNdHboXWHJ.xmC6WYyQ.ndgmWUTehZPD2I4UY2ut38b3.5Zv85q', 'first_name' => $request->first_name, 'last_name' => $request->last_name, 'role_id' => '17', 'country_id' => null, 'username' => null, 'status' => UserStatus::ACTIVE]);

            // *** END Create User //

            // Insert Applicants Demographic Data to Company DB//

            $employee = new Employee;

            $employee->user_id = $user->id;
            $employee->eid = $request->eid;
            $employee->rfid = $request->rfid;
            $employee->first_name = $request->first_name;
            $employee->middle_name = $request->middle_name;
            $employee->last_name = $request->last_name;
            $employee->prefered_name = $request->prefered_name;
            $employee->dob = $request->dob_submit;
            $employee->ssn = encrypt($request->ssn);
            $employee->ethnicity = $request->ethnicity;
            $employee->personal_email = $request->email;
            $employee->phone = $request->phone;
            $employee->phone_mobile = $request->phone_mobile;
            $employee->phone_carrier = $request->phone_carrier;
            $employee->street_number = $request->street_number;
            $employee->route = $request->route;
            $employee->address_2 = $request->address_2;
            $employee->state = $request->state;
            $employee->postal_code = $request->postal_code;
            $employee->primary_station = $request->primary_station;
            $employee->primary_position = $request->primary_position;
            $employee->status = 1;
            $employee->doh = $request->doh_submit;
            $employee->driver = $request->driver;
            $employee->dod = $request->dod_submit;
            $employee->nd_reason = $request->nd_reason;
            $employee->driver_note = $request->driver_note;
            $employee->drivers_license = $request->drivers_license;
            $employee->drivers_license_expiration = $request->drivers_license_expiration;
            $employee->driver_license_state = $request->driver_license_state;


            $employee->save();

            // *** END Insert Applicants Demographic Data to Company DB//

            //Build Email to send to administration//


            if ($employee) {

                $managers = Station::find($employee->primary_station)->first();

                if ($managers) {
                    if ($managers->manager == $managers->regional_manager) {
                        Mail::to([$managers->mgr->email, 'aevans@peasi.net', 'jblevins@peasi.net', 'madkins2@peasi.net', 'madkins@peasi.net', 'tadkins@peasi.net', 'restep@peasi.net', 'bestep@peasi.net'])->send(new NewApplicationEmail($employee));
                    } else {
                        Mail::to([$managers->mgr->email, $managers->Regional->email, 'aevans@peasi.net', 'jblevins@peasi.net', 'madkins2@peasi.net', 'madkins@peasi.net', 'tadkins@peasi.net', 'restep@peasi.net', 'bestep@peasi.net'])->send(new NewApplicationEmail($employee));
                    }
                }
            }
// *** END Notification

            return view('hr.appcomplete');
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store_workhx(Request $request)
    {
        $hx = $request->hx;
        //dd($hx);
        foreach ($hx['pid'] as $key => $pid) {
            EmploymentHistory::create(
                [
                    'pid' => $pid,
                    'start' => $hx['start'][$key],
                    'end' => $hx['end'][$key],
                    'name' => $hx['name'][$key],
                    'address' => $hx['address'][$key],
                    'wage' => $hx['wage'][$key],
                    'leave' => $hx['leave'][$key]
                ]);

            $employee = $pid;
        }


        //dd($employee);

        return view('hr.educationhx', compact('employee'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store_schoolhx(Request $request)
    {
        //dd($request->edu);

        if ($request->nonw == 1) {
            return view('hr.interviewinfo', compact('employee'));
        } else {
            $edu = $request->edu;

            foreach ($edu['application_id'] as $key => $application_id) {
                ApplicationEducation::create([
                    'application_id' => $application_id,
                    'completed' => $edu['completed'][$key],
                    'school' => $edu['school'][$key],
                    'state' => $edu['state'][$key],
                    'degree' => $edu['degree'][$key]
                ]);

                $employee = $application_id;
            }

            return view('hr.interviewinfo', compact('employee'));
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store_interview(Request $request)
    {

        $row = $request->all();
        PreInterview::create($row);

        $cert_level = StateCertificationTypes::get();


        $app_id = $request->pid;

        $employee = Employee::where('user_id', $app_id)->first();


        if ($employee) {

            $managers = Station::find($employee->primary_station)->first();

            if ($managers) {
                if ($managers->manager == $managers->regional_manager) {
                    Mail::to([$managers->mgr->email, 'aevans@peasi.net', 'jblevins@peasi.net', 'madkins2@peasi.net', 'madkins@peasi.net', 'tadkins@peasi.net', 'restep@peasi.net', 'bestep@peasi.net'])->send(new NewApplicationEmail($employee));
                } else {
                    Mail::to([$managers->mgr->email, $managers->Regional->email, 'aevans@peasi.net', 'jblevins@peasi.net', 'madkins2@peasi.net', 'madkins@peasi.net', 'tadkins@peasi.net', 'restep@peasi.net', 'bestep@peasi.net'])->send(new NewApplicationEmail($employee));
                }
            }
        }

        //dd($managers);


        return view('hr.appcomplete');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store_state(Request $request)
    {


        foreach ($request->sc as $row) {
            StateCertifications::create($row);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function pdf()
    {
        $employees = Employee::where('user_id', 2435)->first();

        view()->share('employees', $employees);

        $pdf = PDF::loadView('employee.reports.application', compact('employees'))->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20)->setOption('margin-top', 20);

        return $pdf->download('cprinvoice.pdf');

        // return view('employee.reports.application', compact('employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
