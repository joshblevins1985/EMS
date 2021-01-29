<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Vanguard\Services\FleetCompleteService;
use Vanguard\Units;
use Vanguard\UnitDailyMile;

use PDF;
use Mail;
use Carbon;
use Vanguard\Mail\DailyVehicleMileage;

class VehicleMileage extends Command
{
    public function __invoke(Request $request, FleetCompleteService $fleetCompleteService)
    {
        $fleetCompleteService->assets();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unit:vehicleMileage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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
                
                $day = new UnitDailyMile;
                
                $day->unit_id = $unit->id;
                $day->mileage = $asset['odometer'];
                
                $day->save();
        }
        
            //dd($collection);
        
            view()->share('collection',$collection);
              
              // pass view file
            $pdf = PDF::loadView('units.reports.reportUnitMileage')->setPaper('a4');
            
            //dd($pdf);
            
            Mail::send('emails.units.dailyMileage', ['title' => 'Daily Vehicle Mileage', 'content' => 'Hi'], function($message) use($pdf)
                {
                   $message->to(['jblevins@peasi.net', 'administration@peasi.net', 'tclifford@peasi.net', 'cyork@peasi.net'])->subject('Daily Vehicle Mileage');
                   
                   $message->attachData($pdf->output(), Carbon::now()->format('m-d-Y').'_mileage_report.pdf');
                });
                
        
    
    
            return response()->json(['message' => 'Request completed']);
    }
}
