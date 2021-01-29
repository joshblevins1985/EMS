<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class AssetAttached extends Model
{
    public function asset(){
    
    return $this->belongsTo(Asset::class, 'attached_id');
        
    }
}
