<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class RunSheetTracking extends Model
{
    protected $table= 'runsheettracking';
    
    protected $dates = ['created_at', 'updated_at']; 
    
    public function getCreatedAtHumanAttribute() {
       return $this->created_at->format('m/d/Y H:i:s');
   }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'added_by', 'user_id');
    }
}
