<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\ControlledSubstances;
use Vanguard\Medications;
use Vanguard\NarcoticBoxes;
use Vanguard\VialStatus;
use Vanguard\VialLog;

use Auth;

class VialLogController extends Controller
{
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
        $rxlog= new VialLog;
        
        $rxlog->vial_id = $request->id;
        $rxlog->status = $request->status;
        $rxlog->location = $request->location;
        $rxlog->comment = $request->comment;
        $rxlog->added_by = Auth::User()->id;
        $rxlog->save();
        
        $vial= ControlledSubstances::find($rxlog->vial_id);
        $vial->status = $request->status;
        $vial->location = $request->location;
        $vial->save();
        
        app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log( auth()->user()->present()->nameOrEmail . 'Updated the location or status of a controlled substance. ');
        
        return redirect()->back();
        
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
    
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wasteform(Request $request)
    {
   $this->validate($request, [
 
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
 
$vattach = ControlledSubstances::find($request->pid);
$vattach->waste_form = $filename;
$vattach->save();
 
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
