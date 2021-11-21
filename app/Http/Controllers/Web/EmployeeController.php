<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\CertificateStatus;
use Vanguard\CertificateType;
use Vanguard\Competency;
use Vanguard\EmployeeN95FitTest;
use Vanguard\Http\Controllers\Controller;


//Models//
use Vanguard\Employee;
use Vanguard\Companies;
use Vanguard\RespiratorModels;
use Vanguard\State;
use Vanguard\User;
use Vanguard\Station;
use Vanguard\EmployeePositions;
use Vanguard\timepunch;
use Vanguard\payperiods;
use Vanguard\PayRates;
use Vanguard\NarcoticLog;
use Vanguard\Units;
use Vanguard\EmployeeMvr;
use Vanguard\DriverRiskAssessments;
use Vanguard\EmployeeDrivingIncident;
use Vanguard\schedule;
use Vanguard\MvrOffense;
use Vanguard\DrivingIncident;
use Vanguard\StateCertificationTypes;
use Vanguard\EmployeeCompetencies;
use Vanguard\EnrolledStudent;
use Vanguard\Classes;
use Vanguard\RequiredCompetencies;
use Vanguard\Courses;

//End Models


//Facades//
use Carbon;
use DateTime;
use Vanguard\Support\Enum\UserStatus;
use Auth;
use Authy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Vanguard\MobileCarrier;
use Vanguard\Export\EmployeesExport;
use Vanguard\Export\EmployeesAccessExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
//end Facades

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * * * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory\Illuminate\View\View
     */
    public function index(User $user, Request $request)
    {
        //Get current user data with their compaany id...
        $user = Auth::user();
        $company_id = $user->companies_id;
        $edit = false;


        // Fetch users from database...
        $company = Companies::with('employees')->find($company_id);

        // Obtain the list of all employees associated with users company...
        $employees = employee::
        with(['employeepositions', 'station', 'timepunch'])
            ->where('last_name', 'like', '%' . $request->name . '%')
            ->orderBy('last_name')
            ->paginate(9);

        //Return list view with employeee list...
        return view('employee.index', compact('user', 'employees', 'edit'));
    }

    public function profilePdf($id)
    {
        $employee = Employee::with('certificates', 'certificates.types', 'certificates.states')->find($id);

        $classes = json_decode($employee->employeepositions->orientationLevel, true);
        $comp = json_decode($employee->employeepositions->required_competencies, true);

        //dd($classes);

        $courses = Courses::with('instructed')->whereIn('base_level', $classes)->where('required', 1)->get();
        $competencies = Competency::whereIn('id', $comp)->get();


        return view('employee.reports.profile', compact('employee','competencies', 'courses'));
    }

    public function responseTeam()
    {
        $employees = Employee::with('certifications')->where('additional_postions', 'like', "%37%")->orderBy('last_name')->paginate(25);

        return view('employee.femaResponse', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $user = Auth::user();
        $company_id = $user->companies_id;
        $search = Input::get('search');

        $company = Companies::find($company_id);


        $employees = $company->employees()
            ->where('last_name', 'like', "%{$search}%")
            ->where('last_name', 'like', '%' . $request->name . '%')
            ->orderBy('last_name')
            ->paginate(9);

        return view('employee.index', compact('employees'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $mobilecarriers = MobileCarrier::pluck('label', 'id');
        $employeepositions = EmployeePositions::pluck('label', 'id');
        $station = Station::pluck('station', 'id');
        $companies = Companies::get();

        return view('employee.create', compact('user', 'mobilecarriers', 'employeepositions', 'station', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        DB::transaction(function () use ($request) {
            //validate required fields
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:employees',
                'eid' => 'required|unique:employees',
                'rfid' => 'unique:employees',
            ]);


            $user = User::create(['email' => $request->email, 'password' => '$2y$10$zTHNdHboXWHJ.xmC6WYyQ.ndgmWUTehZPD2I4UY2ut38b3.5Zv85q', 'first_name' => $request->first_name, 'last_name' => $request->last_name, 'role_id' => '3', 'country_id' => null, 'username' => null, 'status' => UserStatus::ACTIVE]);

            // Create employee deomgraphics


            $add_pos = $request->additional_postions;


            $data = $request->except('additional_postions', 'dob_submit');
            $data['additional_postions'] = $add_pos;


            $employee = new Employee;

            $employee->company_id = $request->company_id;
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
            $employee->email = $request->email;
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
            $employee->additional_postions = $add_pos;
            $employee->status = $request->status;
            $employee->doh = $request->doh_submit;
            $employee->driver = $request->driver;
            $employee->dod = $request->dod_submit;
            $employee->nd_reason = $request->nd_reason;
            $employee->driver_note = $request->driver_note;
            $employee->company_id = $request->company_id;

            $employee->save();


            // Update Logging

            app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Added New Employee');
        });


        if ($request->hasFile('photo')) {

            $allowedfileExtension = ['jpg', 'png', 'PNG'];

            $files = $request->file('photo');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension, $allowedfileExtension);

//dd($check);

                if ($check) {


                    foreach ($request->photo as $attachment) {


                        $filename = $attachment->storeAs('employee_photos', $request->eid . '.png');

                        $publicFileName = $attachment->storeAs('/public/employee_photos', $request->eid . '.png');


                        $emp = Employee::where('eid', $request->eid)->first();
                        $emp->photo = $filename;
                        $emp->save();


                    }


                } else {

                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload PNG, png , jpg.</div>';

                }

            }

        }

        // Redirect to list on success.
        return redirect('/employees')->with('success', 'New Employee Created');

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit = false;
        $risk= '';
        $employee_level = EmployeePositions::get();
        $mvroffenses = MvrOffense::get();
        $drivingincidents = DrivingIncident::get();

        $certificate_type = CertificateType::with('states')->orderBy('type')->get();
        $certificate_status = CertificateStatus::get();
        $states = State::get();


        $ftos = Employee::orderBy('last_name')->get()
            ->keyBy('user_id')
            ->map(function ($ftos){
                return"{$ftos->last_name}, {$ftos->first_name}";
            });

        //fetch todays date...
        $td = date('Y-m-d');

        //fetch current payperiod
        $payperiod = payperiods::whereRaw("start <= '$td' AND end >= '$td'")->first();
        //dd($payperiod);

        //fetch start and end payperiod dates...
        $start = $payperiod->start;
        $end = $payperiod->end;

        $now = date('Y-m-d', strtotime('now'));

        $quarter = DB::table('quarters')
            ->where(function ($query) use ($now) {
                $query->where('start', '<=', $now);
                $query->where('end', '>=', $now);
            })->first();

        //find result

        $employees = Employee::with([ 'driver_eval', 'employeeencounters', 'employeeencounters.policies', 'enrolledcourses', 'narcoticlog', 'narcoticlog.narcoticbox', 'fieldtraining', 'fieldtraining.fto', 'mvrincident', 'mvrincident.mvroffense', 'drivingincident', 'drivingincident.type', 'timepunch' => function ($q) use ($start, $end) {
            $q->whereRaw("time_in >= '$start' AND time_in <= '$end'");
        }, 'attendance' => function ($q) use ($quarter) {
            $q->whereBetween('date', array($quarter->start, $quarter->end));
        }, 'attendance.type'])->find($id);

        $competencies = EmployeeCompetencies::where('user_id', $employees->user_id)->get();
        $mobilecarriers = MobileCarrier::pluck('label', 'id');

        $employee_mvr = EmployeeMvr::with('mvroffense')->where('employee_id', $employees->user_id)->get();

        $demographics = DriverRiskAssessments::where('employee_id', $employees->user_id)->first();

        $dhist = EmployeeDrivingIncident::where('employee_id', $employees->user_id)->get();

        $age = date_diff(date_create($employees->dob), date_create('today'))->y;





        if ($age < 20) {
            $apts = '30';
            $arisk = '<h4><span class="badge badge-danger">VERY HIGH</span></h4>';
        } elseif ($age >= 20 && $age <= 30) {
            $apts = '10';
            $arisk = '<h4> <span class="badge badge-warning">HIGH</span></h4>';
        } elseif ($age >= 65) {
            $apts = '8';
            $arisk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
        } elseif ($age >= 31 && $age <= 64) {
            $apts = '1';
            $arisk = '<h4> <span class="badge badge-success">LOW</span></h4>';
        }


        $doh= strtotime($employees->doh);
        $date1 = strtotime($employees->doh);
        $date1 = date('Y-m-d', $date1);
        $date1 = new DateTime($date1);
        $date2 = strtotime('now');
        $date2 = date('Y-m-d', $date2);
        $date2 = new DateTime($date2);


        $dohage = date_diff($date1, $date2);
        $dohage = $dohage->m + ($dohage->y * 12);

        if ($dohage >= 0 && $dohage < 12) {
            $dohpts = '8';
            $dohrisk = '<h4><span class="badge badge-warning"> HIGH</span></h4>';
        } elseif ($dohage >= 12 && $dohage <= 24) {
            $dohpts = '4';
            $dohrisk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
        }  elseif ($dohage > 24) {
            $dohpts = '1';
            $dohrisk = '<h4> <span class="badge badge-success">LOW</span></h4>';
        }


        if(empty($demographics))
        {
            $demo = "0";
            $sexpts= 0;
            $dolpts= 0;
            $licpts = 0;
            $shiftpts = 0;
            $cogpts = 0;
            $insurablepts = 0;
            $medicationpts= 0 ;
        }else{
            if ($demographics->sex == 1) {
                $sex = '<h4> <span class="badge badge-success">LOW</span></h4>';
                $sexpts = '1';
            } elseif ($demographics->sex == 8) {
                $sex = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                $sexpts = "4";
            }else{
                $sexpts = "0";
            }



            $dol = strtotime($demographics->date_of_license);
            $dol = date('m/d/Y', $dol);

            $dolage = date_diff(date_create($dol), date_create('now'))->y;

            if ($dolage < 2) {
                $dolpts = '10';
                $dolrisk = '<h4><span class="badge badge-danger">VERY HIGH</span></h4>';
            } elseif ($dolage >= 2 && $dolage <= 3) {
                $dolpts = '8';
                $dolrisk = '<h4> <span class="badge badge-warning">HIGH</span></h4>';
            } elseif ($dolage >= 3 && $dolage <= 9) {
                $dolpts = '4';
                $dolrisk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
            } elseif ($dolage >= 1) {
                $dolpts = '1';
                $dolrisk = '<h4> <span class="badge badge-success">LOW</span></h4>';
            }

            if ($demographics->license_status == 1) {
                $lic = '<h4> <span class="badge badge-success">LOW</span></h4>';
                $licpts = '1';
            } elseif ($demographics->license_status == 30) {
                $lic = '<h4> <span class="badge badge-danger">VERY HIGH RISK</span></h4>';
                $licpts = "30";
            }else{
                $licpts= "0";
            }

            if ($demographics->shift_hours >= 25) {
                $shiftpts = '30';
                $shiftrisk = '<h4><span class="badge badge-danger">VERY HIGH</span></h4>';
            } elseif ($demographics->shift_hours >= 20 && $demographics->shift_hours <=24) {
                $shiftpts = '8';
                $shiftrisk = '<h4> <span class="badge badge-warning">HIGH</span></h4>';
            } elseif ($demographics->shift_hours >= 16 && $demographics->shift_hours <=19) {
                $shiftpts = '10';
                $shiftrisk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
            } elseif ($demographics->shift_hours <= 15) {
                $shiftpts = '1';
                $shiftrisk = '<h4> <span class="badge badge-success">LOW</span></h4>';
            }

            if ($demographics->cognitive_exam == 30) {
                $cogpts = '30';
                $cogrisk = '<h4><span class="badge badge-danger">VERY HIGH</span></h4>';
            } elseif ($demographics->cognitive_exam == 10) {
                $cogpts = '10';
                $cogrisk = '<h4> <span class="badge badge-warning">HIGH</span></h4>';
            } elseif ($demographics->cognitive_exam == 8) {
                $cogpts = '8';
                $cogrisk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
            } elseif ($demographics->cognitive_exam == 1) {
                $cogpts = '1';
                $cogrisk = '<h4> <span class="badge badge-success">LOW</span></h4>';
            }

            if($demographics->non_driver == 0){
                $insurablepts = '1';
                $insurable = '<h4> <span class="badge badge-success">LOW</span></h4>';
            }elseif($demographics->non_driver == 1){
                $insurablepts = '30';
                $insurable = '<h4> <span class="badge badge-danger">VERY HIGH </span></h4>';
            }


            if($demographics->corrective_lenses == 1){
                $lenses= '<h4> <span class="badge badge-primary">MEDIUM </span></h4>';
                $lensespts= '4';
            }elseif($demographics->corrective_lenses == 0){
                $lenses= '<h4> <span class="badge badge-success">LOW</span></h4>';
                $lensespts= '1';
            }if($demographics->medication == 1){
                $medication= '<h4> <span class="badge badge-warning">HIGH </span></h4>';
                $medicationpts= '8';
            }elseif($demographics->medication == 0){
                $medication= '<h4> <span class="badge badge-success">LOW</span></h4>';
                $medicationpts= '1';
            }

        }

        $demotot = $apts + $dohpts + $sexpts + $dolpts + $licpts + $shiftpts + $cogpts +$insurablepts + $medicationpts;
        $auto= 0; $auto2= 0; $auto3= 0;
        if(!$demotot){

        }else{
            if($demotot >= 39 || $apts >= 30 || $dohpts >= 30 || $sexpts >= 30 || $dolpts >= 30 || $licpts >= 30 || $shiftpts >= 30 || $cogpts >= 30 || $insurablepts >= 30 || $medicationpts >= 30){
                $demoline= "list-group-item-danger";
                $totrisk = 'VERY HIGH RISK';
                $auto = '1';
            }else{
                if(!$demographics){
                    $demoline="";
                }elseif($demographics->non_driver == 1){
                    $demoline= "list-group-item-danger";
                    $totrisk = 'VERY HIGH RISK';
                    $ins= "Per Insuance";
                }elseif($demotot >= 39) {
                    $demoline= "list-group-item-danger";
                    $totrisk = 'VERY HIGH RISK';
                } elseif ($demotot > 30 && $demotot < 39) {
                    $demoline= "list-group-item-warning";
                    $totrisk = 'HIGH RISK';
                } elseif ($demotot > 15 && $demotot <= 30) {
                    $demoline= "list-group-item-primary";
                    $totrisk = 'MEDIUM RISK';
                } elseif ($demotot >=0  && $demotot <= 15) {
                    $demoline= "list-group-item-success";
                    $totrisk = 'LOW RISK';
                }
            }
        }


        if(!$employee_mvr){
            $mvr_total = 0;
        }else{
            $mvr_total = 0;

            foreach ($employee_mvr as $rowmvr)
            {
                $date1 = strtotime($rowmvr->date);
                $date1 = date('Y-m-d', $date1);
                $date1 = new DateTime($date1);
                $date2 = strtotime('now');
                $date2 = date('Y-m-d', $date2);
                $date2 = new DateTime($date2);


                $doiage = date_diff($date1, $date2);
                $doiage = $doiage->m + ($doiage->y * 12);


                if ($rowmvr->mvroffense->level == 0) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                } elseif ($doiage >= 0 && $doiage <= 36 && $rowmvr->mvroffense->level == 10) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '10';
                } elseif ($doiage >= 37 && $doiage <= 48 && $rowmvr->mvroffense->level == 10) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '5';
                } elseif ($doiage >= 49 && $rowmvr->mvroffense->level <= 10) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                }elseif ($doiage >= 0 && $doiage <= 36 && $rowmvr->mvroffense->level == 15) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '15';
                } elseif ($doiage >= 37 && $doiage <= 48 && $rowmvr->mvroffense->level == 15) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '7';
                } elseif ($doiage >= 49 && $rowmvr->mvroffense->level <= 15) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                }elseif ($doiage >= 0 && $doiage <= 36 && $rowmvr->mvroffense->level == 20) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '20';
                } elseif ($doiage >= 37 && $doiage <= 48 && $rowmvr->mvroffense->level == 20) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '10';
                } elseif ($doiage >= 49 && $rowmvr->mvroffense->level <= 20) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                }elseif ($doiage >= 0 && $doiage <= 24 && $rowmvr->mvroffense->level == 25) {
                    $risk = '<h4> <span class="badge badge-warning">HIGH</span></h4>';
                    $level = '25';
                } elseif ($doiage >= 24 && $doiage <= 48 && $rowmvr->mvroffense->level == 25) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '10';
                } elseif ($doiage >= 49 && $rowmvr->mvroffense->level <= 25) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                }
                elseif ($doiage >= 0 && $doiage <= 36 && $rowmvr->mvroffense->level == 30) {
                    $risk = '<h4> <span class="badge badge-danger">VERY HIGH</span></h4>';
                    $level = '30';
                } elseif ($doiage >= 37 && $doiage <= 48 && $rowmvr->mvroffense->level == 30) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '15';
                } elseif ($doiage >= 49 && $doiage <= 60 && $rowmvr->mvroffense->level == 30) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '10';
                } elseif ($doiage >= 61 && $rowmvr->mvroffense->level == 30) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                }

                $mvr_total = $mvr_total + $level;
            }
        }
        if($mvr_total >= 30){
            $auto2 = '1';
        }
        if(!$dhist)
        {
            $dhisttotal= 0;
        }else{
            $dhisttotal= 0;

            foreach ($dhist as $item) {
                $date1 = strtotime($item->date);
                $date1 = date('Y-m-d', $date1);
                $date1 = new DateTime($date1);
                $date2 = strtotime('now');
                $date2 = date('Y-m-d', $date2);
                $date2 = new DateTime($date2);

                $doiage2 = date_diff($date1, $date2);
                $doiage2 = $doiage2->m + ($doiage2->y * 12);

                if($item->type->level == 0){
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                }
                elseif ($doiage2 >= 0 && $doiage2 <= 12 && $item->type->level == 10) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '10';
                } elseif ($doiage2 > 12 && $doiage2 <= 36 && $item->type->level == 10) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '5';
                } elseif ($doiage2 > 36 && $doiage2 <= 48 && $item->type->level == 10) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '2';
                } elseif ($doiage2 > 48 && $item->type->level == 10) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                } elseif ($doiage2 >= 0 && $doiage2 <= 12 && $item->type->level == 15) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '15';
                } elseif ($doiage2 > 12 && $doiage2 <= 36 && $item->type->level == 15) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '10';
                } elseif ($doiage2 > 36 && $doiage2 <= 48 && $item->type->level == 15) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '5';
                } elseif ($doiage2 > 48 && $item->type->level == 15) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                } elseif ($doiage2 >= 0 && $doiage2 <= 12 && $item->type->level == 20) {
                    $risk = '<h4> <span class="badge badge-warning">HIGH</span></h4>';
                    $level = '20';
                } elseif ($doiage2 > 12 && $doiage2 <= 36 && $item->type->level == 20) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '15';
                } elseif ($doiage2 > 36 && $doiage2 <= 48 && $item->type->level == 20) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '10';
                } elseif ($doiage2 > 48 && $item->type->level == 20) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                } elseif ($doiage2 >= 0 && $doiage2 <= 12 && $item->type->level == 30) {
                    $risk = '<h4> <span class="badge badge-danger">VERY HIGH</span></h4>';
                    $level = '30';
                } elseif ($doiage2 > 12 && $doiage2 <= 36 && $item->type->level == 30) {
                    $risk = '<h4> <span class="badge badge-warning">HIGH</span></h4>';
                    $level = '20';
                } elseif ($doiage2 > 36 && $doiage2 <= 48 && $item->type->level == 30) {
                    $risk = '<h4> <span class="badge badge-success">MEDIUM</span></h4>';
                    $level = '15';
                } elseif ($doiage2 > 48 && $item->type->level == 30) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                }else{
                    $level = '0';
                }


                $dhisttotal = $dhisttotal + $level;
            }

        }

        if($dhisttotal >= 30){
            $auto3 = 1;
            $risk= "Very High";
        }

        $drivertotal = $demotot + $mvr_total + $dhisttotal;

        if($auto == 1 || $auto2 == 1 || $auto3 == 1){
            $totalline = "list-group-item-danger";
            $trisk= "Very High";
        }else{
            if ($drivertotal <9 || $drivertotal >= 9 && $drivertotal <= 30 ) {
                $totalline = "list-group-item-success";
                $trisk= "Low";
            } elseif ($drivertotal >= 31 && $drivertotal <= 45){
                $totalline = "list-group-item-warning";
                $trisk= "Medium";
            }elseif ($drivertotal >= 46 && $drivertotal <= 58){
                $totalline = "list-group-item-danger";
                $trisk= "High";
            }
            elseif ($drivertotal >= 59 ) {
                $totalline = "list-group-item-darkƒ";
                $trisk= "Very High";
            }
        }
        $units = Units::orderBy('status', 'asc')->where('status', '1')->orderBy('unit_number', 'asc')->get();

        $schedule = schedule::
        where('user_id', $employees->user_id  )
            ->whereDate('sin', '>', Carbon::yesterday())
            ->orderBy('sin')
            ->take(7)
            ->get();

        $sc = StateCertificationTypes::get();

        return view('employee.show', compact('mobilecarriers', 'employees', 'start', 'end', 'edit', 'units', 'mvr_total', 'demotot', 'demoline', 'dhisttotal', 'drivertotal', 'totalline', 'trisk', 'employee_level', 'ftos', 'schedule', 'mvroffenses', 'drivingincidents', 'sc', 'risk', 'competencies', 'certificate_status', 'certificate_type', 'states'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = true;
        $user = Auth::user();
        $employees = Employee::find($id);
        $mobilecarriers = MobileCarrier::pluck('label', 'id');
        $employeepositions = EmployeePositions::pluck('label', 'id');
        $station = Station::pluck('station', 'id');
        $companies = Companies::get();

        try {
            $ssn = decrypt($employees->ssn);
        } catch (DecryptException $e) {
            $ssn = "";
        }

        $sc = StateCertificationTypes::get();

        return view('employee.edit', compact('user', 'mobilecarriers', 'employeepositions', 'station', 'ssn', 'edit', 'companies', 'sc'))->with('employees', $employees);
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

        $employee = Employee::find($id);


        $narcotic_log = NarcoticLog::where('out_signature', $employee->rfid)->get();

        if($narcotic_log){
            foreach($narcotic_log as $row)
            {
                $narcotic_log = NarcoticLog::find($row->id);

                $narcotic_log->out_signature = $request->rfid;

                $narcotic_log->save();
            }

        }




        $narcotic_log = NarcoticLog::where('in_signature', $employee->rfid)->get();
        if($narcotic_log){
            foreach($narcotic_log as $row)
            {
                $narcotic_log = NarcoticLog::find($row->id);

                $narcotic_log->in_signature = $request->rfid;

                $narcotic_log->save();
            }

        }


        $narcotic_log = NarcoticLog::where('witness_in', $employee->rfid)->get();
        if($narcotic_log){
            foreach($narcotic_log as $row)
            {
                $narcotic_log = NarcoticLog::find($row->id);

                $narcotic_log->witness_in = $request->rfid;

                $narcotic_log->save();
            }

        }


        $narcotic_log = NarcoticLog::where('witness_out', $employee->rfid)->get();
        if($narcotic_log){
            foreach($narcotic_log as $row)
            {
                $narcotic_log = NarcoticLog::find($row->id);

                $narcotic_log->witness_out = $request->rfid;

                $narcotic_log->save();
            }

        }




        $add_pos = $request->additional_postions;

        if (empty($add_pos)) {
            $data = $request->except('additional_postions');


            $employee->eid = $request->eid;
            $employee->rfid = $request->rfid;
            $employee->first_name = $request->first_name;
            $employee->middle_name = $request->middle_name;
            $employee->last_name = $request->last_name;
            $employee->prefered_name = $request->prefered_name;
            $employee->dob = $request->dob_submit;
            $employee->ssn = encrypt($request->ssn);
            $employee->ethnicity = $request->ethnicity;
            $employee->email = $request->email;
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
            $employee->additional_postions = $add_pos;
            $employee->status = $request->status;
            $employee->doh = $request->doh_submit;
            $employee->driver = $request->driver;
            $employee->dod = $request->dod_submit;
            $employee->nd_reason = $request->nd_reason;
            $employee->driver_note = $request->driver_note;
            $employee->driver_step = $request->driver_step_submit;
            $employee->hold_driver = $request->hold_driver;
            $employee->company_id = $request->company_id;
            $employee->employee_status = $request->employee_status;

            $employee->save();
        } else {

            $add_pos = implode(',', $add_pos);

            $data = $request->except('additional_postions');
            $data['additional_postions'] = $add_pos;


            $employee->eid = $request->eid;
            $employee->rfid = $request->rfid;
            $employee->first_name = $request->first_name;
            $employee->middle_name = $request->middle_name;
            $employee->last_name = $request->last_name;
            $employee->prefered_name = $request->prefered_name;
            $employee->dob = $request->dob_submit;
            $employee->ssn = encrypt($request->ssn);
            $employee->ethnicity = $request->ethnicity;
            $employee->email = $request->email;
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
            $employee->additional_postions = $add_pos;
            $employee->status = $request->status;
            $employee->doh = $request->doh_submit;
            $employee->driver = $request->driver;
            $employee->dod = $request->dod_submit;
            $employee->nd_reason = $request->nd_reason;
            $employee->driver_note = $request->driver_note;
            $employee->driver_step = $request->driver_step_submit;
            $employee->company_id = $request->company_id;
            $employee->employee_status = $request->employee_status;


            $employee->save();
        }


        $employee->save();

        // Update Logging

        app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Updated Employee');


        if ($request->hasFile('photo')) {

            $allowedfileExtension = ['jpg', 'png', 'PNG'];

            $files = $request->file('photo');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension, $allowedfileExtension);

//dd($check);

                if ($check) {


                    foreach ($request->photo as $attachment) {


                        $filename = $attachment->storeAs('employee_photos', $request->eid . '.png');
                        $publicFileName = $attachment->storeAs('/public/employee_photos', $request->eid . '.png');

                        $emp = Employee::where('eid', $request->eid)->first();
                        $emp->photo = $filename;
                        $emp->save();


                    }


                } else {

                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload PNG, png , jpg.</div>';

                }

            }

        }

        // Redirect to list on success.
        return redirect('/employees?name='.$employee->last_name.'&date=&date_submit=')->with('success', 'You have updated the employee successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employee::find($id);
        $employees->delete();
        return redirect('/employees')->with('success', 'Employee Deleted');

        app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Deleted Employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function currentpayroll($id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function attachmentSubmit(Request $request)
    {
        $this->validate($request, [


            'photo' => 'required',

        ]);

        if ($request->hasFile('photo')) {

            $allowedfileExtension = ['jpg', 'png', 'PNG'];

            $files = $request->file('photo');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();


                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension, $allowedfileExtension);

//dd($check);

                if ($check) {


                    foreach ($request->photo as $attachment) {

                        $emp = Employee::find($request->pid);

                        $filename = $attachment->storeAs('employee_photos', $emp->eid . '.png');
                        //$publicFileName = $attachment->storeAs('/public/employee_photos', $emp->eid . '.png');

                        //dd($publicFileName);

                        $employee = Employee::find($request->pid);
                        $employee->photo = $filename;
                        $employee->save();


                    }

                    return redirect()->back();

                } else {

                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload PNG, png , jpg.</div>';

                }

            }

        }

    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function excell(Request $request)
    {


        return Excel::download(new EmployeesAccessExport, 'employees.xlsx');


    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function acexcell(Request $request)
    {


        return Excel::download(new EmployeesAccessExport, 'employees_access.xlsx');


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function idbadge($id)
    {
        $employees = Employee::with('company')->find($id);

        view()->share('employees', $employees);

        // pass view file
        $pdf = PDF::loadView('employee.id')->setPaper('B8')->setOption('margin-left', 0)->setOption('margin-right', 0)->setOption('margin-bottom', 0)->setOption('margin-top', 0);
        // download pdf
        return $pdf->stream('idbadge.pdf');

        return view('employee.id');


    }

    public function store_mvr_offense(Request $request)
    {
        $store = new EmployeeMvr;

        $store->employee_id = $request->employee_id;
        $store->offense = $request->offense;
        $store->date = $request->date_submit;

        $store->save();

        return redirect()->back();
    }

    public function store_driving_offense(Request $request)
    {

        $dol = date('Y-m-d', strtotime($request->date));

        $store = new EmployeeDrivingIncident;

        $store->employee_id = $request->employee_id;
        $store->incident_type = $request->offense;
        $store->date = $dol;

        $store->save();

        return redirect()->back();
    }
    public function store_dra(Request $request)
    {
        $dra= DriverRiskAssessments::where('employee_id', $request->employee_id)->first();

        $dol = date('Y-m-d', strtotime($request->date_of_license));
        //dd($dol);
        if($dra){
            $dra->sex = $request->sex;
            $dra->date_of_license = $dol;
            $dra->shift_hours = $request->shift_hours;
            $dra->cognitive_exam = 1;
            $dra->license_status = $request->license_status;
            $dra->non_driver = $request->non_driver;
            $dra->corrective_lenses = $request->corrective_lenses;
            $dra->medication = 0;

            $dra->save();
        }else{

            $dra = new DriverRiskAssessments;

            $dra->sex = $request->sex;
            $dra->date_of_license = $dol;
            $dra->shift_hours = $request->shift_hours;
            $dra->cognitive_exam = 1;
            $dra->license_status = $request->license_status;
            $dra->non_driver = $request->non_driver;
            $dra->corrective_lenses = $request->corrective_lenses;
            $dra->medication = 0;
            $dra->employee_id = $request->employee_id;

            $dra->save();
        }

        return redirect()->back();
    }

    public function emp_competency (Request $request)
    {
        $completed = date('Y-m-d', strtotime($request->completed));
        $u = EmployeeCompetencies::find($request->id);

        if($u){
            $u->completed = $completed;
            $u->save();

            return "You have updated the complete date.";
        }else{
            return "Competency not found for employee contact web master.";
        }


    }

    public function assign_competencies()
    {
        $levels = EmployeePositions::whereNotNull('required_competencies')->get();

        foreach ($levels as $level)
        {
            $competencies = json_decode($level->required_competencies);

            $employees = Employee::where('status', '<', 6)->where('primary_position', $level->id)->get();

            //dd($level->id);
            //dd($employees);
            //dd($competencies);
            foreach($competencies as $key => $row)
            {
                foreach($employees as $emp)
                {
                    $ec = EmployeeCompetencies::where('competency_id', $row)->where('user_id', $emp->user_id)->first();

                    //dd($ec->competency);

                    if($ec){
                        //Get Enrolled Student if exist//
                        $c = Classes::where('course_id', $ec->competency->course_id)->get();

                        //dd($c);
                        $es = '';
                        if($c){
                            foreach ($c as $class)
                            {
                                $es = EnrolledStudent::where('class_id', $class->id)->where('user_id', $emp->user_id)->latest()->first();
                            }
                            //dd($es);
                            if($es){
                                $ec->completed = $es->completed;

                                $ec->save();
                            }else{

                            }

                        }else{

                        }

                    }else{
                        $eec = new EmployeeCompetencies;
                        $eec->user_id = $emp->user_id;
                        $eec->competency_id = $row;
                        $eec->save();
                    }
                }
            }
        }

        //dd($eec);

    }

    public function completed_competencies()
    {
        $rc = RequiredCompetencies::whereNotNull('course_id')->get();

        foreach($rc as $rcrow){
            $classes = Classes::where('course_id', $rcrow->course_id)->get();

            foreach ($classes as $row)
            {
                $es = EnrolledStudent::where('class_id', $row->id)->get();

                foreach ($es as $erow)
                {
                    $comp = EmployeeCompetencies::where('competency_id', $rcrow->id)->where('user_id', $erow->user_id)->first();

                    if($comp)
                    {
                        $comp->completed = $erow->completed;

                        $comp->save();
                    }else{
                        $comp = new EmployeeCompetencies;

                        $comp->user_id = $erow->user_id;
                        $comp->competency_id = $rcrow->id;
                        $comp->completed = $erow->completed;

                        $comp->save();
                    }
                }
            }
        }
    }

    public function n95Create()
    {
        $employees = Employee::where('status', '<', 6)->orderBy('last_name')->get();
        $respiratorTypes = RespiratorModels::get();

        return view('employee.n95.create', compact('employees','respiratorTypes'));
    }

    public function n95Store(Request $request)
    {
        $fit = new EmployeeN95FitTest();

        $fit->user_id = $request->user_id;
        $fit->tester = Auth()->user()->id;
        $fit->mask_type = $request->mask_type;
        $fit->test_type = $request->test_type;
        $fit->reason = $request->reason;
        $fit->proper_use = $request->proper_use;
        $fit->face_seal_check = $request->face_seal_check;
        $fit->understanding = $request->understanding;
        $fit->proper_disposal = $request->proper_disposal;
        $fit->cleaning = $request->cleaning;
        $fit->dentures = $request->dentures;
        $fit->facial_hair = $request->facial_hair;
        $fit->physical_exam = $request->physical_exam;
        $fit->glasses = $request->glasses;
        $fit->limitatiions_other = $request->limitatiions_other;
        $fit->tester_signature = Carbon\Carbon::now();

        $fit->save();

        return view('employee.n95.showSignature', compact('fit'));
    }

    public function getEmployee($id)
    {
        $employee = Employee::where('user_id', $id)->first();

        $returnArray [] = array(
            'name' => $employee->last_name.', '.$employee->first_name,
            'eid' => $employee->eid
        );

        return json_encode($returnArray);
    }

    public function getRespirator($id)
    {
        $respirator = RespiratorModels::find($id);

        $returnArray[] = array(
          'type'=> $respirator->type,
          'niosh' => $respirator->niosh_number
        );

        return json_encode($returnArray);
    }

    public function showSignature($id)
    {
        $fit = EmployeeN95FitTest::find($id);

        return view('employee.n95.showSignature', compact('fit'));
    }

    public function n95EmployeeSignature($id)
    {
        $fit = EmployeeN95FitTest::find($id);

        $fit->employee_signature = Carbon\Carbon::now();
        $fit->save();

        return view('employee.n95.partials.employeeSignature', compact('fit'));
    }

    public function n95()
    {
        $fit_tests = EmployeeN95FitTest::with(['employee' => function ($q){ $q->orderBy('last_name');}])->where('test_type', 2)->get();

        return view('employee.n95.n95List', compact('fit_tests'));
    }
}
