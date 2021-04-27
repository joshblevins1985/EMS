<?php

namespace Vanguard\Http\Controllers\Web;
use Carbon\Carbon;
use Vanguard\DispatchIncident;
use Vanguard\DrugBag;
use Vanguard\DrugBagInspection;
use Vanguard\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Mail;
use Vanguard\Mail\DailyDispatchStats;
use PDF;
use Vanguard\Mail\DailyIncidents;
use Vanguard\Repositories\Permission\PermissionRepository;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\UnitRepeatSchedule;
use Vanguard\UnitSchedule;
use function Symfony\Component\String\s;

class ReportsController extends Controller
{
    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->middleware('auth');


    }
    public function dailyStatsView()
    {
        $this->middleware('role:admin');

        $incidents = DispatchIncident::where('companyId', auth()->user()->company->id)->whereDate('pickUpTime', Carbon::today())->get();
        $units = UnitSchedule::where('companyId', auth()->user()->company->id)->whereDate('startTime', Carbon::today())->get();

        $load = 0;
        $milesDriven = 0;
        $milesBillable = 0;

        foreach ($incidents->where('statusId', 10) as $row)
        {
            $load = $load + $row->level->avgBill;
            $milesDriven = $milesDriven + $row->txpDistance;
            $mileage = $row->txpDistance * $row->level->avgMiles;
            $milesBillable = $milesBillable + $mileage;
        }
        $totalIncome = $load + $milesBillable;

        $canByHour = DispatchIncident::where('companyId', auth()->user()->company->id)->whereDate('pickUpTime', Carbon::today())->where('statusId', 999)->get()->groupBy(function($item, $key) {
            return Carbon::parse($item['canceledTime'])->hour;
        });


        view()->share('units', $units);
        view()->share('incidents', $incidents);
        view()->share('totalIncome', $totalIncome);
        view()->share('milesDriven', $milesDriven);
        view()->share('milesBillable', $milesBillable);

        return view('reports.view.dailyDispatchStats');
    }
    public function dailyStatsPdf()
    {
        return view('reports.pdf.dailyDispatchStats');
    }
    public function send()
    {

       Mail::to(['blevins.josh@gmail.com', 'bmetzler@cincinnatimedicaltransport.com'])

       ->send(new DailyDispatchStats());

       //return back()->with('message', 'Email Sent');
    }

    public function sendDailyIncidents()
    {
        Mail::to(['blevins.josh@gmail.com', 'bmetzler@cincinnatimedicaltransport.com'])

            ->send(new DailyIncidents());

        //return back()->with('message', 'Email Sent');
    }
    public function pdf()
    {
        //dd(base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'));
        $pdf = PDF::loadView('reports.pdf.dailyDispatchStats');

        // download pdf
        return $pdf->inline();;

        //return view('reports.pdf.dailyDispatchStats');
    }

    public function shiftUhuView($start, $end)
    {
        $units = UnitRepeatSchedule::where('companyId', auth()->user()->company->id)->where('status', 1)->get();


        return view('reports.view.shiftUhuView', compact('units', 'start', 'end'));
    }

    public function shiftUhuPdf()
    {

        $units = UnitRepeatSchedule::where('companyId', auth()->user()->company->id)->where('status', 1)->get();
        $title = 'Shift UHU';

        view()->share('units', $units);
        view()->share('title', $title);

        $pdf = PDF::loadView('reports.pdf.shiftUhuView');



        // download pdf
        return $pdf->download();

        //return view('reports.pdf.dailyDispatchStats');
    }

    public function missingDrugBagInspections()
    {
        $inspections = DrugBag::whereDoesntHave('inspection' , function($q){
            $q->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        })->where('companyId', auth()->user()->employee->company_id)->get();
        $title = 'Missing Inspections';

        view()->share('inspections', $inspections);
        view()->share('title', $title);

        $pdf = PDF::loadView('reports.pdf.missingDrugBagInspections');

        // download pdf
        return $pdf->download();
    }

    public function drugBagsPdf()
    {
        $drugBags = DrugBag::where('companyId', auth()->user()->employee->company_id)->where('statusId', 1)->get();
        $title = 'Drug Bag Report';
        view()->share('drugBags', $drugBags);
        view()->share('title', $title);

        $pdf = PDF::loadView('reports.pdf.drugBags');

        // download pdf
        return $pdf->download();
    }

    public function drugBagInspection($id)
    {
        $inspection = DrugBagInspection::find($id);
        $title = 'Drug Bag Inspection';

        view()->share('inspection', $inspection);
        view()->share('title', $title);

        $pdf = PDF::loadView('reports.pdf.drugBagInspection');

        // download pdf
        //return $pdf->inline('db_inspection.pdf');
        return view('reports.pdf.drugBagInspection');
    }

}
