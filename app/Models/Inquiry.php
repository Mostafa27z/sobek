<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'from_city',
        'to_city',
        'desired_date',
        'number_of_adults',
        'number_of_children',
        'number_of_babies',
        'message',
        'status'
    ];

    protected $casts = [
        'desired_date' => 'date',
    ];
}