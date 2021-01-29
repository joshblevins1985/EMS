<?php

namespace Vanguard\Console\Commands;
use Illuminate\Support\Collection;
use Vanguard\Services\FleetCompleteService;
use Vanguard\Units;
use Vanguard\UnitDailyMile;

use PDF;
use Mail;
use Carbon;
use Vanguard\Mail\DailyVehicleMileage;
use Illuminate\Console\Command;

class WeeklyVehicleMiles extends Command
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
    protected $signature = 'unit:miles';

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

            view()->share('collection',$collection);

              // pass view file
            $pdf = PDF::loadView('units.reports.reportUnitWeeklyMileage')->setPaper('a4');

            //dd($pdf);

            Mail::send('emails.units.weeklyMileage', ['title' => 'Daily Vehicle Mileage', 'content' => 'Hi'], function($message) use($pdf)
                {
                   $message->to(['jblevins@peasi.net', 'administration@peasi.net', 'tclifford@peasi.net', 'cyork@peasi.net'])->subject('Daily Vehicle Mileage Overdue');

                   $message->attachData($pdf->output(), Carbon::now()->format('m-d-Y').'_mileage_report.pdf');
                });

    }
}
