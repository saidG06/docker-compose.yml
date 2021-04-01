<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Lot;
use App\Models\Produit;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Boutique extends Component
{
    public $produit;
    public $produit_id;
    public $mode;
    public function produit($produit_id, $mode)
    {
        $mode == 1 ?  $this->produit = StockPoidsPc::where('id', $produit_id)->first() : $this->produit = StockKgPc::where('id', $produit_id)->first();
        dd($this->produit);
    }
    public function render()
    {
        // $items = StockKgPc::select('lot_num', DB::raw('MIN(prix_n) as prix'))->groupBy('lot_num')->get();
        $items = StockPoidsPc::select('produit_id','categorie_id')->groupBy('produit_id','categorie_id')->get(); 
        
        foreach ($items as &$item) {
            $item['photo_url'] = Storage::url($item->produit->photo_principale);
        }

        return view('livewire.frontend.boutique',['items' => $items])->layout('layouts.frontend.app');
    }
}
