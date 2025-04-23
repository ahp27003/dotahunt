<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Location extends Model
{
    // Only use SpatialTrait for MySQL
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        if (DB::connection()->getDriverName() === 'mysql') {
            $this->initializeSpatialTraits();
        }
    }
    
    protected function initializeSpatialTraits()
    {
        // Dynamically use the SpatialTrait for MySQL only
        $trait = \Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait::class;
        $this->initializeTraits();
        
        if (in_array($trait, class_uses_recursive(static::class))) {
            $this->spatialFields = ['coordinate'];
        }
    }

    protected $fillable = ['user_id', 'address', 'latitude', 'longitude'];
    
    // Get coordinate as a point
    public function getCoordinateAttribute($value)
    {
        if (DB::connection()->getDriverName() === 'pgsql') {
            // For PostgreSQL, return as array with lat/lng
            if (!empty($this->latitude) && !empty($this->longitude)) {
                return [
                    'lat' => $this->latitude,
                    'lng' => $this->longitude
                ];
            }
            return null;
        }
        
        // For MySQL, the SpatialTrait handles this automatically
        return $value;
    }
    
    // Set coordinate from lat/lng values
    public function setCoordinateAttribute($value)
    {
        if (DB::connection()->getDriverName() === 'pgsql') {
            // For PostgreSQL, store lat/lng in separate columns
            if (is_array($value) && isset($value['lat']) && isset($value['lng'])) {
                $this->attributes['latitude'] = $value['lat'];
                $this->attributes['longitude'] = $value['lng'];
                
                // Also update the PostGIS geometry column if the table exists
                if (Schema::hasColumn('locations', 'coordinate')) {
                    DB::statement(
                        'UPDATE locations SET coordinate = ST_SetSRID(ST_MakePoint(?, ?), 4326) WHERE id = ?',
                        [$value['lng'], $value['lat'], $this->id]
                    );
                }
            }
        }
        // For MySQL, the SpatialTrait handles this automatically
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
