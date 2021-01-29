<?php

namespace Vanguard;



class UnitReviews extends Model
{
    protected $table = 'unit_camera_reviews';

    public $timestamps = true;
    
    public function unit (){
        return $this->belongsTo(Units::class, 'unit_id', 'unit_number');
    }
    
    public function driver_assessments(){
        return $this->hasMany(DrivingAssessments::class, 'pid', 'id');
    }
}
