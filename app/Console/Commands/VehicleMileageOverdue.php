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

class VehicleMileageOverdue extends Command
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
    protected $signature = 'unit:vehicleMileageOverdue';

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
        $units = Units::with(['service' => function ($q){ $q->where('status', '<', 5); }])->where('odometer_date', '<=', Carbon\Carbon::now()->subDays(15))->whereNotNull('fleet_complete_id')->get();
        
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
                'location' => $unit->location->station,
                'scheduled_service' => $unit->service,
                'odometer' => $asset['odometer'],
                'odometer_date' => $unit->odometer_date,
                'remainder' => $unit->service - $asset['odometer'],
                
                ];
                
                $collection->push($info);
                
        }
        
        $count = count($units);
        
            //dd($collection);
        
            view()->share('collection',$collection);
            view()->share('count', $count);
              
              // pass view file
            $pdf = PDF::loadView('units.reports.reportUnitMileageOverdue')->setPaper('a4');
            
            //dd($pdf);
            
            Mail::send('emails.units.weeklyMileageOverdue', ['title' => 'Daily Vehicle Mileage', 'content' => 'Hi'], function($message) use($pdf)
                {
                   $message->to(['jblevins@peasi.net', 'administration@peasi.net', 'tclifford@peasi.net', 'cyork@peasi.net'])->subject('Daily Vehicle Mileage Overdue');
                   
                   $message->attachData($pdf->output(), Carbon::now()->format('m-d-Y').'_mileage_overdue_report.pdf');
                });
                
        
    
    
            return response()->json(['message' => 'Request completed']);
    }
}
