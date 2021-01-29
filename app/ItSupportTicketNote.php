<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ItSupportTicketNote extends Model
{
    public function tech(){
        return $this->belongsTo(Employee::class, 'added_by', 'user_id');
    }
}
