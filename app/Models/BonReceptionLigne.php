<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonReceptionLigne extends Model
{
    use HasFactory;

    public function bonReception()
    {
        return $this->belongsTo(BonReception::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

}
