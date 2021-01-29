<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\Patients;
use Vanguard\MobileCarrier;
use Vanguard\Station;
use Vanguard\Physician;
use Vanguard\Facilities;
use Vanguard\TransportQualifier;
use Vanguard\PatientTransportQualifier;
use Vanguard\PatientTrackingNote;
use Vanguard\ProcedureCode;
use Vanguard\PatientDoctorCert;
use Vanguard\BadRunSheet;
use Vanguard\InsuranceTypes;
use Vanguard\MedicalConditions;
use Vanguard\Employee;
use Vanguard\EmployeeBadRunSheetError;

use PDF;
use Carbon;

class PatientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    
    public function pDashboard()
    {
        $brs = BadRunSheet::with('problems')->where('status', '<=', 4)->get();
        
        $holding = EmployeeBadRunSheetError::whereHas('pcr', function($q){$q->where('status', '<=', 4);})->where('error_id', '!=', 17)->get();
        
        $drug = EmployeeBadRunSheetError::whereHas('pcr', function($q){$q->where('status', '<=', 4);})->where('error_id', 17)->get();
        
        $certs = PatientDoctorCert::where('end_date', '<', Carbon::now()->addDays(15))->get();
        
        $employees = Employee::whereHas('BadRunSheets', function ($query) {
                        $query->where('status', '<', 5);
                    })
                    ->with(['BadRunSheets' => function ($q){
                        $q->where('status', '<', 5);
                    }])
                    ->orderBy('last_name')->get();

        return view('patients.dashboard', compact('brs', 'certs', 'employees', 'holding', 'drug') );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patients = Patients::
            where('last_name', 'like', '%' . $request->name . '%')
            ->orderBy('last_name')
            ->paginate(9);

        return view('patients.index', compact('patients'));
    }
    
    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function autocomplete(Request $request)

    {

        $patients = Patients::select('id','first_name')

                ->where("first_name","LIKE","%{$request->input('query')}%")

                ->get();

        foreach($patients as $row)
        {
            $data[] = $row->first_name;
        }

        return response()->json($data);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $mobilecarriers = MobileCarrier::pluck('label', 'id');
        $station = Station::pluck('station', 'id');

        return view('patients.create', compact('mobilecarriers',  'station'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ptcount = Patients::count();

        $ptid = $ptcount + 1;

        $patient = new Patients;

        $patient->ptid = $ptid;
        $patient->first_name = encrypt($request->first_name);
        $patient->middle_name = encrypt($request->middle_name);
        $patient->last_name = encrypt($request->last_name);
        $patient->prefered_name = encrypt($request->prefered_name);
        $patient->dob = $request->dob_submit;
        $patient->ssn = encrypt($request->ssn);
        $patient->ethnicity = $request->ethnicity;
        $patient->email = encrypt($request->email);
        $patient->phone = encrypt($request->phone);
        $patient->phone_mobile = encrypt($request->phone_mobile);
        $patient->phone_carrier = $request->phone_carrier;
        $patient->street_number = $request->street_number;
        $patient->route = encrypt($request->route);
        $patient->address_2 = encrypt($request->address_2);
        $patient->locality = encrypt($request->locality);
        $patient->state = encrypt($request->state);
        $patient->postal_code = encrypt($request->postal_code);
        $patient->primary_station = $request->primary_station;
        $patient->status = $request->status;


        $patient->save();
        
         $note = new PatientTrackingNote;
    
        $note->note = "Patient $request->first_name $request->last_name has been added as a new patient.";
        $note->patient_id = $patient->id;
        $note->user_id = Auth()->user()->id;
        $note->save();
        
        return back();
    }

    public function sync()
    {
        $requests= PatientList::get();

        foreach($requests as $request) {

            $ptcount = Patients::count();

            $ptid = $ptcount + 1;

            $patient = new Patients;

            $patient->ptid = $ptid;
            $patient->paid = $request->paid;
            $patient->first_name = encrypt($request->first_name);
            $patient->middle_name = encrypt($request->middle_name);
            $patient->last_name = encrypt($request->last_name);
            $patient->prefered_name = encrypt($request->prefered_name);
            $patient->dob = $request->dob_submit;
            $patient->ssn = encrypt($request->ssn);
            $patient->ethnicity = $request->ethnicity;
            $patient->email = encrypt($request->email);
            $patient->phone = encrypt($request->phone);
            $patient->phone_mobile = encrypt($request->phone_mobile);
            $patient->phone_carrier = $request->phone_carrier;
            $patient->street_number = $request->street_number;
            $patient->route = encrypt($request->route);
            $patient->address_2 = encrypt($request->address_2);
            $patient->locality = encrypt($request->locality);
            $patient->state = encrypt($request->state);
            $patient->postal_code = encrypt($request->postal_code);
            $patient->primary_station = $request->primary_station;
            $patient->status = $request->PatientStatus;



            $patient->save();

            $note = new PatientTrackingNote;

            $note->note = "Patient $request->first_name $request->last_name has been added as a new patient.";
            $note->patient_id = $patient->id;
            $note->user_id = Auth()->user()->id;
            $note->save();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pt = Patients::with('insurance', 'insurance.insur', 'medical', 'medical.condition', 'qualification', 'qualification.pt_condition', 'qualification.pt_condition.condition', 'certifications', 'certifications.pt_physician', 'certifications.pt_physician.doctor')->find($id);
        $physicians = Physician::get();
        $facilities = Facilities::orderBy('name')->get();
        $transportQualifiers = TransportQualifier::where('status', 1)->get();
        $procedures = ProcedureCode::get();
        $insurances = InsuranceTypes::get();
        $conditions = MedicalConditions::get();
        
        return view('patients.show', compact('pt', 'physicians', 'facilities', 'transportQualifiers', 'procedures', 'insurances', 'conditions'));
    }
    
    public function medicaidPdf($pcs_id){
        $pcs = PatientDoctorCert::with('patient', 'patient.qualification', 'patient.qualification.qualifier', 'patient.certifications', 'patient.certifications.pt_physician', 'patient.certifications.pt_physician.doctor')->find($pcs_id);
    
    
        view()->share('pcs', $pcs);
        
        $pdf = PDF::loadView('patients.reports.reportMedicaidPcs')->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20)->setOption('margin-top', 20);;
        
        $first_name = decrypt($pcs->patient->first_name);
        
        $last_name = decrypt($pcs->patient->last_name);
        
        $file = substr($first_name, 0, 1).'.'.$last_name.'_'.Carbon::parse($pcs->start_date)->format('M d Y');
        
        return $pdf->download($file);
        
    //return view('patients.reports.reportMedicaidPcs', compact('pcs'));
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
