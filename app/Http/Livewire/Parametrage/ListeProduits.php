<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Famille;
use App\Models\ModePreparation;
use App\Models\ModeVente;
use App\Models\Produit;
use App\Models\ProduitTranche;
use App\Models\Tranche;
use App\Models\Unite;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListeProduits extends Component
{
    use WithPagination;
    public $produit_id;
    public $nom;
    public $type;
    public $famille;
    public $code_comptable;
    public $code_analytique;
    public $photo_principale;
    public $unite;
    public $list_familles = [];
    public $list_cuisine = [];
    public $list_modes_vente = [];
    public $list_unite = [];
    public $list_nettoyage = [];
    public $mode_vente;
    public $mode_cuisine;
    public $mode_nettoyage = [];
    public $tranches=[];
    public $list_tranches = [];
    public $active ;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function renderData()
    {
       // $this->list_categories = Categorie::all()->sortBy('nom');
        $modea = ModePreparation::find(1);
        $this->list_cuisine = $modea->preparations;
        $modeb = ModePreparation::find(2);
        $this->list_nettoyage = $modeb->preparations;
        $this->list_modes_vente = ModeVente::all()->sortBy('nom');
        $this->list_unite = Unite::all()->sortBy('nom');
        $this->list_familles = Famille::all()->sortBy('nom');
       /*  $p = Produit::where('id',1)->first(); */
        // dd($p->preparations->first()->preparation->nom);

    }
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
        $this->list_familles = Famille::all()->sortBy('nom');
        $this->renderData();
        return view('livewire.Parametrage.liste-produits',[
            'items' => $items
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
    public function edit($id){

        $item = Produit::where('id',$id)->firstOrFail();
        $this->produit_id = $item->id;
        $this->nom = $item->nom;
        $this->famille = $item->famille_id;
        $this->code_comptable = $item->code_comptable ;
        $this->code_analytique = $item->code_analytique ;
        // $this->photo_principale = $item->photo_principale ;
        $this->unite = $item->unite_id;
        $this->mode_vente = $item->mode_vente_id ;
        $this->active = $item->active ;
        $this->mode_cuisine = $item->mode_cuisine_id ;
        $this->mode_nettoyage = $item->mode_nettoyage_id ;
        
        //dd($this->mode_nettoyage);
       /*  $this->type  == 1 ?  $this->list_tranches = Tranche::where('type',"Poids par pièce")->get() :  $this->list_tranches = Tranche::where('type',"Kg/Pièce")->get(); */
    }

    public function editProduit(){

        Produit::where('id', $this->produit_id)
            ->update([
                'nom' => $this->nom,
                'famille_id' => $this->famille,
                'code_comptable' => $this->code_comptable,
                'code_analytique' => $this->code_analytique,
                //'photo_principale' => $this->photo_principale,
                'unite_id' => $this->unite,
                'mode_vente_id' => $this->mode_vente,
                'active' => $this->active,
                'mode_cuisine_id' => $this->mode_cuisine,
                'mode_nettoyage_id' => $this->mode_nettoyage,

            ]);
            /* foreach ($this->tranches as $key => $value) {
                ProduitTranche::where('produit_id', $this->produit_id)
                ->update([
                    'tranche_id' => $this->tranches[$key],
                ]);
            } */

        session()->flash('message', 'Unité "'.$this->nom.'" à été modifiée');
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
