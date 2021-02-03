<?php

use Vanguard\CourseDates;
use Vanguard\CprClasses;
use Vanguard\EmployeeEncounters;
use Vanguard\Notifications\NewSupportRequest;
Route::resources([
   'companies' => 'CompaniesController',
       'employees' => 'EmployeeController',
    'badrunsheets' => 'BadRunsheetController',
    'timepunches' => 'TimePunchControoler',
    'timeclock' => 'PunchController',
    'payperiod' => 'PayPeriodController',
    'payrates' => 'PayRateController',
    'attendance' => 'AttendanceController',
    'accounting' => 'AccountingController',
    'compliance' => 'ComplianceController',
    'policies' => 'PolicyController',
    'encounternotes' => 'EncounterNotesController',
    'narcoticlog' => 'NarcoticLogController',
    'narcoticbox' => 'NarcoticBoxesController',
    'courses' => 'CoursesController',
    'logistics' => 'LogisticsController',
    'controlled' => 'ControlledSubstancesController',
    'lesson' => 'LessonController',
    'runerrors' => 'EmployeeRunErrorsController',
    'weekly' => 'WeeklyReportController',
    'boxnote' => 'BoxNoteController',
    'seallog' => 'SealLogController',
    'viallog' => 'VialLogController',
    'narcoticwaste' => 'NarcoticWasteController',
    'cprclasses' => 'CprClassesController',
    'incidentreports' => 'IncidentReportController',
    'attendance' => 'AttendanceController',
    'qaqi' => 'QaQiController',
    'education' => 'EducationController',
    'observer' => 'ObserverController',
    'observerdates' => 'ObserverDatesController',
    'narcoticaudit' => 'NarcoticAuditController',
    'financial' => 'FinancialAssistanceController',
    'protocol' => 'ProtocolController',
    'classes' => 'ClassesController',
    'enroll' => 'EnrolledStudentController',
    'facilities' => 'FacilitiesController',
    'facility_contact' => 'FacilityContactsController',
    'dra' => 'DriverRiskAssessmentController',
    'hr' => 'HumanResourcesController',
    'mvc' => 'CrashController',
    'unitreview' => 'UnitReviewController',
    'maintanance' => 'UnitMalfunctionReportsController',
    'mechanic' => 'MechanicTasksController',
    'orientation' => 'FieldTrainingDate',
    'course_dates' => 'CourseDatesController',
    'employeeschedule' => 'EmployeeScheduleController',
    'administration' => 'AdministrationController',
    'driveassessment' => 'DrivingAssessmentsController',
    'competency' => 'CompetencyController',
    'answere' => 'StudentQuizAnswereController',
    'scholarship' => 'ScholarshipController',
    'patients' => 'PatientsController',
    'statecerts' => 'EmployeeStateCertificationsController',
    'todo' => 'ToDoController',
    'quiz' => 'QuizController',
    'blog' => 'EmsBlogController',
    'bucyrus' => 'BucyrusController',
    'financial_assistance' => 'FinancialAssistanceController',
    'units' => 'UnitsController',
    'covid' => 'CovidController',
    'companyMeeting' => 'CompanyMeetingController',
    'certificates' => 'CertificateController'
    ]);

//Home //

    Route::get('/', [
        'as' => 'home',
        'uses' => 'HomeController@index'
    ]);
//EndHome//

//test//

Route::get('employee/profile/{id}', 'EmployeeController@profilePdf');

Route::get('/test/{id}', function ($id){
    $employee = Vanguard\Employee::with('certificates', 'certificates.types', 'certificates.states')->find($id);

    $classes = json_decode($employee->employeepositions->orientationLevel, true);

    //dd($classes);

    $courses = Vanguard\Courses::with('instructed')->whereIn('base_level', $classes)->where('required', 1)->get();

    return view('employee.reports.profile', compact('employee', 'courses'));

});

Route::get('/slack', function (){

    $it = Vanguard\ItSupportTicket::find(10);
    $support= Vanguard\ItSupportTicket::find(10);
    $it->notify(new NewSupportRequest($support));

});

// //

//Third Party API//
Route::get('fleetcomplete', 'FleetCompleteController');
Route::get('fleetcomplete/assets', 'FleetCompleteController@assets');
// END//

//COVID 19 ROUTES//

Route::get('/updatePatient/modal/{id}', function($id){
    $patient = Vanguard\CovidPatientExposure::findorfail($id);

    return view('covid.partials.updatePatientBody', compact('patient'));
});

Route::post('updatePatientExposure/{id}', function (Illuminate\Http\Request $request, $id){
    $patient = Vanguard\CovidPatientExposure::findorfaIl($id);
    $dot = date('Y-m-d', strtotime($request->transport_date));
    $dob = date('Y-m-d', strtotime($request->dob));

    $patient->transport_date = $dot;
    $patient->patient_name = $request->patient_name;
    $patient->date_of_birth = $dob;
    $patient->pick_up = $request->pick_up;
    $patient->drop_off = $request->drop_off;
    $patient->patient_status = $request->status;
    $patient->follow_up_info = $request->follow_up;
    $patient->save();

    return  back()->with('success','Your update was successful.');
});

Route::post('updateEmployeExposure/{id}', function (Illuminate\Http\Request $request, $id){
    $exposure = Vanguard\CovidExposure::findorfail($id);

    $input = $request->all();

    $exposure->fill($input)->save();

    return  back()->with('success','Your update was successful.');
});
Route::post('covidExposureNote/{id}', function (Illuminate\Http\Request $request, $id){
    $note = new Vanguard\CovidExposureNote ;

    $note->comment = $request->comment;
    $note->added_by = Auth()->user()->id;
    $note->pid = $id;
    $note->save();


    return  back()->with('success','Your have added a new note successfully.');
});
Route::get('updateExposureFu/{id}', function (Illuminate\Http\Request $request, $id){

    $exposure = Vanguard\CovidExposure::findorfail($id);
    $exposure->follow_up = Carbon\Carbon::now();
    $exposure->save();


    return  back()->with('success','Your have added a new note successfully.');
});

//END//

//Units//

Route::get('unit/modal/{id}', 'UnitsController@unitModal');
Route::get('unit/Service', 'UnitsController@vehicleStatusReport');
Route::get('unit/mileageWeekly', 'UnitsController@mileageWeekly');
Route::get('unit/unitManage', 'UnitsController@unitMatching');

Route::post('unit/Mileage', function (Illuminate\Http\Request $request) {

   $unit = Vanguard\Units::find($request->unit_id);

   $unit->odometer = $request->odometer;
   $unit->odometer_date = Carbon\Carbon::now();
   $unit->save();

   return response()->json([
    'odometer' => $unit->odometer
]);

});

//END//

//Kiosk//

Route::get('/kiosk', 'KioskController@index');

Route::get('/narcotic/boxCheck/{rfid}', function ($rfid) {

    $box = Vanguard\NarcoticBoxes::where('rfid', $rfid)->orWhere('box_number', $rfid)->first();

    $elogs = Vanguard\NarcoticLog::with('Employees')->where('status', 2)->get();

    if($box){
        return view('kiosk.partials.boxExist', compact('box', 'elogs'));
    }else{
        return view('kiosk.partials.boxDoesntExist');
    }


});

//endkiosk//

//Patient Routes
/*
Route::get('patients', [
    'as' => 'patients.index',
    'uses' => 'PatientsController@index',
    'middleware' => ['permission:patient.list']
]);

Route::get('patients/create', [
    'as' => 'patients.create',
    'uses' => 'PatientsController@create',
    'middleware' => ['permission:patient.create']
]);

Route::get('patients/store', [
    'as' => 'patients.store',
    'uses' => 'PatientsController@store',
    'middleware' => ['permission:patient.store']
]);

Route::get('patients/{$id}', 'PatientsController@show');

Route::get('patients/{$id}/edit', [
    'as' => 'patients.edit',
    'uses' => 'PatientsController@edit',
    'middleware' => ['permission:patient.edit']
]);
*/
Route::get('/autoBRSEmployee', function () {

    $brs = "";

    foreach ($brs as $row){

        $inserts =  Vanguard\BadRunSheetEmployee::where('bad_run_sheet_id', $row->id)->get();
        foreach($inserts as $in){
        $insert = Vanguard\BadRunSheetEmployee::find($in->id);
        $insert->status = $row->status;
        $insert->save();


        }
    }

    return 'Completed';

});

