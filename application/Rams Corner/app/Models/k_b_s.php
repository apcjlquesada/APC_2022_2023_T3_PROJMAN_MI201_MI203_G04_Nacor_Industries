<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class k_b_s extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'k_b_s';
    protected $guarded = [];

    public $timestamps = false;
}

