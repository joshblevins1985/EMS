<?php

namespace Vanguard;
use Illuminate\Notifications\Notifiable;



class NarcoticLog extends Model
{
    protected $table= 'narcotic_log';
    
    public $timestamps = true;
    
    public function Employees()
    {
        return $this->belongsTo(Employee::class, 'out_signature', 'rfid');
    }
    
    public function EmployeesIn()
    {
        return $this->belongsTo(Employee::class, 'in_signature', 'rfid');
    }
    
    public function WitnessIn()
    {
        return $this->belongsTo(Employee::class, 'witness_in', 'rfid');
    }
    
     public function WitnessOut()
    {
        return $this->belongsTo(Employee::class, 'witness_out', 'rfid');
    }
    public function NarcoticBox ()
    {
        return $this->belongsTo(NarcoticBoxes::class, 'box', 'id');
    }
    public function drugbaginfo ()
    {
        return $this->belongsTo(DrugBag::class, 'drug_bag_id');
    }
}
