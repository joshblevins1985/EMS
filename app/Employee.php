<?php

namespace Vanguard;
use Illuminate\Notifications\Notifiable;


class Employee extends Model
{
    protected $table = 'employees';

    public $timestamps = true;
    
    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function employeeschedule()
    {
        return $this->hasOne(schedule::class, 'user_id');
        
        
    }
    public function employeepositions()
    {
        return $this->belongsTo(EmployeePositions::class, 'primary_position');
    }

    public function fitTest()
    {
        return $this->hasMany(EmployeeN95FitTest::class, 'user_id', 'user_id');
    }

    public function fitQuan()
    {
        return $this->hasOne(EmployeeN95FitTest::class, 'user_id', 'user_id')->where('test_type', 2)->latest();
    }


    public function BadRunSheets()
    {
        return $this->hasMany(BadRunSheetEmployee::class,'user_id', 'user_id');
    }
    
    public function station()
    {
        return $this->belongsTo(Station::class, 'primary_station');
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class, 'user_id');
    }

    public function statecertifications()
    {
        return $this->hasMany(StateCertifications::class, 'user_id', 'user_id');
    }

    public function certificates ()
    {
        return $this->hasMany(Certification::class, 'user_id', 'user_id');
    }
    
    public function timepunch(){
        return $this->hasMany(timepunch::class, 'employee_id', 'user_id');
    }
    
    public function schedule()
    {
        return $this->hasMany(schedule::class, 'user_id', 'user_id');
    }
 
    public function PayRate()
    {
        return $this->hasMany(PayRates::class, 'user_id', 'user_id');
    }
    
    public function MTasks()
    {
        return $this->hasMany(MechanicTask::class, 'mechanic_assigned', 'user_id');
    }
    
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'user_id');
    }
    
    public function Insurances()
    {
        return $this->hasMany(EmployeeInsurance::class, 'user_id', 'user_id');
    }
    
    public function EmployeeEncounters()
    {
        return $this->hasMany(EmployeeEncounters::class, 'user_id', 'user_id');
    }
    
    public function NarcoticLog()
    {
        return $this->hasMany(NarcoticLog::class, 'out_signature', 'rfid');
    }
    
    public function NarcoticLogIn()
    {
        return $this->hasMany(NarcoticLog::class, 'in_signature', 'rfid');
    }
    
    public function RunSheetError (){
        return $this->hasMany(EmployeeRunError::class, 'user_id', 'user_id');
    }
    public function EmployeeStatus()
    {
        return $this->hasOne(EmployeeStatus::class, 'id' ,'status');
    }
    public function scerts()
    {
        return $this->hasMany(StateCertifications::class, 'id', 'user_id');
    }
    public function qa()
    {
        return $this->hasMany(QaQi::class, 'employee_id');
    }
    
    public function ecourses()
    {
        return $this->hasMany(CourseCompletions::class, 'user_id');
    }
    
    public function enrolledcourses()
    {
        return $this->hasMany(EnrolledStudent::class, 'user_id', 'user_id');
    }
    
    public function fieldtraining()
    {
        return $this->hasMany(FieldTrainingDates::class, 'user_id', 'user_id');
    }
    
    public function ftopaydates()
    {
        return $this->hasMany(FieldTrainingDates::class, 'training_officer', 'user_id');
    }
    
    public function driver_eval()
    {
        return $this->hasMany(DrivingAssessments::class, 'employee_id', 'user_id');
    }
    public function driverEvalLast()
    {
        return $this->hasOne(DrivingAssessments::class, 'employee_id')->latest();
    }
    public function mvrincident()
    {
        return $this->hasMany(EmployeeMvr::class,  'employee_id', 'user_id');
    }
    public function drivingincident()
    {
        return $this->hasMany(EmployeeDrivingIncident::class,  'employee_id', 'user_id');
    }
    public function dra()
    {
        return $this->hasOne(DriverRiskAssessments::class, 'employee_id', 'user_id');
    }
    public function history()
    {
        return $this->hasMany(DriverHistoryTracking::class, 'employee', 'user_id');
    }
    
    public function work()
    {
        return $this->hasMany(EmploymentHistory::class, 'pid', 'user_id');
    }
    
    public function school()
    {
        return $this->hasMany(ApplicationEducation::class, 'application_id', 'user_id');
    }
    
    public function interview()
    {
        return $this->hasOne(PreInterview::class, 'pid', 'user_id');
    }
    
    public function competencies ()
    {
        return $this->hasMany(EmployeeCompetencies::class, 'user_id', 'user_id');
    }
    
    public function DriverTrainingLogs ()
    {
        return $this->hasMany(DriversTrainingLogs::class, 'employee_id', 'user_id')->orderBy('date_of_evaluation');
    }

    public function ClassRoom ()
    {
        return $this->hasMany(ClassRoomEnrolledStudent::class, 'user_id', 'user_id');
    }
    
}
