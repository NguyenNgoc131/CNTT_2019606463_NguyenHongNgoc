<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountVerification extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'token', 'verified_at', 'expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
