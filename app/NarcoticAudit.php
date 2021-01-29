<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class NarcoticAudit extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    
    public function audits()
    {
        return $this->belongsTo(NarcoticAuditType::class, 'audit_type');
    }
    
    public function box()
    {
        return $this->belongsTo(NarcoticBoxes::class, 'narcotic_box_id');
    }
    
    public function log()
    {
        return $this->belongsTo(NarcoticLog::class, 'narcotic_log_id');
    }
}
