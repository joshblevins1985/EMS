<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\DrugBag;
use Vanguard\DrugBagInspection;
use Vanguard\DrugBagInspectionItems;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vanguard\Repositories\Permission\PermissionRepository;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\User;
use Carbon\Carbon;
use DateTime;


class DrugBagInspectionController extends Controller
{
    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->middleware('auth');

        //$this->middleware('permission:dispatch.all');
    }
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
    public function create($id = null)
    {
        $employees = User::where('companies_id', auth()->user()->employee->company_id)->orderBy('last_name')->get();
        $drugBag = DrugBag::with('inspection')->find($id);
        $drugBags = DrugBag::where('companyId', auth()->user()->employee->company_id)->where('statusId', 1)->get();
        $levels = $drugBag ? $drugBag->bagLevelId : 0;
        $states = $drugBag ? $drugBag->stateId : 0;
        $drugs = DrugBagInspectionItems::
        where('companyId', auth()->user()->employee->company_id)
            ->whereHas('level', function ($q) use($levels){
                $q->whereIn('levelId', [$levels] );
            })
            ->whereHas('state', function ($q) use($states){
                $q->whereIn('stateId', [$states] );
            })
            ->get();

        //dd($drugBag->inspection->items['drugs']);

        return view('drugbaginspections.store', compact('id', 'drugBag','drugs', 'drugBags', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->expiredDrugs);
        //  dd($request->all());

        $array = array(
            'baginfo' => $request->only('drugBagId', 'oldSeal', 'newSeal', 'assignedId', 'witnessId'),
            'drugs' =>   $request->except('_token', 'drugBagId', 'oldSeal', 'newSeal', 'assignedId', 'witnessId', 'expiredDrugs'),
            'expired' => $request->expiredDrugs

        );

        //dd($array);

        $di = new DrugBagInspection();
        $di->companyId = auth()->user()->employee->company_id;
        $di->drugBagId = $request->drugBagId;
        $di->userId = auth()->user()->id;
        $di->items = $array;
        $di->save();
        //dd($request->all());
        $dates = [];
        $endofmonth = Carbon::now()->endOfMonth();
        foreach($request->except('_token', 'drugBagId'. 'oldSeal', 'newSeal', 'assignedId', 'witnessId', 'expiredDrugs') as $key => $item)
        {

            if(DateTime::createFromFormat('Y-m-d', $item) !== false){
                //dd($item);
                array_push($dates, $item);
            }
        }
        //dd($dates);
        $bag = DrugBag::find($request->drugBagId);
        $bag->bagExpires = min($dates);
        $bag->currentSealNumber = $request->newSeal;
        $bag->update();

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
