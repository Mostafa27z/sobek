<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'can_be_from',
        'can_be_to',
        'description'
    ];

    protected $casts = [
        'can_be_from' => 'boolean',
        'can_be_to' => 'boolean',
    ];

    public function ticketsAsFrom(): HasMany
    {
        return $this->hasMany(Ticket::class, 'from_city_id');
    }

    public function ticketsAsTo(): HasMany
    {
        return $this->hasMany(Ticket::class, 'to_city_id');
    }

    // Scopes للتصفية السهلة
    public function scopeCanBeFrom($query)
    {
        return $query->where('can_be_from', true);
    }

    public function scopeCanBeTo($query)
    {
        return $query->where('can_be_to', true);
    }
}