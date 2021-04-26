<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugBagInspection extends Model
{

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */

    protected $casts = [
        'items' => 'array'
    ];

    public function bag()
    {
        return $this->belongsTo(DrugBag::class, 'drugBagId');
    }
}
