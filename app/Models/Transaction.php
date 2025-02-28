<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'family_profile_id',
        'category_id',
        'amount',
        'date',
        'description',
        'type', // 'revenu' ou 'depense'
    ];

    protected $casts = [
        'date' => 'date', // Important pour manipuler la date facilement
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function familyProfile()
    {
        return $this->belongsTo(FamilyProfile::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}