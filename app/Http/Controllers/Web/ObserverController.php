<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Calendar;
use Vanguard\CprClasses;
use Vanguard\Observer;
use Vanguard\ObserverDates;
use Vanguard\Employee;

class ObserverController extends Controller
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
        $observers = Observer::get();
        
        $events = [];
        $data = ObserverDates::with('observer', 'preceptors')->get();
        
        
        if($data->count()) {
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->observer->first_name.' '.$value->observer->last_name,
                    false,
                    new \DateTime($value->start),
                    new \DateTime($value->end),
                    null,
                    // Add color and link on event
                    [
                        'color' => '#f05050',
                        'url' => 'https://emscomplete.app/observer/'.$value->observer->id,
                    ]
                );
            }
        }
        
        
        $calendar = Calendar::addEvents($events);

        $employees = Employee::orderBy('last_name')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
        
        return view('observers.index', compact('observers','calendar', 'employees'));
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
        $obs = new Observer;

        $obs->first_name = $request->first_name;
        $obs->last_name = $request->last_name;
        $obs->address = $request->address;
        $obs->city = $request->city;
        $obs->state = $request->state;
        $obs->zip = $request->zip;
        $obs->dob = $request->dob_submit;
        $obs->phone_number = $request->phone;
        $obs->transport = $request->transport;
        $obs->emergency_contact = $request->ec;
        $obs->type = $request->type;

        $obs->save();

        return redirect()->route('observer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $observers = Observer::find($id);
        
        $od = ObserverDates::with('preceptors')->where('observer_id', $id)->get();
        
        return view('observers.show', compact('observers', 'od'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Vanguard\ObserverController  $observerController
     * @return \Illuminate\Http\Response
     */
    public function edit(ObserverController $observerController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Vanguard\ObserverController  $observerController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ObserverController $observerController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Vanguard\ObserverController  $observerController
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObserverController $observerController)
    {
        //
    }
    
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachmentSubmit(Request $request)
    {
   $this->validate($request, [
 
'name' => 'required',
 
'attachments'=>'required',
 
]);
 
if($request->hasFile('attachments'))
 
{
 
$allowedfileExtension=['pdf','jpg','png','docx'];
 
$files = $request->file('attachments');
 
foreach($files as $file){
 
$filename = $file->getClientOriginalName();
 
$extension = $file->getClientOriginalExtension();
 
$check=in_array($extension,$allowedfileExtension);
 
//dd($check);
 
if($check)
 
{
 

 
foreach ($request->attachments as $attachment) {
 
$filename = $attachment->store('attachments');
 
$obs = Observer::find($request->pid);

$obs->forms = $filename;

$obs->save();

 
}
 
return redirect()->back();
 
}
 
else
 
{
 
echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
 
}
 
}
 
}
 
}
}
