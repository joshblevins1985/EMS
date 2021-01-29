<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToDo extends Model
{
    use SoftDeletes;

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'assigned_to', 'user_id');
    }
    
    public function notes()
    {
        return $this->hasMany(ToDoNote::class, 'task_id');
    }
}
