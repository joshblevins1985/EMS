<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;

use Vanguard\Units;
use Vanguard\UnitReviews;

class UnitReview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Unit:RandomReview';

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
        $from = date('Y-m-d', strtotime('- 12 months'));
        
        $today = date('Y-m-d', strtotime('now'));
        
        $random = Units::inRandomOrder()->where('status', 1)->take(5)->get();
        
        $reviews = UnitReviews::whereBetween('created_at', [$from, $today])->get();
        
        
        
        foreach($random as $row){
            $review = new UnitReviews;
            
            $review->unit_id = $row->unit_number;
            $review->added_by = 0;
            $review->reason_reviewed = 1;
            
            $review->save();
        }
    }
}