Route::get('/brsCompleteAll/{userid}', function ($userid) {


        $inserts =  Vanguard\BadRunSheetEmployee::where('user_id', $userid)->where('status', '<', 5)->get();
        foreach($inserts as $in){
        $insert = Vanguard\BadRunSheetEmployee::find($in->id);
        $insert->status = 5;
        $insert->save();


        $brs = Vanguard\BadRunSheet::find($in->bad_run_sheet_id);
        $brs->status = 5;
        $brs->save();

        $rst = new Vanguard\RunSheetTracking;

        $rst->status = 5;
        $rst->added_by = Auth::User()->id;
        $rst->pid = $in->bad_run_sheet_id;

        $rst->save();
        }


    return back();

});

Route::get('/medicaidCert/{pcs_id}', function ($pcs_id) {

    $pcs = Vanguard\PatientDoctorCert::with('patient', 'patient.qualification', 'patient.qualification.qualifier', 'patient.certifications', 'patient.certifications.pt_physician', 'patient.certifications.pt_physician.doctor')->find($pcs_id);

    return view('patients.reports.reportMedicaidPcs', compact('pcs'));

})->middleware('auth');

Route::get('medicaidCert/pdf/{pcs_id}', 'PatientsController@medicaidPdf');

Route::get('dash/patient', 'PatientsController@pdashboard')->name('patient.dash');

Route::post('/physicianAdd/', function (Illuminate\Http\Request $request) {

    $physician = Vanguard\Physician::create($request->all());

    $send['success'] = true;
    $send['result'] = $physician->toArray();
    return Response::json( $send );

});

Route::get('/otherCert/{pcs_id}', function ($pcs_id) {

    $pcs = Vanguard\PatientDoctorCert::with('patient', 'patient.qualification', 'patient.qualification.qualifier', 'patient.certifications', 'patient.certifications.pt_physician', 'patient.certifications.pt_physician.doctor')->find($pcs_id);

    return view('patients.reports.reportOtherPcs', compact('pcs'));

})->middleware('auth');

Route::post('/patientAddPhysician', function (Illuminate\Http\Request $request, $user) {

    $addPhysician = Vanguard\PatientPhysician::create($request->all());

    $note = new Vanguard\PatientTrackingNote;
    $transport_qualifier = "";
    $note->note = 'Added '. $addPhysician->doctor->first_name .' '. $addPhysician->last_name .' as patient physician.';
    $note->patient_id = $transport_qualifier->patient_id;
    $note->user_id = $user->id;
    $note->save();

    return back();

});

Route::post('/patientAddDoctorCert', function (Illuminate\Http\Request $request) {

    $start_date = $request->start_date;
    $start_date = date("Y-d-m", strtotime($start_date));
    $end_date = $request->end_date;
    $end_date = date("Y-d-m", strtotime($end_date));

    $cert = new Vanguard\PatientDoctorCert;

    $cert->start_date = $start_date;
    $cert->end_date = $end_date;
    $cert->patient_id = $request->patient_id;
    $cert->round_trip = $request->round_trip;
    $cert->pick_up_address = $request->pick_up_address;
    $cert->drop_off_address = $request->drop_off_address;
    $cert->procedure_code = $request->procedure_code;
    $cert->physician_id = $request->physician_id;
    $cert->number_of_transports = $request->number_of_transports;

    $cert->save();

    $note = new Vanguard\PatientTrackingNote;

    $note->note = 'New physician certification added ';
    $note->patient_id = $cert->patient_id;
    $note->user_id = Auth()->user()->id;
    $note->save();

    return back();

});

Route::post('/patientAddInsurance', function (Illuminate\Http\Request $request) {

    $effective_date = $request->effective_date;
    $effective_date = date("Y-d-m", strtotime($effective_date));
    $term_date = $request->end_date;
    $term_date = date("Y-d-m", strtotime($term_date));

    $ins = new Vanguard\PatientInsurance;

    $ins->patient_id = $request->patient_id;
    $ins->carrier_id = $request->carrier_id;
    $ins->group_id = $request->group_id;
    $ins->policy_id = $request->policy_id;
    $ins->effective_date = $effective_date;
    $ins->term_date = $term_date;
    $ins->is_primary = $request->primary;
    $ins->status = $request->status;

    $ins->save();

    $note = new Vanguard\PatientTrackingNote;

    $note->note = 'New insurance added to patient profile. ';
    $note->patient_id = $request->patient_id;
    $note->user_id = Auth()->user()->id;
    $note->save();

    return back();

});

Route::post('/patientAddCondition', function (Illuminate\Http\Request $request) {

    $condition = new Vanguard\PatientMedicalHistory;

    $condition->patient_id = $request->patient_id;
    $condition->condition_id = $request->condition_id;
    $condition->reported_by = $request->reported_by;
    $condition->added_by = Auth()->user()->id;

    $condition->save();

    $note = new Vanguard\PatientTrackingNote;

    $note->note = 'New insurance added to patient profile. ';
    $note->patient_id = $request->patient_id;
    $note->user_id = Auth()->user()->id;
    $note->save();

    return back();

});

Route::post('/addFacility', function (Illuminate\Http\Request $request) {

    $facility = Vanguard\Facilities::create($request->all());

    $send['success'] = true;
    $send['result'] = $facility->toArray();
    return Response::json( $send );

});

Route::post('/patientAddTransportQualifier/{user_id}', function (Illuminate\Http\Request $request, $user_id) {


    $tc = Vanguard\TransportQualifier::find($request->transport_qualifier_id);

    $expiration = Carbon\Carbon::now()->addDays($tc->renew);

    $expiration = Carbon\Carbon::parse($expiration)->format('Y-m-d');

    $request->request->add(['expire' => $expiration]);

    $transport_qualifier = Vanguard\PatientTransportQualifier::create($request->all());

    $note = new Vanguard\PatientTrackingNote;

    $note->note = 'New transport qualifier '. $transport_qualifier->qualifier->description .'secondary to '. $transport_qualifier->pt_condition->condition->label .'.';
    $note->patient_id = $transport_qualifier->patient_id;
    $note->user_id = $user_id;
    $note->save();

    return back();

});

Route::post('/wheelchairChange', function (Illuminate\Http\Request $request) {

    $patient = Vanguard\Patients::find($request->id);

    $patient->safe_wheelchair = $request->safe_wheelchair;

    $patient->save();

    $note = new Vanguard\PatientTrackingNote;
    if($request->safe_wheelchair == 0)
    {
        $status= "unalbe to safely sit in wheel chair";
    }else{
        $status= 'is able to safely sit in wheel chair';
    }
    $note->note = 'Patients wheelchair status has been updated to '. $status ;
    $note->patient_id = $request->id;
    $note->user_id = Auth()->user()->id;
    $note->save();

    return $response='Patients wheelchair status has been updated to '. $status ;

});

Route::post('/bedConfined', function (Illuminate\Http\Request $request) {

    $patient = Vanguard\Patients::find($request->id);

    $patient->bed_confined = $request->bed_confined;

    $patient->save();

    $note = new Vanguard\PatientTrackingNote;
    if($request->bed_confined == 0)
    {
        $status= "not bed confined.";
    }else{
        $status= 'bed confined ';
    }
    $note->note = 'Patients bed confinement status has been updated to '. $status  ;
    $note->patient_id = $request->id;
    $note->user_id = Auth()->user()->id;
    $note->save();

    return $response ='Patients bed confinement status has been updated to '. $status;

});

