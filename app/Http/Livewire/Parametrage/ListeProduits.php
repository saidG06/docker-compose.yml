<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Produit;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListeProduits extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {

        // $p = Produit::where('id',1)->first();
        // dd($p->preparations->first()->preparation->nom);

        $items = Produit::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        foreach ($items as &$item) {
            $item['photo_url'] = Storage::url($item->photo_principale);
        }

        return view('livewire.Parametrage.liste-produits',[
            'items' => $items,
        ]);
    }
    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function deleteProduit($id)
    {

        $item = Produit::findOrFail($id);
        $item->delete();
        session()->flash('message', 'Produit "'.$item->nom.'" à été supprimé');

        return redirect()->to('/produits');

    }

    public function saved()
    {
        $this->render();
    }



}