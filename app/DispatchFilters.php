<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Builder;

class DispatchFilters extends QueryFilters
{
    /**
     * Filter by station
     *
     * @param  string $station
     * @return Builder
     */
    public function station($station)
    {
        return $this->builder->whereIn('station_id', $station);
    }
    /**
     * Filter by level.
     *
     * @param  string $level
     * @return Builder
     */
    public function care($care)
    {
        return $this->builder->whereIn('level', $care);
    }
   
}
