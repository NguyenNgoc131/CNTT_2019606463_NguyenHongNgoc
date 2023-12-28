<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'degree', 
        'experience', 
        'office',
        'appointment_bids', 
        'successful_bids', 
        'success_rate',
        'email', 
        'ngayhen'
    ];
}
