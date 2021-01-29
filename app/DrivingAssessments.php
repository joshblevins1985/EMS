<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class DrivingAssessments extends Model
{
    protected $fillable = ['signature'];
    
    public function employee ()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'user_id');
    }
    
    public function attachments ()
    
    {
        return $this->hasMany(DrivingAssessmentAttachement::class, 'assessment_id');
    }
    
    public function admin ()
    {
        return $this->belongsTo(Employee::class, 'evaluator', 'user_id');
    }
}
