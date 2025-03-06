<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'target_amount',
        'current_amount',
        'deadline',
        'description',
    ];

    protected $casts = [
        'deadline' => 'date', // Ou 'datetime' si vous avez besoin de l'heure
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}