Route::get('/transportQualifier/renew/{id}', function ( $id) {

    $patient = Vanguard\PatientTransportQualifier::find($id);

    $patient->expire = Carbon\Carbon::parse($patient->expire)->addDays(60);

    $patient->save();

    $note = new Vanguard\PatientTrackingNote;

    $note->note = 'Patient transport qualifier '. $patient->qualifier->description.' renewed for 60 days.'  ;
    $note->patient_id = $patient->patient_id;
    $note->user_id = Auth()->user()->id;
    $note->save();

    return $response ='Patient transport qualifier '. $patient->qualifier->description.' renewed for 60 days.'  ;

});

Route::get('/transportQualifier/remove/{id}', function ( $id) {

    $patient = Vanguard\PatientTransportQualifier::find($id);

    $patient->status = 9999;

    $patient->save();

    $note = new Vanguard\PatientTrackingNote;

    $note->note = 'Patient transport qualifier '. $patient->qualifier->description.' has been removed.'  ;
    $note->patient_id = $patient->patient_id;
    $note->user_id = Auth()->user()->id;
    $note->save();

    return $response ='Patient transport qualifier '. $patient->qualifier->description.' has been removed.'  ;

});

Route::get('/transportQualifier/active/{id}', function ( $id) {

    $patient = Vanguard\PatientTransportQualifier::find($id);

    $patient->status = 2;

    $patient->save();

    $note = new Vanguard\PatientTrackingNote;

    $note->note = 'Patient transport qualifier '. $patient->qualifier->description.' has been updated to active.'  ;
    $note->patient_id = $patient->patient_id;
    $note->user_id = Auth()->user()->id;
    $note->save();

    return $response ='Patient transport qualifier '. $patient->qualifier->description.' has been updated to active.'  ;

});

//End//

//Dispatch Routes//
Route::get('/incident/alerts/{id}', function ($id){
   $alerts = \Vanguard\DispatchAlerts::where('incident_id', $id)->get();

   return view('dispatch.partials.incidentAlertsTable', compact('alerts'));
});

Route::get('dispatch', [
    'as' => 'dispatch.view1',
    'uses' => 'DispatchController@view1',
    'middleware' => ['permission:dispatch.view']
]);

Route::post('dispatch/signon', [
    'as' => 'dispatch.signon',
    'uses' => 'DispatchController@signon',
    'middleware' => ['permission:dispatch.status']
]);

Route::get('dispatch/units', [
    'as' => 'dispatch.units',
    'uses' => 'DispatchController@units',
    'middleware' => ['permission:dispatch.pending']
]);

Route::get('dispatch/pending', [
    'as' => 'dispatch.pending',
    'uses' => 'DispatchController@pending',
    'middleware' => ['permission:dispatch.pending']
]);

Route::post('dispatch/transport', [
    'as' => 'dispatch.transport',
    'uses' => 'DispatchController@transport',
    'middleware' => ['permission:dispatch.status']
]);

Route::post('dispatch/message/{uid}', [
    'as' => 'dispatch.message',
    'uses' => 'DispatchController@crew_message',
    'middleware' => ['permission:dispatch.status']
]);

Route::get('dispatch/card/{id}/{security}', [
    'as' => 'dispatch.card',
    'uses' => 'DispatchController@card',
]);

use Illuminate\Support\Facades\Route;
use Vanguard\DispatchFilters;
use Vanguard\Http\Controllers\Web\FinancialAssistanceController;
use Vanguard\Http\Controllers\Web\MechanicTasksController;
use Vanguard\ToDo;

Route::get('pending', function (DispatchFilters $filters) {
    $pending = Vanguard\DispatchIncident::filter($filters)->get();
    return view('dispatch.partials.card_pending', compact( 'pending'));
});

Route::get('active', function (DispatchFilters $filters) {
    $active =  Vanguard\DispatchIncident::filter($filters)->get();
    return view('dispatch.partials.card_dispatch', compact( 'active'));
});

/*Route::view('pending', 'dispatch.partials.card_pending', [
    'pending' => Vanguard\DispatchIncident::get()
]);*/

/*Route::view('active', 'dispatch.partials.card_dispatch', [
    'active' => Vanguard\DispatchIncident::get()
]);*/
Route::get('active_units', function (DispatchFilters $filters) {
    $units =  Vanguard\UnitSchedule::filter($filters)->get();
    return view('dispatch.partials.card_avail_units', compact( 'units'));
});


Route::get('dispatch/active', [
    'as' => 'dispatch.active',
    'uses' => 'DispatchController@active',
    'middleware' => ['permission:dispatch.active']
]);

Route::post('dispatch/store', [
    'as' => 'dispatch.store',
    'uses' => 'DispatchController@store',
    'middleware' => ['permission:dispatch.status']
]);

Route::get('dispatch/dispatch/{id}/{uid}', [
    'as' => 'dispatch.dispatch',
    'uses' => 'DispatchController@dispatched',
    'middleware' => ['permission:dispatch.status']
]);

Route::get('unit_modal/{id}', [
    'uses' => 'DispatchController@unit_modal',
    'middleware' => ['permission:dispatch.status']
]);

Route::get('available_units/{id}', [
    'uses' => 'DispatchController@available_units',
    'middleware' => ['permission:dispatch.status']
]);

Route::post('dispatch/unit', [
    'as' => 'dispatch.unit',
    'uses' => 'DispatchController@unitmodal',
    'middleware' => ['permission:dispatch.status']
]);

Route::get('dispatch/status/{id}/{status}/{iid}', [
    'as' => 'dispatch.status',
    'uses' => 'DispatchController@status',
    'middleware' => ['permission:dispatch.status']
]);

Route::get('ptatient_autocomplete', 'PatientsController@autocomplete')->name('patient_autocomplete');


Route::get('payperiod_add', 'PayPeriodController@PayPeriods');

Route::post('fa/signatue/{id}', 'FinancialAssistanceController@signature')->name('fa.signature');
Route::post('fa/signatue/doe/{id}', 'FinancialAssistanceController@signaturedoe');
Route::post('fa/signatue/admin/{id}', 'FinancialAssistanceController@signatureadmin');
Route::post('fa/signatue/super/{id}', 'FinancialAssistanceController@signaturesuper');
Route::get('fa/review/pdf/{id}', 'FinancialAssistanceController@pdf');

Route::get('fa/review/{id}', 'FinancialAssistanceController@review');

//End Dispatch//


Route::get('dispatch/status/{id}/{status}/{iid}', [
    'as' => 'dispatch.status',
    'uses' => 'DispatchController@status',
    'middleware' => ['permission:dispatch.status']
]);

//DB Check //

Route::get('/dbcheck', function(){
    // Test database connection
    try {
        DB::connection('sqlsrv')->getPdo();
        if(DB::connection()->getDatabaseName()){
            echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
        }else{
            die("Could not find the database. Please check your configuration.");
        }
    } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration. error:" . $e );
    }
});

//Bucyrus//
Route::get('buc/list', [
    'as' => 'bucyrus.list',
    'uses' => 'BucyrusController@list',

]);

Route::get('buc/monthlyReport', [
    'as' => 'bucyrus.monthlyreport',
    'uses' => 'BucyrusController@monthlyReport',

]);

Route::get('/dispatch/unitMDT', function () {

    return view('dispatch.unitMdt');
});

Route::post('/dispatch/unitMDT', [

    'uses' => 'DispatchController@unitMdt',

]);

Route::get('buc/get_twp/{id}', function ($id) {
    $townships = Vanguard\BucyrusTownship::find($id);
    return $townships;
});
//END Bucyrus//

