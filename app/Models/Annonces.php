<?php

namespace App\Models;

use App\Models\Categories;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Annonces extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

