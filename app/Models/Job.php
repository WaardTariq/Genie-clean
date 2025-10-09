<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'booking';

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    // A job belongs to one cleaner
    public function cleaner()
    {
        return $this->belongsTo(Cleaner::class);
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