//Garage Routes//
Route::post('garage/available_parts', 'AvailablePartsController@store');
Route::post('garage/add/parts', 'PartController@store');
Route::post('garage/remove/parts', 'PartController@destroy');
Route::post('garage/remove/parts/multi', 'PartController@destroyMulti');
Route::get('garage/repair/report/{id}', 'MechanicTasksController@completionReport');
Route::get('garage/repair/completeAll/{id}', 'MechanicTasksController@completeAllTasks');
Route::get('garage/repair/report/{id}', 'MechanicTasksController@completionReport');
Route::get('garage/mechanic/dash', 'MechanicTasksController@mechanicDashboard');
Route::get('garage/serviceTicket/{id}', 'MechanicTasksController@serviceTicket');
Route::post('newServiceTicket/{id}', 'MechanicTasksController@newServiceTicket');
Route::get('completedServiceTicket/{id}', 'MechanicTasksController@serviceTicketReport');
Route::post('garage/assignMe', 'MechanicTasksController@assignMe');
Route::get('/fireEvent', function (){
   event(new Vanguard\Events\eventTrigger('Someone'));
    return "Event has been sent!";
});
Route::get('/myServiceTickets', function (){
    $tickets = Vanguard\RepairTicket::where('user_id', Auth()->user()->id)->where('status', 1)->get();

    return view('mechanic.partials.myServiceTickets', compact('tickets'));
 });
 

 Route::get('/garage/notes/{id}', function ($id){
    $notes = Vanguard\MechanicTaskNote::where('task_id', $id)->get();

    return view('mechanic.partials.modalBodyViewNotes', compact('notes'));
 });

 Route::get('/garageMyServiceTickets', function (){
    $tickets = Vanguard\RepairTicket::where('user_id', Auth()->user()->id)->where('status', 1)->get();

    return view('mechanic.partials.myServiceTicketsList', compact('tickets'));
 });
 Route::get('/garageAllMyServiceTickets', function (){
    $tickets = Vanguard\RepairTicket::where('user_id', Auth()->user()->id)->where('status', 3)->get();

    return view('mechanic.partials.myServiceTicketsList', compact('tickets'));
 });
Route::get('/garageMyPending', function (){
    $jobs = Vanguard\UnitMalfunctionReport::where('user_id', Auth()->user()->id )->where('status', 1)->get();

    return view('mechanic.partials.dashboardMyPending', compact('jobs'));
 });

 Route::get('/garagePending', function (){
    $jobs = Vanguard\UnitMalfunctionReport::where('status', 0 )->get();

    return view('mechanic.partials.dashboardpending', compact('jobs'));
 });
 
Route::get('/notification', 'PusherNotificationController@sendNotification');

Route::post('/mechanicTask/addNote', function (Illuminate\Http\Request $request) {

     $note = new Vanguard\MechanicTaskNote;

     $note->task_id = $request->task_id;
     $note->note = $request->note;
     $note->user_id = Auth()->user()->id;

     $note->save();

     return back();

})->middleware('auth');

Route::get('/garage/assignMe/{id}', function ($id) {

    $job = Vanguard\UnitMalfunctionReport::find($id);

    $job->status = 1;
    $job->user_id = Auth()->user()->id;
    $job->save();

    return back();

})->middleware('auth');

Route::post('/serviceNewTask', function (Illuminate\Http\Request $request) {

    $report = new Vanguard\UnitMalfunctionReport;
    $report->unit = $request->unit_id;
    $report->added_by = Auth()->user()->id;
    $report->comments = 'Problem found while servicing vehicle.';
    $report->pid = $request->rid;
    $report->user_id = Auth()->user()->id;
    $report->status = 1;
    $report->save();
    
    $request->request->add(['mechanic_assigned' => Auth()->user()->id, 'start_date' => Carbon\Carbon::now(), 'status' => 1, 'pid' => $report->id ]);
    
    $task = Vanguard\MechanicTask::create($request->all());

   

    return back();

})->middleware('auth');

Route::post('/updateTicketItem/{id}', function (Illuminate\Http\Request $request, $id) {
  
    $ticket= Vanguard\RepairTicket::find($id);

    $ticket->fill($request->all())->save();

    return back()->with('success', 'You have updated the service ticket.');

})->middleware('auth');

Route::get('/safetyReport', function () {
  
    $questions = Vanguard\VehicleSafetyInspectionQuestion::where('status', 1)->get();
    return view('mechanic.partials.formSafetyReport', compact('questions'));

})->middleware('auth');

Route::post('/safetyReportSave/{id}', 'MechanicTasksController@safetyReportAdd');

Route::get('/towResponse', function () {

     return view('mechanic.towResponse');

});
//End Garage//


//Classroom Routes//
Route::get('classroom/dashboard/{id}', 'ClassroomController@dashboard')->name('classroom');
Route::get('classroom/dashboard/report/rosterStation/{id}', 'ClassroomController@rosterByStation');
Route::get('classroom/quiz/attempts/{pid}', 'ClassroomController@quizAttempts');
Route::post('classroom/quiz/answer', 'ClassroomController@quizAnswerStore')->name('ClassRoomAnswer.store');
Route::get('classroom/youTube/{id}', 'ClassroomController@youTube');
Route::get('classroom/quiz/attempts/quizAttempt/{qid}', 'ClassroomController@newQuizAttempt');
Route::get('classroom/quiz/quizAttempt/{aid}/{qid}', 'ClassroomController@quiz');
Route::get('classroom/quiz/attempts/question/{aid}/{qid}', 'ClassroomController@quizQuestion');
Route::post('classroom/quiz/attempts/question/answer/{aid}/{qid}/{questionId}', 'ClassroomController@quizQuestionAnswered');
Route::get('classroom/download/{tid}/{fileName}', 'ClassroomController@getDownload');
Route::get('classroom/certificate/{id}', 'ClassroomController@certificate');
Route::get('classroom' , 'ClassroomController@courseMenu');
Route::post('classroom/connectEmployee', 'ClassroomController@connectEmployee');
Route::get('/classroom/connectEmployee/{id}', function ($id) {

     $employees = Vanguard\Employee::get();

     return view('classroom.partials.connectEmployeeContent', compact( 'employees', 'id'));

})->middleware('auth');
Route::get('classroom/quizQuestions/{qid}/{cid}', function ($qid, $cid) {

    $questions =  Vanguard\ClassRoomQuizQuestions::where('quiz_id', $qid)->get();

    $instructors = Vanguard\ClassRoomInstructor::where('classroom_id', $cid)->where('user_id', auth()->user()->id)->first();

        if($instructors){
            $instructor= true;

          // dd($instructor);
        }else{
            $instructor = false;
        }

    return view('classroom.quizQuestions', compact( 'questions', 'instructor', 'cid', 'qid'));

})->middleware('auth');

