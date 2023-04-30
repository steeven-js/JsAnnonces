<?php

namespace App\Models;

use App\Models\Annonces;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favoris extends Model
{
    use HasFactory;

    public function annonce(): BelongsTo
    {
        return $this->belongsTo(Annonces::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

