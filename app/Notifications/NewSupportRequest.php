<?php

namespace Vanguard\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

use Carbon\Carbon;

class NewSupportRequest extends Notification
{
    use Queueable;

    private $support;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($support)
    {
        $this->support = $support;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }


    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $support = $this->support;
        $message = "New Support Request";
        if($support->priority == 1){
            $priority = "Urgent";
        }elseif($support->priority == 1){
            $priority = "High";
        }elseif($support->priority == 1){
            $priority = "Medium";
        }elseif($support->priority == 1){
        $priority = "Low";
        }else{
            $priority = 'Unknown';
        }

        $url = 'https://peasi.app/supportTickets';

        if($support->asset)
        {
            $asset_id = $support->asset->asset_tag;
        }else{
            $asset_id = '';
        }

        return (new SlackMessage)
            ->success()
            ->content('A new support request has been submitted.')
            ->attachment(function ($attachment) use ($url, $support, $asset_id) {
               $attachment->title('Ticket ID: '.$support->task_id, $url)
                   ->fields([
                      'Title' =>  'Ticket ID: '.$support->task_id,
                       'Asset ID' => $asset_id,
                       'Date' => Carbon::parse($support->created_at)->format('m-d-Y'),
                       'Description' => $support->description
                   ]);
            });
        }

}