Route::get('classroom/addQuestion/{qid}/{cid}', function ($qid, $cid) {
    $instructors = Vanguard\ClassRoomInstructor::where('classroom_id', $cid)->where('user_id', auth()->user()->id)->first();

        if($instructors){
            $instructor= true;

          // dd($instructor);
        }else{
            $instructor = false;
        }

    return view('classroom.addQuestion', compact( 'questions', 'instructor', 'cid', 'qid'));
})->middleware('auth');
Route::get('classroom/addAnswer/{qid}/{quiz}', function ($qid, $quiz) {

    $question =  Vanguard\ClassRoomQuizQuestions::find($qid);



    $q = Vanguard\ClassroomQuiz::find( $quiz);


    return view('classroom.addAnswer', compact('question','qid', 'q'));
})->middleware('auth');
Route::post('classroom/addQuestion', 'ClassroomController@addQuestion');
Route::post('classroom/addAnswer', 'ClassroomController@addAnswer');
Route::get('classroom/addQuiz/{sid}', function ($sid) {
    $section =  Vanguard\ClassRoomSections::find($sid);
    return view('classroom.addQuiz', compact( 'section'));
})->middleware('auth');
Route::post('classroom/addQuiz', 'ClassroomController@addQuiz');
Route::get('classroom/addYoutube/{sid}', function ($sid) {
    $section =  Vanguard\ClassRoomSections::find($sid);
    return view('classroom.addYoutube', compact( 'section'));
})->middleware('auth');
Route::post('classroom/addYoutube', 'ClassroomController@addYoutube');
Route::get('classroom/addPdf/{sid}', function ($sid) {
    $section =  Vanguard\ClassRoomSections::find($sid);
    return view('classroom.addPdf', compact( 'section'));
})->middleware('auth');
Route::post('classroom/addPdf', 'ClassroomController@addPpt');
Route::get('classroom/addPpt/{sid}', function ($sid) {
    $section =  Vanguard\ClassRoomSections::find($sid);
    return view('classroom.addPpt', compact( 'section'));
})->middleware('auth');
Route::post('classroom/addPpt', 'ClassroomController@addPpt');
Route::get('/classroom/addVimeo/{sid}', function ($sid) {
    $section =  Vanguard\ClassRoomSections::find($sid);
    return view('classroom.addVimeo', compact( 'section'));
})->middleware('auth');
Route::post('/classroom/addVimeo', 'ClassroomController@addVimeo');
Route::get('classroom/addGrade/{sid}', 'ClassroomController@addGrade');
Route::get('classroom/vimeo/{id}', function ($id) {
    $topic =  Vanguard\ClassRoomSectionTopic::find($id);
    $userTopic = Vanguard\ClassroomTopicTracking::where('topic_id', $id)->where('user_id', Auth()->user()->id)->first();

    return view('classroom.vimeo', compact( 'topic', 'userTopic'));
})->middleware('auth');

Route::get('classroom/vimeo/paused/{id}/{time}', function ($id, $time) {

    $userTopic = Vanguard\ClassroomTopicTracking::where('topic_id', $id)->where('user_id', Auth()->user()->id)->first();
    $userTopic->video_time = $time;
    $userTopic->save();

    return 'success';
})->middleware('auth');

Route::get('classroom/vimeo/complete/{id}', function ($id) {
    $topic =  Vanguard\ClassRoomSectionTopic::find($id);
    event(new Vanguard\Events\StudentHasViewedSectionEvent($topic));
    return 'success';
})->middleware('auth');



//End Classroom//

// Messaging //
Route::get('/sms/send/{to}', function(\Nexmo\Client $nexmo, $to){
    $message = $nexmo->message()->send([
        'to' => $to,
        'from' => '13095902321',
        'text' => 'Sending SMS from Laravel. Woohoo!'
    ]);
    Log::info('sent message: ' . $message['message-id']);
});

Route::post('dispatch/alert', function(Illuminate\Http\Request $request){
    //dd($request->locality);
   $house = $request->house;
   $street = substr($request->street, 0, 4);
   $city = $request->city;
   $state = $request->state;
   $address = '';
    //dd($house);
   if($house){
       if($house or $street){
           $alerts =  Vanguard\AddressFlag::
           when($house , function ($q) use($house, $street){
               $q->where('house_number', $house);
               $q->where('street', 'like', $street. '%');
               return $q;
           })
               ->when($address , function ($q) use($address){
                   $q->where('unknown_address', $address) ;
                   return $q;
               })
               ->get();
       }else{
           $alerts = [];
       }
   }else{
       if($street){
           //dd($street);
           $alerts =  Vanguard\AddressFlag::
           when($street , function ($q) use($street){
               $q->where('street', 'like', $street. '%' );
               return $q;
           })
               ->when($address , function ($q) use($address){
                   $q->where('unknown_address', $address) ;
                   return $q;
               })
               ->get();
       }else{
           $alerts = [];
       }
   }

   //dd($house);


    app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Searched dispatch address alert on '.$house.' '.$request->street);

    //dd($alerts);

    return view('dispatch.partials.modalAddressAlert', compact('alerts'));
});

Route::get('dispatch/alertScreen', function (){

    return view('dispatch/AlertsSearch');
})->middleware('auth');

Route::get('/sms/inbound', function(\Nexmo\Client $nexmo){
    $message = \Nexmo\Message\InboundMessage::createFromGlobals();
    $reply =$nexmo->message()->send($message->createReply('Laravel Auto-Reply FTW!'));
    Log::info('sent reply: ' . $reply['message-id']);
    return response()->json(['success' => 'success'], 200);
});
// End //

// Asset Tracking //
Route::get('/assetDashboard', 'AssetController@index');
Route::post('/assetEdit/{id}', 'AssetController@edit');
Route::post('/assetNew' , 'AssetController@store');
Route::get('/asset/{id}', 'AssetController@show');
Route::post('/assetSupportRequest', 'AssetController@supportRequest');
Route::post('/assetSupportNote', 'AssetController@supportNote');
Route::get('/assetTicketNotes/{id}', [
    'uses' => 'AssetController@supportNotes'
]);
Route::get('/supportTickets', 'AssetController@supportTickets');
Route::get('/supportTickets/Pending', 'AssetController@pendingReport');
Route::post('/attachAsset', 'AssetController@attachAsset');
Route::post('/updateAssetSupportRequest/{id}', 'AssetController@updateSupportRequest');
Route::post('/assignTicket', 'AssetController@assignTicket');
Route::get('/ticketAssignMe/{id}', function ($id) {
    $ticket =  Vanguard\ItSupportTicket::find($id);
    $ticket->user_id = auth()->user()->id;
    $ticket->save();
    return back();
});

Route::get('/support/ticket/{id}', function ($id) {
    $ticket =  Vanguard\ItSupportTicket::find($id);
    $ticket->user_id = auth()->user()->id;
    $employees = Vanguard\Employee::get();
    $assets = Vanguard\Asset::get();
    $stations = Vanguard\Station::where('status', 0)->get();
    return view('assets.partials.formIndexEditSupportRequest', compact('assets', 'ticket', 'employees', 'stations'));
});

Route::get('/ticketWorking/{id}', function ($id) {
    $ticket =  Vanguard\ItSupportTicket::find($id);
    $ticket->status = 2;
    $ticket->save();

    $note = new Vanguard\ItSupportTicketNote;

    $note->description = 'Ticket has been marked work in progress.';
    $note->it_support_ticket_id = $id;
    $note->added_by = auth()->user()->id;

    $note->save();

    return back();
});
Route::get('/ticketComplete/{id}', function ($id) {
    $ticket =  Vanguard\ItSupportTicket::find($id);
    $ticket->status = 99;
    $ticket->date_completed = Carbon\Carbon::now();
    $ticket->save();

    $note = new Vanguard\ItSupportTicketNote;

    $note->description = 'Ticket has been marked completed.';
    $note->it_support_ticket_id = $id;
    $note->added_by = auth()->user()->id;

    $note->save();

    return back();
});


//End Asset Tracking //

//Ambulance Check Sheet//
Route::get('inspection/ambulance/create', 'AmbulanceInspectionController@create');
Route::post('inspection/ambulance', 'AmbulanceInspectionController@store');

// End ACS//


