<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Vanguard\Services\FleetCompleteService;
use Vanguard\Units;
use Vanguard\Unit2;
use Vanguard\Station;
use Vanguard\Companies;

use PDF;
use Carbon\Carbon;
use FarhanWazir\GoogleMaps\GMaps;

class UnitsController extends Controller
{
    public function __invoke(Request $request, FleetCompleteService $fleetCompleteService)
    {
        $fleetCompleteService->assets();
    }

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

        $units = Units::where('type', '!=', 99)->get();

        $service = Units::whereRaw('odometer > service')->get();

        $stations = Station::get();

        $companies = Companies::get();

        return view('units.index', compact('units', 'service', 'companies'));

        /*
        $units = Unit2::get();

        foreach($units as $unit)
        {
            $up = Units::where('unit_number', $unit->unit_number)->first();

            if($up){
            $up->odometer = $unit->odometer;
            $up->odometer_date = $unit->odometer_date;
            $up->service = $unit->service;
            $up->station = $unit->station;


            $up->save();
            }else{

            }

        }

        return 'complete';
        */
    }

    public function vehicleStatusReport ()
    {
        $units = Units::with(['service' => function ($q){ $q->where('status', '<', 5); }])->where('status', 1)->whereNotNull('fleet_complete_id')->get();

        $collection = collect();

        $this->fleetCompleteService = app(FleetCompleteService::class);

        foreach($units as $unit)
        {

            $id = $unit->fleet_complete_id;

            if($unit->service) {
                $service = '1';

            }else{
                $service = null ;

            }

            $asset = $this->fleetCompleteService->assetInformation($id);

            $info = [
                'service' =>  $service,
                'unit_number' => $unit->unit_number,
                'location' => $asset['location'],
                'scheduled_service' => $unit->service,
                'odometer' => $asset['odometer'],
                'remainder' => $unit->service - $asset['odometer'],

                ];

                $collection->push($info);


        }

            //dd($collection);
        /*
            view()->share('collection',$collection);

              // pass view file
            $pdf = PDF::loadView('units.reports.reportUnitMileage')->setPaper('a4');

            //dd($pdf);

            return $pdf;
            */

            return view('units.reports.reportUnitMileage', compact('collection'));
    }

    public function mileageWeekly ()
    {
      // Get All Units
      $units = Units::with('miles')->where('status', '!=', 0)->whereNotNull('fleet_complete_id')->get();

      // Set up colletion
      $collection = collect();

      //Set up api call
      $this->fleetCompleteService = app(FleetCompleteService::class);

      //Set up needed dates for logic
      $dateSeven = Carbon::now()->subDays(6);
      $date = Carbon::now();

      //Rotate through each unit and build collection
      foreach ($units as $unit) {
        //Set ID to get api data
        $id = $unit->fleet_complete_id;
        //Get api data
        $asset = $this->fleetCompleteService->assetInformation($id);
        //Call miles for unit and search for needed dates
        $miles = $unit->miles;
        //dd($miles);
        //Miles as of 7 days ago.
        $milesSeven = $miles->filter(function ($miles) use ($dateSeven) {

              return $miles->created_at->isSameDay($dateSeven);

          });

        $todayMiles = $miles->filter(function ($miles) use ($date) {

              return $miles->created_at->isSameDay($date);

          });
            //dd($todayMiles->first()->mileage);
            //dd(($milesSeven->isEmpty() ? 0 : $milesSeven->first()->mileage ));
            //dd(($todayMiles->isEmpty() ? 0 : $todayMiles->first()->mileage ));

          //Calculate miles for response
        $startMiles = ($milesSeven->isEmpty() ? 0 : $milesSeven->first()->mileage );
        //dd($startMiles);
        $currentMiles = ($todayMiles->isEmpty() ? 0 : $todayMiles->first()->mileage );
        //dd($currentMiles);
        $average = $currentMiles - $startMiles;
        $average = $average / 7;
        //dd($average);
        $fuel = $average * 2.38;
        $maintanace = $average * 0.59;

        $info = [
              'unit_number' => $unit->unit_number,
              'odometer' => $asset['odometer'],
              'location' => $unit->location->station,
              'weekly' => $asset['odometer'] - $startMiles,
              'average' => number_format((float)$average, 2, '.', ''),
              'fuel' => number_format((float)$fuel, 2, '.', ''),
              'maintainance' => number_format((float)$maintanace, 2, '.', ''),
              ];

              $collection->push($info);
      }

      //dd($collection);


        return view('units.reports.reportUnitWeeklyMileage', compact('collection'));
    }

    public function unitMatching ()
    {
      // Get All Units
      $units = Units::whereNull('fleet_complete_id')->whereNotNull('vin')->get();

      // Set up colletion
      $collection = collect();

      //Set up api call
      $this->fleetCompleteService = app(FleetCompleteService::class);

      
      //Rotate through each unit and build collection
      foreach ($units as $unit) {
        //Set ID to get api data
        $id = $unit->vin;
        //Get api data
        $asset = $this->fleetCompleteService->assetInformation($id);
        if($asset){
            
        }else{
            dd($asset);
            $unit->fleet_complete_id = $asset['ID'];
            $unit->save();
        }

        
        
      }

      //dd($collection);


   
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
    public function show($id, FleetCompleteService $fleetCompleteService)
    {
        $unit = Units::find($id);

        if($unit->fleet_complete_id){

        $this->fleetCompleteService = app(FleetCompleteService::class);

        $id = $unit->fleet_complete_id;

        $asset = $this->fleetCompleteService->assetInformation($id);
        $config = array();
        $config['center'] = $asset['location'];
        $config['zoom'] = '14';
        $config['map_height'] = '400px';

        $gmap = new GMaps();
        $gmap->initialize($config);

        $marker['position'] = $asset['location'];
        $marker['infowindow_content'] = $asset['location'];

        $gmap->add_marker($marker);
        $map = $gmap->create_map();
        }else{
            $asset = false;
            $config = array();
            $config['center'] = 'Portsmouth, Ohio';
            $config['zoom'] = '14';
            $config['map_height'] = '400px';
            $gmap = new GMaps();
            $gmap->initialize($config);
            $map = $gmap->create_map();
        }
       // dd($assets);



        return view('units.show', compact('unit', 'asset', 'map'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unitModal($id, FleetCompleteService $fleetCompleteService)
    {
        $unit = Units::find($id);

        $this->fleetCompleteService = app(FleetCompleteService::class);

        $id = $unit->fleet_complete_id;

        $asset = $this->fleetCompleteService->assetInformation($id);

       // dd($assets);



        return view('units.partials.modalBodyUnitInfo', compact('unit', 'asset'));
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
