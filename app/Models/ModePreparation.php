<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModePreparation extends Model
{
    use HasFactory;

    public function preparations(){

        return $this->hasMany(Preparation::class);

    }

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
