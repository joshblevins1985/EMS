<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Auth;
use Vanguard\Policies;

use Illuminate\Http\Request;

class PolicyController extends Controller
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
        $policies = Policies::paginate(10);
        
        return view('compliance.indexpolicy', compact('policies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit= false;
        
        return view('compliance.addpolicy', compact('edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'policy_number' => 'required',
            'title' => 'required',
            'date_effective' => 'required',
            'last_reviewed' => 'required'
         ]);
        
       $policy = new Policies;
       
       $policy->policy_number = $request->policy_number;
       $policy->title = $request->title;
       $policy->date_effective = $request->date_effective_submit;
       $policy->last_reviewed  = $request->last_reviewed_submit;
       $policy->date_terminatied = $request->date_terminated_submit;
       $policy->approved_by = $request->approved_by;
       $policy->purpose = $request->purpose;
       $policy->scope = $request->scope;
       $policy->policy = $request->policy;
       $policy->procedure = $request->procedure;
       $policy->company = $request->company;
        
        $policy->save();
        
       return redirect()->route('policies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $policy = Policies::find($id);
        
        return view('compliance.viewpolicy', compact('policy'));
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
        $policy = Policies::find($id);
        
        return view('compliance.editpoicy', compact('edit','policy'));
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
        $this->validate(request(),[
            'policy_number' => 'required',
            'title' => 'required',
            'date_effective' => 'required',
            'last_reviewed' => 'required'
         ]);
        
       $policy = Policies::find($id);
       
       $policy->policy_number = $request->policy_number;
       $policy->title = $request->title;
       $policy->date_effective = $request->date_effective_submit;
       $policy->last_reviewed  = $request->last_reviewed_submit;
       $policy->date_terminatied = $request->date_terminated_submit;
       $policy->approved_by = $request->approved_by;
       $policy->purpose = $request->purpose;
       $policy->scope = $request->scope;
       $policy->policy = $request->policy;
       $policy->procedure = $request->procedure;
       $policy->company = $request->company;
        
        $policy->save();
        
       return redirect()->route('policies.index');
    }
    
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sign(Request $request, $id)
    {
        $policy = Policies::find($id);
        
        $policy->signature = Auth::User()->id;
        $policy->date_signed = date('Y-m-d', strtotime('now'));
        $policy->approved_by = Auth::User()->first_name.' '. Auth::User()->last_name;
  
        $policy->save();
        
        return redirect('/policies/'.$id);
        
    
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
