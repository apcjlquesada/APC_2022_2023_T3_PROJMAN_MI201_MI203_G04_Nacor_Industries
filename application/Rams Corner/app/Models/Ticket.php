<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ticket extends Model
{
    use HasFactory;

    public function statusHistories()
    {
        return $this->hasMany(StatusHistory::class, 't_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'u_ID');
    }
    public function currentStatus()
    {
        return $this->hasOne(StatusHistory::class, 't_ID')
            ->latestOfMany();
    }
    public $timestamps = false;

    protected $guarded = [
    ];

    protected $primaryKey = 't_ID';

}
