<?php

namespace Vanguard;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ItSupportTicket extends Model
{
    use Notifiable;

    public function routeNotificationForSlack() {
        return 'https://hooks.slack.com/services/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';
    }

    public function tech (){
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
    
    public function notes(){
        return $this->hasMany(ItSupportTicketNote::class, 'it_support_ticket_id');
    }
    
    public function requester(){
        return $this->belongsTo(Employee::class, 'reported_by', 'user_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
