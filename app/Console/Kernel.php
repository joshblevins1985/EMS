<?php
namespace Vanguard\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
       'Vanguard\Console\Commands\CertificationsExpiring',
       'Vanguard\Console\Commands\NarcoticPastShitCommand',
       'Vanguard\Console\Commands\CoursesEnroll',
       'Vanguard\Console\Commands\DailyCourseReport',
       'Vanguard\Console\Commands\UnreadQa',
       'Vanguard\Console\Commands\UnitReview',
       'Vanguard\Console\Commands\TabletStatus',
       'Vanguard\Console\Commands\DriverStatus',
       'Vanguard\Console\Commands\DriverStatusUpdate',
       'Vanguard\Console\Commands\IncidentNotifications',
       'Vanguard\Console\Commands\AttendancePointNotification',
       'Vanguard\Console\Commands\DriversNotification',
       'Vanguard\Console\Commands\EducationDaily',
       'Vanguard\Console\Commands\EducationAdminUpdate',
       'Vanguard\Console\Commands\BlogSendEmail',
       'Vanguard\Console\Commands\MVRNotificationCommand',
       'Vanguard\Console\Commands\VehicleMileage',
       'Vanguard\Console\Commands\VehicleMileageOverdue',
      
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('inspire')
//                 ->hourly();

    //$schedule->command('Certifications:Expiring')
    //               ->weeklyOn(1, '8:00');
    $schedule->command('qa:unread')
                   ->weeklyOn(1, '8:00');
                   
    $schedule->command('notification.driver')
                   ->weeklyOn(1, '6:00');
                   
    $schedule->command('education:admin_update')
                   ->weekdays()->at('17:30');
                   
    //$schedule->command('Unit:RandomReview')
    //               ->weeklyOn(1, '8:00');
                   
    $schedule->command('tablet:status')
    ->everyTenMinutes();
                   
   // $schedule->command('courses:enroll')
     //              ->everyFiveMinutes();
                   
    //$schedule->command('courses:dailyreport')
    //               ->dailyAt('23:58');
    
    $schedule->command('blog:send')
                 ->everyMinute()->runInBackground()->withoutOverlapping(5);
     
     $schedule->command('mvr:notify')
                   ->dailyAt('5:00');
    
    $schedule->command('unit:vehicleMileage')
                   ->dailyAt('5:00');
                   
    $schedule->command('unit:vehicleMileageOverdue')
                   ->weeklyOn('1','5:00');
                   
    //$schedule->command('education:daily')
      //             ->dailyAt('07:00');
    
    //Driver Notifications//
    /*
   $schedule->command('driver:status_update')
   ->dailyAt('0:01');
   $schedule->command('driver:status')
   ->dailyAt('7:00');
             */      
  
    }


    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
