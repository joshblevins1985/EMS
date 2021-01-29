<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\BadRunSheetEmployee;
use Vanguard\CompanyMeeting;
use Vanguard\EmployeeSchedule;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\Employee;
use Vanguard\EmployeeEncounters;
use Vanguard\QaQi;
use Vanguard\Attendance;
use Vanguard\StateCertifications;
use Vanguard\TrainingBlog;
use Vanguard\User;
use Vanguard\Courses;
use Vanguard\Classes;
use Vanguard\BadRunSheet;
use Vanguard\DrivingAssessments;
use Vanguard\ToDo;
use Vanguard\schedule;


use Vanguard\Notifications\CourseCompleted;

use Auth;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var ActivityRepository
     */
    private $activities;

    /**
     * DashboardController constructor.
     * @param UserRepository $users
     * @param ActivityRepository $activities
     */
    public function __construct(UserRepository $users, ActivityRepository $activities)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->activities = $activities;
    }

    /**
     * Displays dashboard based on user's role.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            return $this->adminDashboard();
        }

        return $this->defaultDashboard();
        
        
    }

    /**
     * Displays dashboard for admin users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function adminDashboard()
    {
        $usersPerMonth = $this->users->countOfNewUsersPerMonth(
            Carbon::now()->subYear()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );

        $stats = [
            'total' => $this->users->count(),
            'new' => $this->users->newUsersCount(),
            'banned' => $this->users->countByStatus(UserStatus::BANNED),
            'unconfirmed' => $this->users->countByStatus(UserStatus::UNCONFIRMED)
        ];

        $latestRegistrations = $this->users->latest(6);
        
        

        return view('dashboard.admin', compact('stats', 'latestRegistrations', 'usersPerMonth'));
    }

    /**
     * Displays default dashboard for non-admin users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function defaultDashboard()
    {
        $meetings = CompanyMeeting::get();
        $todos = ToDo::where('assigned_to', auth()->user()->id)->where('status', '<', 4)->whereNull('deleted_at')->orderBy('expected_complete')->get();
        
        $activities = $this->activities->userActivityForPeriod(
            Auth::user()->id,
            Carbon::now()->subWeeks(2),
            Carbon::now()
        )->toArray();
        
        $employee = Employee::with('employeepositions')->where('user_id', Auth::User()->id)->first();
        
        
        
        $encounters = EmployeeEncounters::where('user_id', Auth::User()->id)->where('status', 2)->get();
        
        $qa = QaQi::where('employee_id', Auth::User()->id)->orderBy('date', 'desc')->paginate(5);
        
        $qaack= QaQi::where('employee_id', Auth::User()->id)->whereNull('acknowledged')->get();

        $brs = BadRunSheetEmployee::where('user_id', Auth::User()->id)->where('status', '<', 4)->get();
        
        $now = date('Y-m-d', strtotime('now'));
        
        $quarter = DB::table('quarters')
        ->where(function ($query) use ($now) {
        $query->where('start', '<=', $now);
        $query->where('end', '>=', $now);
        })->first();
        
        $qapercent = QaQi::where('employee_id', Auth::User()->id)->whereBetween('created_at', array($quarter->start, $quarter->end))->avg('percent');
        
        $driverpercent = DrivingAssessments::where('employee_id', Auth::User()->id)->whereBetween('date_of_evaluation', array($quarter->start, $quarter->end))->avg('performance_rating');
        
        $attend = Attendance::
            whereHas('type', function ($q){ $q->where('points', '>', 0);})
            ->where('user_id', Auth::User()->id)
            ->where('status', 0)
            ->whereBetween('date', array($quarter->start, $quarter->end))->get();
        
        $attendance = Attendance::whereHas('type', function ($q){ $q->where('points', '>', 0);})
        ->with('type')
        ->select('*',  DB::raw('count(*) as total'), DB::raw('count(IF(occurance_type = 0,1,NULL)) hour'), DB::raw('count(IF(occurance_type = 2,1,NULL)) t5'), DB::raw('count(IF(occurance_type = 4,1,NULL)) t120'), DB::raw('count(IF(occurance_type = 6,1,NULL)) b'), DB::raw('count(IF(occurance_type = 7,1,NULL)) ncns'), DB::raw('count(IF(occurance_type = 8,1,NULL)) co'), DB::raw('count(IF(occurance_type = 9,1,NULL)) ntc'), DB::raw('count(IF(occurance_type = 11,1,NULL)) lo'))
        ->where('user_id', Auth::User()->id)
        ->where('status', 0)
        ->whereBetween('date', array($quarter->start, $quarter->end))
        ->get();
        
        
        foreach($attendance as $row)
        {
        $attendance->hour32 = $row->hour * 0;
        $attendance->late = $row->t5 ;
        $attendance->late120 = $row->t120 * 3;
        $attendance->blackout = $row->b * 7;
        $attendance->nocall = $row->ncns * 7;
        $attendance->calloff = $row->co * 3;
        $attendance->ntc = $row->ntc * 2;
        $attendance->lo = $row->lo * 2;
        }

        $attend_total =  $attendance->hour32 + $attendance->late + $attendance->late120 + $attendance->blackout + $attendance->nocall +$attendance->calloff + $attendance->ntc + $attendance->lo;
        
        $percent= $attend_total / 7 * 100;
        
        $statecert = StateCertifications::with('states', 'certtype')->where('user_id', Auth::User()->id)->get();
        
        //$badrunsheet = BadRunSheet::where('employee', Auth::User()->id)->count();

        //$RunSheetCorrection = schedule::
        //whereDate('sin', Carbon::today())
        //->with(['employee' => function ($q) {$q->where('primary_station', 1)}])
        //->whereHas('runSheet', function ($q){$q->where('status', '<' , 4);})->get();

        //$RunSheetCorrection = Employee::
       // where('status', '<' , 6)
        //    ->where('primary_station', 1)
        //    ->whereHas('BadRunSheets', function ($q){$q->where('status', '<' , 4);})
        //    ->orderBy('last_name')
        //    ->get();

        $blogs = TrainingBlog::orderBy('id', 'desc')->take(5)->get();
        

        return view('dashboard.default', compact( 'activities', 'employee', 'encounters', 'qa', 'attendance', 'percent', 'statecert', 'qaack', 'qapercent', 'driverpercent', 'attend', 'todos', 'blogs', 'brs', 'meetings'));
    }
}
