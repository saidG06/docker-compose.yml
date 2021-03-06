<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitTranche extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function produit()
    {
        return $this->belongsTo(Produit::class,'produit_id','id');
    }

    public function tranche()
    {
        return $this->belongsTo(Tranche::class);
    }
}
