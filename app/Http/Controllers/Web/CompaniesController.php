<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Companies;

use Illuminate\Http\Request;

class CompaniesController extends Controller
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
       // Fetch users from database
        $companies = Companies::select('companies.*')->get();
        
        
        
        // Uncomment the following line if you want to see the info you get from the database
        // dd($users);

        // Load appropriate view for displaying the users
        // Note: compact('users') is the same as ['users' => $users] 
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('companies.create');
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
            'name' => 'required',
            'email' => 'required',
            'phone'=> 'required'
            ]);
        
       
        Companies::create(request()->all());
        
        return redirect('/companies')->with('success', 'New Company Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        $companies = Companies::find($id);
        return view('companies.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit= true;
        $companies = Companies::find($id);
        return view('companies.edit', compact('edit'))->with('companies', $companies);
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
        $company = Companies::find($id);
         $company->name = $request->input('name');
         $company->street_number = $request->input('street_number');
         $company->route = $request->input('route');
         $company->locality = $request->input('locality');
         $company->state = $request->input('state');
         $company->postal_code = $request->input('postal_code');
         $company->email = $request->input('email');
         $company->phone = $request->input('phone');
         $company->save();
        
        return redirect('/companies')->with('success', 'Company Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companies = Companies::find($id);
        $companies->delete();
        return redirect('/companies')->with('success', 'Company Deleted');
    }
}
