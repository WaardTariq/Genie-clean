<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class service extends Model
{
    use HasFactory;


    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value) => asset('storage/service-image/' . $value),
        );
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function cleaners()
    {
        return $this->belongsToMany(Cleaner::class, 'cleaner_service', 'service_id', 'cleaner_id')
            ->withPivot(['price', 'duration_minutes','duration_unit'])
            ->withTimestamps();
    }

    protected function multipleImage(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value
            ? collect(json_decode($value, true))->map(fn($img) => asset('storage/service-multiple-image/' . trim($img)))->toArray()
            : [],
            set: fn($value) => is_array($value) ? json_encode($value) : $value,
        );
    }

    protected function whatsIncluded(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value
            ? array_map('trim', explode(',', $value))
            : []
        );
    }
}
