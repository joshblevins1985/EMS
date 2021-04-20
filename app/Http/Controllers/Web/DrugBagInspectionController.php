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
        $employees = User::where('companyId', auth()->user()->companyId)->orderBy('last_name')->get();
        $drugBag = DrugBag::find($id);
        $drugBags = DrugBag::where('companyId', auth()->user()->companyId)->where('statusId', 1)->get();
        $drugs = DrugBagInspectionItems::
        where('companyId', auth()->user()->companyId)
            ->whereIn('bagTypeId', [$drugBag->bagLevelId])->get();

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
      //  dd($request->all());
        $di = new DrugBagInspection();
        $di->companyId = auth()->user()->companyId;
        $di->drugBagId = $request->drugBagId;
        $di->userId = auth()->user()->id;
        $di->items = $request->except('_token');
        $di->save();
        //dd($request->all());
        $dates = [];
        $endofmonth = Carbon::now()->endOfMonth();
        foreach($request->except('_token', 'drugBagId'. 'oldSeal', 'newSeal', 'assignedId', 'witnessId') as $key => $item)
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
