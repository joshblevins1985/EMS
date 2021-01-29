<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\Http\Controllers\Controller;

use Vanguard\Asset;
use Vanguard\AssetLocation;
use Vanguard\AssetType;
use Vanguard\AssetStatus;
use Vanguard\Station;
use Vanguard\Units;
use Vanguard\Companies;
use Vanguard\Employee;
use Vanguard\ItSupportTicket;
use Vanguard\ItSupportTicketNote;
use Vanguard\AssetAttached;
use Carbon\Carbon;

use Vanguard\Notifications\NewSupportRequest;
use Illuminate\Http\Request;

class AssetController extends Controller
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
      $assets = Asset::get();
      $locations = AssetLocation::where('status', 1)->get();
      $types = AssetType::where('status', 1)->get();
      $statuses = AssetStatus::where('status', 1)->get();
      $stations = Station::get();
      $units = Units::get();
      $companies= Companies::get();
      $edit = false;
      
        return view('assets.index', compact('edit','assets', 'locations', 'types', 'statuses', 'stations', 'units', 'companies'));
    }
    
    public function supportTickets()
    {
       $supportTickets = ItSupportTicket::where('status', '<', 90)->orderBy('status')->orderBy('priority')->get();
       
       $employees = Employee::get();
       
       $assets = Asset::get();

       $stations = Station::where('status', 0)->get();
      
        return view('assets.indexSupportTickets', compact('supportTickets', 'employees', 'assets', 'stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignTicket(Request $request)
    {
        $ticket = ItSupportTicket::find($request->ticketId);
        
        $ticket->user_id = $request->userId;
        
        $ticket->save();
        
        return back()->with('msg', 'Ticket assigned to technician.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asset = new Asset;
        
        $asset->asset_tag = $request->asset_tag;
        $asset->seirial_number = $request->serial_number;
        $asset->year = $request->year;
        $asset->make = $request->make;
        $asset->model = $request->model;
        $asset->description = $request->description;
        $asset->type = $request->type;
        $asset->location_id = $request->location;
        $asset->station_id = $request->station;
        $asset->unit_id = $request->unit;
        $asset->company_id = $request->company;
        $asset->cost = $request->cost;
        $asset->status = $request->status;
        
        $asset->save();
        
        $employees = Employee::get();
        
        $assets = Asset::get();

        $locations = AssetLocation::where('status', 1)->get();
        $types = AssetType::where('status', 1)->get();
        $statuses = AssetStatus::where('status', 1)->get();
        $stations = Station::get();
        $units = Units::get();
        $companies= Companies::get();
        $edit = false;
        
        return view('assets.show', compact('asset', 'employees', 'assets', 'edit', 'locations', 'types', 'statuses', 'stations', 'units', 'companies'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit = true;
        $asset = Asset::find($id);
        $locations = AssetLocation::where('status', 1)->get();
        $types = AssetType::where('status', 1)->get();
        $statuses = AssetStatus::where('status', 1)->get();
        $stations = Station::get();
        $units = Units::get();
        $companies= Companies::get();
        
        $employees = Employee::get();
        
        $assets = Asset::get();
        
        return view('assets.show', compact('asset', 'employees', 'assets', 'edit', 'locations', 'types', 'statuses', 'stations', 'units', 'companies'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function supportRequest(Request $request)
    {
        $tasks = ItSupportTicket::whereBetween('created_at', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear(),
        ])->get();

        $task_id = Carbon::now()->format('y').'-'.count($tasks);

        $support = new ItSupportTicket;
        
        $support->description = $request->description;
        $support->asset_id = $request->assetId;
        $support->priority = $request->priority;
        $support->reported_by = $request->reportedBy;
        $support->user_id = $request->user_id;
        $support->status = $request->status;
        $support->station = $request->station;
        $support->task_id = $task_id;
        if($request->status >= 90) {$support->date_completed = Carbon::now(); }
        $support->save();


        $support->notify(new NewSupportRequest($support));


        
        return back()->with('msg', 'New support ticket entered for '. $request->description);
    }

    public function newSupportApi()
    {
        return response('Hello World', 200)
            ->header('Content-Type', 'text/plain');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSupportRequest(Request $request, $id)
    {
        
        $support = ItSupportTicket::find($id);
        
        $support->description = $request->description;
        $support->asset_id = $request->assetId;
        $support->priority = $request->priority;
        $support->reported_by = $request->reportedBy;
        $support->user_id = $request->user_id;
        $support->station = $request->station;
        $support->status = $request->status;
        if($request->status >= 90) {$support->date_completed = Carbon::now(); }
        
        //dd($support->getDirty());
        
        $support->save();
        
        $note = new ItSupportTicketNote;
        
        $note->description = 'Ticket has been updated';
        $note->it_support_ticket_id = $id;
        $note->added_by = auth()->user()->id;
        
        $note->save();
        
        return back()->with('msg', 'Support ticket updated for '. $request->description);
    }
    
    public function attachAsset(Request $request)
    {
        $support = new AssetAttached;
        
        $support->asset_id = $request->assetId;
        $support->attached_id = $request->attachedId;
        
        $support->save();
        
        return back()->with('msg', 'New attachment added ');
    }
    
    public function supportNote(Request $request)
    {
        $note = new ItSupportTicketNote;
        
        $note->description = $request->description;
        $note->it_support_ticket_id = $request->ticketId;
        $note->added_by = auth()->user()->id;
        
        $note->save();
        
        return back()->with('msg', 'New support ticket note  enterd.');
    }
    
    public function supportNotes($id)
    {
        
        $notes = ItSupportTicketNote::where('it_support_ticket_id',$id)->get();
        
      
        
        return view('assets.partials.bodySupportNotesInfo', compact('notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $asset = Asset::find($id);
        
        $asset->asset_tag = $request->asset_tag;
        $asset->seirial_number = $request->serial_number;
        $asset->year = $request->year;
        $asset->make = $request->make;
        $asset->model = $request->model;
        $asset->description = $request->description;
        $asset->type = $request->type;
        $asset->location_id = $request->location;
        $asset->station_id = $request->station;
        $asset->unit_id = $request->unit;
        $asset->company_id = $request->company;
        $asset->cost = $request->cost;
        $asset->status = $request->status;
        
        $asset->save();

        $edit = true;

        return back(compact('edit'));
        
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

    public function pendingReport()
    {
        $stations = Station::where('status', 0)->orderBy('id')->get();
        $today = ItSupportTicket::whereDate('date_completed', Carbon::today())->get();


        return view('assets.pendingReport', compact('stations', 'today'));
    }
}
