<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\MechanicTask;
use Vanguard\Employee;
use Vanguard\AvailablePart;


use Auth;
use DB;
use PDF;
use Mail;
use Vanguard\Mail\MaintenanceCompleteMail;
use Carbon\Carbon;
use Pusher\Pusher;
use Vanguard\RepairTicket;
use Vanguard\UnitMalfunctionReport;
use Vanguard\UnitMalfunction;
use Vanguard\Units;
use Vanguard\VehicleSafetyReport;

class MechanicTasksController extends Controller
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
        $data = MechanicTask::get();

        $employees = Employee::where('primary_position', 23)->where('status', 5)->get();

        $availableparts = AvailablePart::get();

        //dd($availableparts);

        return view('mechanic.index_mechanic', compact('data', 'employees', 'availableparts'));
    }

    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $data = MechanicTask::get();
            echo json_encode($data);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assign()
    {
        $tasks = MechanicTask::where('status', 1)->get();

        $mechanics = Employee::with('MTasks')->where('primary_position', 23)->orWhere('user_id', 450)->where('status', 5)->get();

        return view('mechanic.assign', compact('tasks', 'mechanics'));
    }

    public function assignMe(Request $request)
    {
        //dd($request->unit_id);
        $tasks = MechanicTask::where('status', 1)->where('unit_id', $request->unit_id)->get();

        foreach ($tasks as $row) {
            $task = MechanicTask::find($row->id);

            $task->start_date = Carbon::now()->toDateString();
            $task->mechanic_assigned = Auth::user()->id;
            $task->status = 2;

            $task->save();
        }



        return back();
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
    public function completionReport($id)
    {
        $task = MechanicTask::with('task_label', 'report', 'report.reported_by')->find($id);

        return view('mechanic.reports.maintenanceReport', compact('task'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function newServiceTicket(Request $request, $id)
    {
        // Find Unit Maint Request//
        $job = UnitMalfunctionReport::find($id);
        // Add new repair ticket.
        if ($request->service_ticket == 0) {
            $ticket = new RepairTicket;

            $ticket->unit_id = $job->unit;
            $ticket->user_id = Auth()->user()->id;
            $ticket->status = 1;

            $ticket->save();
        } else {
            $ticket = RepairTicket::find($request->service_ticket_id);

            $ticket->unit_id = $job->unit;
            $ticket->user_id = Auth()->user()->id;
            $ticket->status = 2;

            $ticket->save();
        }
        // Update status and id for Repair Ticket Join
        foreach ($job->problems as $problem) {
            $problem->rid = $ticket->id;
            $problem->start_date = Carbon::now();
            $problem->mechanic_assigned = Auth()->user()->id;
            $problem->status = 2;
            $problem->save();
        }
        //Update status and id for each line item in Maint request

        $job->status = 2;
        $job->pid = $ticket->id;
        $job->save();

        $malfunctions = UnitMalfunction::get();

        return view('mechanic.serviceTicket', compact('ticket', 'malfunctions'));
    }

    public function completeAllTasks($id)
    {
        //get all jobs 
        $jobs = UnitMalfunctionReport::where('pid', $id);

        $jobs->update(['status' => 4]);

        $tasks = MechanicTask::where('rid', $id);

        $tasks->update(['status' => 4]);
        //get all tasks

        $ticket = RepairTicket::find($id);
        $ticket->update(['status' => 3]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function serviceTicket($id)
    {
        $ticket = RepairTicket::with('unit', 'unit.location', 'jobs', 'jobs.problems')->find($id);

        $malfunctions = UnitMalfunction::get();

        return view('mechanic.serviceTicket', compact('ticket', 'malfunctions'));
    }

    public function serviceTicketReport($id)
    {
        $ticket = RepairTicket::with('unit', 'unit.location', 'jobs', 'jobs.problems')->find($id);



        view()->share('ticket',$ticket);

        $pdf = PDF::loadView('mechanic.reports.completedServiceTicket')->setPaper('a4');

        return $pdf->download('service_ticket.pdf');

        // return view('mechanic.reports.completedServiceTicket', compact('ticket'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function safetyReportAdd(Request $request, $id)
    {
        $input = $request->except('_token', 'unit_id');
        // Save Safety Report//
        $report =  new VehicleSafetyReport;
        $report->unit_id = $request->unit_id;
        $report->user_id = Auth()->user()->id;
        $report->form_data = json_encode($input);
        $report->save();

        // Update unit safety report mileage and last odometer reading //
        $unit = Units::where('unit_number', $request->unit_id)->firstOrFail();

        $unit->safety_report = $request->mileage;
        $unit->odometer = $request->mileage;
        $unit->odometer_date = Carbon::now();
        $unit->save();
        // Add new task to service ticket and mark it as completed// 
        $job = new UnitMalfunctionReport;
        $job->unit = $request->unit_id;
        $job->mileage = $request->mileage;
        $job->pid = $id;
        $job->added_by = Auth()->user()->id;
        $job->comments = 'Vehicle Safety Report Due';
        $job->status = 3;
        $job->save();

        $task = new MechanicTask;
        $task->task = 9;
        $task->mechanic_assigned = Auth()->user()->id;
        $task->start_date = Carbon::now();
        $task->end_date = Carbon::now();
        $task->status = 3;
        $task->pid = $job->id;
        $task->rid = $id;
        $task->unit_id = $request->unit_id;
        $task->save();

        return back()->with('success', 'You have added a new safety report, updated the unit mileage, and completed 1 task.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = true;

        $task = MechanicTask::with('report', 'report.reported_by', 'notes', 'notes.employee')->find($id);

        $mechanics = Employee::with('MTasks')->where('primary_position', 23)->orWhere('user_id', 450)->where('status', 5)->get();

        return view('mechanic.edittask', compact('edit', 'task', 'mechanics'));
    }

    public function mechanicDashboard()
    {
        return view('mechanic.dashboard');
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


        if (!$request->start_date_submit) {
            $start_date = date('Y-m-d');
        } else {
            $start_date = $request->start_date_submit;
        }
        $status = $request->status;
        if ($status == 2) {
            $task = MechanicTask::find($id);

            $task->mechanic_assigned = $request->employee;
            $task->anticipated_start_date = $request->anticipated_start_date_submit;
            $task->aticipated_end_date = $request->anticipated_end_date_submit;
            $task->start_date = $start_date;
            $task->end_date = $request->end_date_submit;
            $task->status = $request->status;
            //dd('stat 2'.$status);
            $task->save();
        } elseif ($status == 5) {
            $task = MechanicTask::find($id);

            $task->end_date = Carbon::now()->toDateString();
            $task->status = $request->status;
            //dd('stat 5'.$status);
            $task->save();

            //Remember to change this with your cluster name.
            $options = array(
                'cluster' => 'us2',
                'encrypted' => true
            );

            //Remember to set your credentials below.
            $pusher = new Pusher(
                '3ac146c22cb6b2a219f9',
                '2db8aa38b746f1fbf1e7',
                '883963',
                $options
            );

            $message = "The garage has completed task #: $task->id on unit number $task->unit_id";

            //Send a message to notify channel with an event name of notify-event
            $pusher->trigger('repairComplete', 'repair-complete', $message);


            // Mail::to(['jblevins@peasi.net', 'madkins@peasi.net'])->send(new MaintenanceCompleteMail($task));

        } else {
            $task = MechanicTask::find($id);

            $task->status = $request->status;
            //dd('stat other'.$status);
            $task->save();
        }


        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $task = MechanicTask::find($id);
        $task->delete();

        app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Deleted task from mechanic list');

        return redirect('/mechanic')->with('success', 'You have successfully deleted a task.');
    }
}
