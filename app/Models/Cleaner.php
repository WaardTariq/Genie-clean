<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Cleaner extends Authenticatable
{
    use HasFactory, HasApiTokens;


    public function zones()
    {
        return $this->belongsToMany(Zone::class, 'cleaner_zone', 'cleaner_id', 'zone_id')
            ->withTimestamps();
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'cleaner_service', 'cleaner_id', 'service_id')
            ->withPivot(['price', 'duration_minutes'])
            ->withTimestamps();
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value
            ? asset('storage/cleaner-image/' . $value)
            : asset('assets/images/avatars/avatar-1.png')
        );
    }
}
