<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'seat',
        'total',
        'date',
        // 'user_id',
        'travel_id',
    ];

    // has many

    // belong to

    public function travelDates()
    {
        return $this->belongsTo(Travel::class, 'travel_id');
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
}
