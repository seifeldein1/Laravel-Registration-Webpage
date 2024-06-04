<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rej extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'user_name',
        'phone',
        'address',
        'birthday',
        'photo',
        'email',
        'password',
    ];
}
