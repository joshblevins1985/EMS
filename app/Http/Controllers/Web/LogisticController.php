<?php

namespace Vanguard\Http\Controllers\Web;

use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use Vanguard\DispatchIncident;
use Vanguard\DrugBag;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\Repositories\Permission\PermissionRepository;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Station;
use Vanguard\UnitLevel;
use Vanguard\Units;
use Carbon\Carbon;
use DateTime;

class LogisticController extends Controller
{

    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->middleware('auth');

        //$this->middleware('permission:logistics.menu');
    }

    public function units()
    {
        $units = Units::where('companyId', auth()->user()->company->id)->get();
        $stations = Station::where('companyId', auth()->user()->company->id)->where('status', 1)->get();
        $levels = UnitLevel::where('companyId', auth()->user()->company->id)->where('status', 1)->get();

        return view('logistics.units', compact('units', 'stations', 'levels'));
    }

    public function newUnit(Request $request)
    {
        $data = $request->all();
        $odometerDate= Carbon::parse($request->odometerDate);
        $licExpiration = Carbon::parse($request->licensePlateExpiration);
        $data['licensePlateExpiration'] = $licExpiration;
        $data['odometerDate'] = $odometerDate;
        $data['companyId'] = auth()->user()->company->id;

        $insert = Units::create($data);
        return back();

    }

    public function drugBagIndex()
    {
        $drugBags = DrugBag::where('companyId', auth()->user()->employee->company_id)->where('statusId', 1)->get();
        $endofmonth = Carbon::now()->endOfMonth();
        $expiredDrugsCount = 0;

        $inspections = DrugBag::whereDoesntHave('inspection' , function($q){
            $q->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        })->where('companyId', auth()->user()->employee->company_id)->where('statusId', 1)->get();

        foreach($drugBags as $i)
        {
            if($i->inspection){
                foreach ($i->inspection->items as $key => $item)
                {
                    if(DateTime::createFromFormat('Y-m-d', $item) !== false){
                        if(Carbon::parse($item) <= $endofmonth){
                            $expiredDrugsCount++;
                        }
                    }

                }
            }

        }
        return view('logistics.drugBagIndex', compact('drugBags', 'expiredDrugsCount', 'inspections'));
    }
}
