<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{

    public function deviceType (){
        return $this->belongsTo(AssetType::class, 'type');
    }
    
    public function location (){
        return $this->belongsTo(AssetLocation::class, 'location_id');
    }
    
    public function station (){
        return $this->belongsTo(Station::class, 'station_id');
    }
    
    public function unit(){
        return $this->belongsTo(Units::class, 'unit_id');
    }
    
    public function company(){
        return $this->belongsTo(Companies::class, 'company_id');
    }
    
    public function assetStatus(){
        return $this->belongsTo(AssetStatus::class, 'status');
    }
    
    public function assetSupport (){
        return $this->hasMany(ItSupportTicket::class, 'asset_id');
    }
    
    public function attached(){
        return $this->hasMany(AssetAttached::class, 'asset_id');
    }
}
