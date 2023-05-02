<?php

namespace App\Models;

use App\Models\Annonces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    public function annonce(): HasMany
    {
        return $this->hasMany(Annonces::class);
    }
}
