<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\Services\FleetCompleteService;
use Vanguard\Units;



class FleetCompleteController extends Controller
{
    private $fleetCompleteService;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, FleetCompleteService $fleetCompleteService)
    {
        $fleetCompleteService->assets();
    }
    
    public function assets(FleetCompleteService $fleetCompleteService)
    {
        $this->fleetCompleteService = app(FleetCompleteService::class);
        
        $assets = $this->fleetCompleteService->assets();
        
        foreach($assets as $asset)
        {
            $unit = Units::where('fleet_complete_id', $asset['ID'])->first();
            
            if($unit){
                $unit->license_plate = $asset['LicensePlate'];
                $unit->vin = $asset['VIN'];
                $unit->make = $asset['Make'];
                $unit->year = $asset['Year'];
                $unit->manufacturer = $asset['Manufacturer'];
                $unit->fleet_complete_id = $asset['ID'];
                $unit->save();
            }else{
                
            }
            
        } 
        
        return 'complete';
        
        //return view('test.assets', compact('assets'));
    }
}
