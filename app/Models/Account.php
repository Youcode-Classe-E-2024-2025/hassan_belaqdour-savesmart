<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name', // Nom du compte (ex: Compte Courant, Epargne)
        'solde',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}