//message routes//
Route::get('/chat', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');
//End Message Routes//

//Notification//
Route::get('notification/read/{id}', 'NotificationsController@read');
//
Route::get('garage/available_parts', 'AvailablePartsController@index');

//HR Routes//
Route::get('stations', 'HumanResourcesController@stations')->name('stations');
Route::get('course/required', 'HumanResourcesController@required_course_report');
Route::get('course/updatecc', 'HumanResourcesController@update_cc');
Route::get('hrr/admin', 'HumanResourcesController@admin');
Route::get('hrr/admin/filter', 'HumanResourcesController@adminFilter');
Route::get('hrr/pdf', 'HumanResourcesController@pdf');

//End HR //

//Todos Routes//
Route::get('task/complete/{id}', 'ToDoController@complete');
Route::get('task/uncomplete/{id}', 'ToDoController@uncomplete');
Route::get('task/active/{id}', 'ToDoController@active');
Route::post('task/note', 'ToDoController@note')->name('task.note');

//End ToDos //

//Employee Application//
Route::get('application/create', 'ApplicationController@create')->name('application.create');
Route::post('application/store', 'ApplicationController@storeNew')->name('application.store');
Route::post('application/store/workhx', 'ApplicationController@store_workhx')->name('application.store_workhx');
Route::post('application/store/schoolhx', 'ApplicationController@store_schoolhx')->name('application.store_schoolhx');
Route::post('application/store/interviewform', 'ApplicationController@store_interview')->name('application.store_interviewform');
Route::post('application/store/state', 'ApplicationController@store_state')->name('application.store_state');
Route::get('application/pdf', 'ApplicationController@pdf')->name('application.pdf');
Route::post('emp/competency/complete', 'EmployeeController@emp_competency')->name('competencies.complete');
Route::get('emp/competency/assign', 'EmployeeController@assign_competencies')->name('competencies.assign');
Route::get('emp/competency/completed', 'EmployeeController@completed_competencies');
Route::get('employee/fema', 'EmployeeController@responseteam');

//End Application//

//Ride Waiver//
Route::get('rider', 'RiderController@ride');
Route::post('rider/store', 'RiderController@waiver')->name('rider.store');

//End//


Route::get('timeclock.punch', 'PunchController@punch')->name('timeclock.punch');
Route::get('timeclock.list', 'TimePunchControoler@index')->name('timeclock.list');

Route::get('pa', 'PaAssistController@index');

//Report routes//
Route::get('report/admindaily', 'ReportController@admin_daily')->name('report.admindaily');
Route::get('report/driverstatus', 'ReportController@driver_status')->name('report.driverstatus');
Route::get('report/competencies', 'ReportController@required_competencies');
Route::get('report/competency/{station}/{competency}/{level}', 'ReportController@station_competency');
Route::get('report/attrition', 'ReportController@attrition');
Route::get('report/qaqi/incidentByStation', 'ReportController@incidentByStation');
Route::get('report/competencyReportPDF', 'ReportController@competencyReport');
Route::get('report/n95', 'ReportController@fitTestReportByStation');
Route::get('report/n95/forms', 'ReportController@fitTestFormPrint');
Route::get('report/n95q/forms', 'ReportController@fitTestFormPrintQ');
Route::get('report/dfw', 'ReportController@dfwAnnual');

//end reports//

//logistics additional routes//
Route::get('logistic.overview', 'LogisticsController@overview')->name('logistic.overview');
Route::post('logistic/mnbstore', 'LogisticsController@mnbstore')->name('logistic.mnbstore');
Route::put('logistic/mnbupdate/{id}', 'LogisticsController@mnbupdate')->name('logistic.mnbupdate');
Route::get('logistic/mnbcreate', 'LogisticsController@mnbcreate')->name('logistic.mnbcreate');
Route::get('logistic/mnbindex', 'LogisticsController@mnbindex')->name('logistic.mnbindex');
Route::get('logistic/safereport', 'LogisticsController@safereport')->name('logistic.safereport');
Route::post('boxnewmed', 'ControlledSubstancesController@boxnewmed')->name('boxnewmed');
Route::get('/boxreport', 'NarcoticBoxesController@boxreport')->name('boxreport');
Route::post('/narcotic/verifyBox', 'PunchController@verifyBox');
Route::get('/stationboxreport', 'NarcoticBoxesController@stationboxreport')->name('stationboxreport');
Route::get('/stationboxreportbydate', 'NarcoticBoxesController@stationboxreportbydate');
Route::post('/wasteform', 'VialLogController@wasteform')->name('wasteform');
Route::get('narcoticStatus', 'NarcoticLogController@narcoticStatus');
Route::get('logistic.waste', 'LogisticsController@wastetable')->name('logistic.waste');
//end logistics//

//Company Meeting Routes///



//End Company Meeting //

//administration routes//
Route::get('admin/calendar', 'AdministrationController@calendar')->name('admin.calandar');
//endadministration


//attendance additional routes//
Route::get('attend/list', 'AttendanceController@list')->name('attend.list');
Route::get('attend/multi', 'AttendanceController@multi')->name('attend.multi');
Route::get('attend/report', 'AttendanceController@report')->name('attend.report');
Route::get('attend/excell', 'AttendanceController@excell')->name('attend.excell');
Route::get('attendance.noclock', 'AttendanceController@noclock')->name('attendance.noclock');
Route::get('/attend/{id}/delete', ['uses' => 'AttendanceController@destroy', 'as' => 'attend.delete']);
//end attendance//

//employees addditional routes //
Route::get('employee/excel', 'EmployeeController@excell')->name('employee.excel');
Route::post('/employeephoto','EmployeeController@attachmentSubmit');
Route::post('fto/store', 'FieldTrainingDate@store')->name('fto.store');
Route::post('fto/ndComplete/{userId}', 'FieldTrainingDate@ndComplete');
Route::post('fto/fieldComplete/{userId}', 'FieldTrainingDate@fieldComplete');
Route::post('fto/driverComplete/{userId}', 'FieldTrainingDate@driverComplete');
Route::get('fto/dashboard', 'FieldTrainingDate@dashboard')->name('fto.dashboard');
Route::get('fto/dashboard/{userid}', 'FieldTrainingDate@userDashboard')->name('fto.dashboard');
Route::get('fto/modal/{userId}', 'FieldTrainingDate@ftoModalBody');
Route::get('fto/tasksAdd/{userId}', 'FieldTrainingDate@ftoTaskAdd');
Route::get('fto/ftoComplete/{userId}/{taskId}', 'FieldTrainingDate@ftoTaskComplete');
Route::get('fto/completeAllTasks/{userId}', 'FieldTrainingDate@completeAllTasks');
Route::get('fto/traineeComplete/{userId}/{taskId}', 'FieldTrainingDate@traineeTaskComplete');
Route::get('/fto/addDriverCheck/{id}', function ($id) {
    $trainee =  Vanguard\Employee::where('user_id', $id)->first();
    $employees =  Vanguard\Employee::get();
    return view('fto.partials.addDrivingCheckOffModalBody', compact( 'trainee', 'employees'));
})->middleware('auth');
Route::post('/fto/addDriverCheck', 'FieldTrainingDate@addDriverCheck');
Route::post('/fto/updateDriverCheckMiles', 'FieldTrainingDate@updateDriverCheckMiles');

//end employees


//compliance additional routes//
Route::get('encounter/report', 'ComplianceController@encounterreport')->name('encounter.report');
Route::get('incidentreport', 'ComplianceController@incidentreport')->name('incidentreport');
Route::get('/incidentreport/pdf/{id}','IncidentReportController@export_pdf');
Route::post('incidentreport/store', 'ComplianceController@incidentreportstore')->name('incidentreport.store');
Route::post('/encounterattachments','ComplianceController@attachmentSubmit');
Route::get('/fileDownload', 'ComplianceController@download');
Route::post('policy/acknowledge/{id}', 'PolicyController@sign')->name('policy.acknowledge');
Route::get('/encounterreport/pdf/{id}','ComplianceController@encounter_pdf');
Route::get('attend/{id}', 'ComplianceController@employeeattend');
//end compliance//



//bad run sheets additional routes//
Route::put('badrunsheets.onclick', 'BadRunsheetController@oneclick')->name('badrunsheets.oneclick');
Route::get('brs/weekly', 'BadRunsheetController@weeklyreport');
Route::get('/brs/weekly/pdf','BadRunsheetController@weeklyreportpdf');
Route::get('/brs/pdf/edit/{id}', 'BadRunsheetController@pdfEdit');
Route::get('/brs/allBilling/{userId}', 'BadRunsheetController@allBilling');
//


//MVC controllers
Route::get('mvc2/{id}', 'CrashController@part2');
//end MVC

//Mechanic Controllers//
Route::get('/mechanic/fetch_data', 'MechanicTasksController@fetch_data');
Route::get('/mechanics/assign', 'MechanicTasksController@assign');
Route::get('/mechanics/{id}/delete', ['uses' => 'MechanicTasksController@destroy', 'as' => 'mechanic.delete']);


//Accounting Controllers//
Route::get('employee.payroll_report', 'EmployeeController@currentpayroll')->name('currentpayroll.report');
Route::post('accounting.payrollreport', 'AccountingController@payrollreport')->name('accounting.payrollreport');
Route::post('accounting.attendancereport', 'AccountingController@attendancereport')->name('accounting.attendancereport');
Route::get('/ftopay/pdf','FieldTrainingDate@ftopay_pdf');
//end Accounting//



//Education Controllers//
Route::post('/observerattachments','ObserverController@attachmentSubmit');
Route::get('inspection', function (){
   $courses = \Vanguard\Courses::get();

   return view('classes.reports.inspection', compact('courses'));
});
Route::get('certificate/{id}/{student}', 'ClassesController@certificate')->name('certificate');
//Route::get('lesson', 'LessonController@lessoncomplete')->name('lesson.complete');
Route::post('lesson-complete', 'LessonController@lessoncomplete')->name('lesson.complete');
Route::post('enrolled/group', 'EnrolledStudentController@group')->name('enrolled.group');
Route::get('qa/createreport', 'QaQiController@createreport')->name('qa.createreport');
Route::get('qa/report', 'QaQiController@report')->name('qa.report');
Route::get('/qa/report/pdf/{start}/{end}','QaQiController@reportpdf');
Route::get('/scholarship/report/pdf/{id}','ScholarshipController@scholarship_pdf');
Route::post('/scholarship/addNewCourse','ScholarshipController@addNewCourse');
Route::get('/scholarship/studentInfo/pdf/{id}','ScholarshipController@studentInfo');
Route::get('/scholarship/roster/pdf/{id}','ScholarshipController@roster');
Route::get('/scholarship/create','ScholarshipsController@application');
Route::post('/scholarship/application/store','ScholarshipsController@application_store');
Route::get('/scholarship/class/{id}', 'ScholarshipController@ScholarshipIndex');
Route::post('/scholarship/studentUpdate', 'ScholarshipController@studentUpdate');
Route::get('/autocomplete', 'AutoCompleteController@index');
Route::get('/scholarships/contract/{id}', 'ScholarshipController@contract');
Route::get('/scholarship/entrance_mail/{id}', 'ScholarshipController@entrance_mail');
Route::get('/scholarship/acceptance/{id}', 'ScholarshipController@acceptance_mail');
Route::post('scholarships/signature', 'ScholarshipController@contract_signature')->name('scholarships.signature');
Route::post('/autocomplete/fetch', 'AutoCompleteController@fetch')->name('autocomplete.fetch');
Route::post('qa/acknowledge/{id}', 'QaQiController@acknowledge')->name('qa.acknowledge');
Route::get('qa/pdf/{id}', 'QaQiController@qapdf')->name('qa.pdf');
//Route::get('/enrolled/{user_id}/{class_id}/complete', ['uses' => 'EnrolledStudentController@complete', 'as' => 'enrolled.complete']);
Route::post('/enrolled/complete', 'EnrolledStudentController@complete')->name('enrolled.complete');
Route::get('enrolled/{id}/{courseId}', [
    'as' => 'enrolled.destroy',
    'uses' => 'EnrolledStudentController@destroy'
]);
Route::get('class/roster/{course_id}/{date}/{date_id}', 'CoursesController@roster');
Route::post('cpr/addstudent', 'CprClassesController@student')->name('cpr.student');
Route::get('cpr/invoice/{id}', 'CprClassesController@invoice');
Route::get('cpr/editModal/{classId}', 'CprClassesController@editModal');
Route::get('cpr/invoice/send/{id}', 'CprClassesController@send_invoice');
Route::get('ceu/history/{id}', 'CoursesController@history');
Route::get('edu/daily', [
    'as' => 'edu.daily',
    'uses' => 'EducationController@daily',
    'middleware' => ['permission:education.reports']
]);


Route::post('/question', 'QuizController@question');
Route::post('/question/answer', 'QuizController@answer');

Route::get('edu/daily_report', 'EducationController@daily_report');

Route::get('edu/schedule', 'EducationController@schedule');

//end Education//


Route::get('encounters/list', 'ComplianceController@encounterlist')->name('compliance.list');

Route::get('employee/id/{id}', 'EmployeeController@idbadge')->name('employee.id');


//Notification Routes//

Route::get('markAllRead',function (){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()-> back();
})->name('markAllRead');

use Maatwebsite\Excel\Facades\Excel;
Route::get('report/n95/excell', function(){
    return Excel::download(new Vanguard\Export\N95Export, '_attendance.xlsx');
}
);


//Manager Controller//
Route::get('manager', 'ManagerController@index')->name('manager.index');
//end Manager Controller//

//Human Resources Controller//
Route::get('/driver/pdf','HumanResourcesController@driver_pdf');
//end Human Resources//


//Driver Assessment Controller//

Route::get('da/pdf/{id}', 'DrivingAssessmentsController@dapdf')->name('da.pdf');
Route::get('da/pdfall/', 'DrivingAssessmentsController@dapdfall')->name('da.pdfall');
Route::get('da/weekly/', 'DrivingAssessmentsController@daweekly');
Route::get('get-video/{video}', 'DrivingAssessmentsController@getVideo')->name('getVideo');
Route::post('da/signature', 'DrivingAssessmentsController@saveSignature')->name('driving.signature');
Route::post('mvrincident/store', 'EmployeeController@store_mvr_offense')->name('mvrincident.store');
Route::post('driverincident/store', 'EmployeeController@store_driving_offense')->name('driverincident.store');
Route::post('demographic/store', 'EmployeeController@store_dra')->name('demographic.store');
Route::get('/da/export', 'DrivingAssessmentsController@excell');
//end Driver Assessment//

// n95 employee//
Route::get('n95/create', 'EmployeeController@n95Create');
Route::get('/getEmployee/{id}', 'EmployeeController@getEmployee');
Route::get('/getRespiratorType/{id}', 'EmployeeController@getRespirator');
Route::get('/showSignature/{id}', 'EmployeeController@showSignature');
Route::post('/n95Store', 'EmployeeController@n95Store');
Route::get('/n95EmployeeSignature/{id}', 'EmployeeController@n95EmployeeSignature');
Route::get('/n95', 'EmployeeController@n95');

//end n95

/**
 * Authentication
 */

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');

Route::get('lockscreen', 'LockAccountController@lockscreen');
Route::post('lockscreen', 'LockAccountController@unlock');

Route::get('logout', [
    'as' => 'auth.logout',
    'uses' => 'Auth\AuthController@getLogout'
]);

// Allow registration routes only if registration is enabled.
if (settings('reg_enabled')) {
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
    Route::get('register/confirmation/{token}', [
        'as' => 'register.confirm-email',
        'uses' => 'Auth\AuthController@confirmEmail'
    ]);
}

// Register password reset routes only if it is enabled inside website settings.
if (settings('forgot_password')) {
    Route::get('password/remind', 'Auth\PasswordController@forgotPassword');
    Route::post('password/remind', 'Auth\PasswordController@sendPasswordReminder');
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
}

/**
 * Two-Factor Authentication
 */
if (settings('2fa.enabled')) {
    Route::get('auth/two-factor-authentication', [
        'as' => 'auth.token',
        'uses' => 'Auth\AuthController@getToken'
    ]);

    Route::post('auth/two-factor-authentication', [
        'as' => 'auth.token.validate',
        'uses' => 'Auth\AuthController@postToken'
    ]);
}

/**
 * Social Login
 */
Route::get('auth/{provider}/login', [
    'as' => 'social.login',
    'uses' => 'Auth\SocialAuthController@redirectToProvider',
    'middleware' => 'social.login'
]);

Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('auth/twitter/email', 'Auth\SocialAuthController@getTwitterEmail');
Route::post('auth/twitter/email', 'Auth\SocialAuthController@postTwitterEmail');

Route::group(['middleware' => 'auth'], function () {

    /**
     * Dashboard
     */

    Route::get('/dashboard', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index'
    ]);

    /**
     * User Profile
     */

    Route::get('profile', [
        'as' => 'profile',
        'uses' => 'ProfileController@index'
    ]);

    Route::get('profile/activity', [
        'as' => 'profile.activity',
        'uses' => 'ProfileController@activity'
    ]);

    Route::put('profile/details/update', [
        'as' => 'profile.update.details',
        'uses' => 'ProfileController@updateDetails'
    ]);

    Route::post('profile/avatar/update', [
        'as' => 'profile.update.avatar',
        'uses' => 'ProfileController@updateAvatar'
    ]);

    Route::post('profile/avatar/update/external', [
        'as' => 'profile.update.avatar-external',
        'uses' => 'ProfileController@updateAvatarExternal'
    ]);

    Route::put('profile/login-details/update', [
        'as' => 'profile.update.login-details',
        'uses' => 'ProfileController@updateLoginDetails'
    ]);

    Route::post('profile/two-factor/enable', [
        'as' => 'profile.two-factor.enable',
        'uses' => 'ProfileController@enableTwoFactorAuth'
    ]);

    Route::post('profile/two-factor/disable', [
        'as' => 'profile.two-factor.disable',
        'uses' => 'ProfileController@disableTwoFactorAuth'
    ]);

    Route::get('profile/sessions', [
        'as' => 'profile.sessions',
        'uses' => 'ProfileController@sessions'
    ]);

    Route::delete('profile/sessions/{session}/invalidate', [
        'as' => 'profile.sessions.invalidate',
        'uses' => 'ProfileController@invalidateSession'
    ]);

    /**
     * User Management
     */
    Route::get('user', [
        'as' => 'user.list',
        'uses' => 'UsersController@index'
    ]);

    Route::get('user/create', [
        'as' => 'user.create',
        'uses' => 'UsersController@create'
    ]);

    Route::post('user/create', [
        'as' => 'user.store',
        'uses' => 'UsersController@store'
    ]);

    Route::get('user/{user}/show', [
        'as' => 'user.show',
        'uses' => 'UsersController@view'
    ]);

    Route::get('user/{user}/edit', [
        'as' => 'user.edit',
        'uses' => 'UsersController@edit'
    ]);

    Route::put('user/{user}/update/details', [
        'as' => 'user.update.details',
        'uses' => 'UsersController@updateDetails'
    ]);

    Route::put('user/{user}/update/login-details', [
        'as' => 'user.update.login-details',
        'uses' => 'UsersController@updateLoginDetails'
    ]);

    Route::delete('user/{user}/delete', [
        'as' => 'user.delete',
        'uses' => 'UsersController@delete'
    ]);

    Route::post('user/{user}/update/avatar', [
        'as' => 'user.update.avatar',
        'uses' => 'UsersController@updateAvatar'
    ]);

    Route::post('user/{user}/update/avatar/external', [
        'as' => 'user.update.avatar.external',
        'uses' => 'UsersController@updateAvatarExternal'
    ]);

    Route::get('user/{user}/sessions', [
        'as' => 'user.sessions',
        'uses' => 'UsersController@sessions'
    ]);

    Route::delete('user/{user}/sessions/{session}/invalidate', [
        'as' => 'user.sessions.invalidate',
        'uses' => 'UsersController@invalidateSession'
    ]);

    Route::post('user/{user}/two-factor/enable', [
        'as' => 'user.two-factor.enable',
        'uses' => 'UsersController@enableTwoFactorAuth'
    ]);

    Route::post('user/{user}/two-factor/disable', [
        'as' => 'user.two-factor.disable',
        'uses' => 'UsersController@disableTwoFactorAuth'
    ]);

    /**
     * Roles & Permissions
     */

    Route::get('role', [
        'as' => 'role.index',
        'uses' => 'RolesController@index'
    ]);

    Route::get('role/create', [
        'as' => 'role.create',
        'uses' => 'RolesController@create'
    ]);

    Route::post('role/store', [
        'as' => 'role.store',
        'uses' => 'RolesController@store'
    ]);

    Route::get('role/{role}/edit', [
        'as' => 'role.edit',
        'uses' => 'RolesController@edit'
    ]);

    Route::put('role/{role}/update', [
        'as' => 'role.update',
        'uses' => 'RolesController@update'
    ]);

    Route::delete('role/{role}/delete', [
        'as' => 'role.delete',
        'uses' => 'RolesController@delete'
    ]);


    Route::post('permission/save', [
        'as' => 'permission.save',
        'uses' => 'PermissionsController@saveRolePermissions'
    ]);

    Route::resource('permission', 'PermissionsController');

    /**
     * Settings
     */

    Route::get('settings', [
        'as' => 'settings.general',
        'uses' => 'SettingsController@general',
        'middleware' => 'permission:settings.general'
    ]);

    Route::post('settings/general', [
        'as' => 'settings.general.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'permission:settings.general'
    ]);

    Route::get('settings/auth', [
        'as' => 'settings.auth',
        'uses' => 'SettingsController@auth',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::post('settings/auth', [
        'as' => 'settings.auth.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'permission:settings.auth'
    ]);

// Only allow managing 2FA if AUTHY_KEY is defined inside .env file
    if (env('AUTHY_KEY')) {
        Route::post('settings/auth/2fa/enable', [
            'as' => 'settings.auth.2fa.enable',
            'uses' => 'SettingsController@enableTwoFactor',
            'middleware' => 'permission:settings.auth'
        ]);

        Route::post('settings/auth/2fa/disable', [
            'as' => 'settings.auth.2fa.disable',
            'uses' => 'SettingsController@disableTwoFactor',
            'middleware' => 'permission:settings.auth'
        ]);
    }

    Route::post('settings/auth/registration/captcha/enable', [
        'as' => 'settings.registration.captcha.enable',
        'uses' => 'SettingsController@enableCaptcha',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::post('settings/auth/registration/captcha/disable', [
        'as' => 'settings.registration.captcha.disable',
        'uses' => 'SettingsController@disableCaptcha',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::get('settings/notifications', [
        'as' => 'settings.notifications',
        'uses' => 'SettingsController@notifications',
        'middleware' => 'permission:settings.notifications'
    ]);

    Route::post('settings/notifications', [
        'as' => 'settings.notifications.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'permission:settings.notifications'
    ]);

    /**
     * Activity Log
     */

    Route::get('activity', [
        'as' => 'activity.index',
        'uses' => 'ActivityController@index'
    ]);

    Route::get('activity/user/{user}/log', [
        'as' => 'activity.user',
        'uses' => 'ActivityController@userActivity'
    ]);

});


/**
 * Installation
 */

$router->get('install', [
    'as' => 'install.start',
    'uses' => 'InstallController@index'
]);

$router->get('install/requirements', [
    'as' => 'install.requirements',
    'uses' => 'InstallController@requirements'
]);

$router->get('install/permissions', [
    'as' => 'install.permissions',
    'uses' => 'InstallController@permissions'
]);

$router->get('install/database', [
    'as' => 'install.database',
    'uses' => 'InstallController@databaseInfo'
]);

$router->get('install/start-installation', [
    'as' => 'install.installation',
    'uses' => 'InstallController@installation'
]);

$router->post('install/start-installation', [
    'as' => 'install.installation',
    'uses' => 'InstallController@installation'
]);

$router->post('install/install-app', [
    'as' => 'install.install',
    'uses' => 'InstallController@install'
]);

$router->get('install/complete', [
    'as' => 'install.complete',
    'uses' => 'InstallController@complete'
]);

$router->get('install/error', [
    'as' => 'install.error',
    'uses' => 'InstallController@error'
]);
