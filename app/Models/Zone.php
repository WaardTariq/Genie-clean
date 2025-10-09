<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

class Zone extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'coordinates' => Polygon::class,
    ];


    public function cleaners()
    {
        return $this->belongsToMany(Cleaner::class, 'cleaner_zone', 'zone_id', 'cleaner_id')
            ->withTimestamps();
    }

    // Zone can have many jobs
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
