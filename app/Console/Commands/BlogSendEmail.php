<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;

use Vanguard\EmailNotification;
use Vanguard\TrainingBlog;
use Vanguard\Employee;

use Carbon;
use Illuminate\Support\Facades\Mail;
use Vanguard\Mail\NewBlogMail;

class BlogSendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends new blog entries out to appropriate email addresses.';

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
        
        $blog = TrainingBlog::whereDate('date_to_send', Carbon::today())->where('status', 1)->get();
        
       // dd($blog);
        
        if($blog)
        {

            foreach($blog as $row){
                $companies = json_decode($row->companies, TRUE);
                $stations = json_decode($row->stations, TRUE);
                if($row->send_to){
                    $groups = json_decode($row->send_to, TRUE);

                    //dd($groups);

                    foreach($groups as $key => $group){
                        $users = Employee::where('primary_position', $group)->whereBetween('status', [3, 7])->whereIn('company_id', $companies)->whereIn('primary_station', $stations)->get()->toArray();


                        Mail::to($users)->send(new NewBlogMail($row));

                        $message = 'Notification sent to group '.$group. ' reference '.$row->title.'. We have notified '.count($users).' employees in this group.';

                        $notice = new EmailNotification;
                        $notice->message = $message;
                        $notice->save();

                    }

                    $row->status = 2;
                    $row->save();

                }elseif($row->companies){
                    $users = Employee::whereBetween('status', [3, 7])->whereIn('company_id', $companies)->whereIn('primary_station', $stations)->get()->toArray();


                    Mail::to($users)->send(new NewBlogMail($row));

                    $message = 'Notification sent to all employees of '.$companies. ' reference '.$row->title.'. We have notified '.count($users).' employees in this group.';

                    $notice = new EmailNotification;
                    $notice->message = $message;
                    $notice->save();

                    $row->status = 2;
                    $row->save();
                }

            }
        }

    }
}
