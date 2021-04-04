<?php

namespace App\Http\Livewire\Vente;

use App\Models\BonReception;
use App\Models\Produit;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DesignationPrix extends Component
{
    use WithPagination;
    public $tranche_id = [];

    public $lot_id;
    public $lot_num;
    public $article;
    public $produit_id = [];
    public $mode_vente_id;
    public $mode_vente;
    public $nombre_piece;
    public $nom_tranche = [];
    public $code=[];
    public $poids=[];
    public $isActive = false;

    public $list_fournisseurs = [];
    public $list_qualites = [];
    public $list_produits = [];
    public $liste_poids_pc = [];
    public $liste_kg_pc = [];
    public $list_tranches = [];
    public $list_depots = [];
    public $showNbrPiece = false;

    public $countInputs;
    public $i = 0;

    public $qte = [];
    public $cr = [];
    public $depot = [];
    public $prix_achat = [];
    public $prix_vente_normal = [];
    public $prix_vente_fidele = [];
    public $prix_vente_business = [];
    public $tranche_uid = [];
    public $bon_reception = [];
    public $liste_lots= [];
    public $bon_reception_ref;

    public $article_kg_pc=[];
    public $produit_id_kg_pc=[];
    public $lot_num_kg_pc=[];
    public $cr_kg_pc=[];
    public $uid_tranche_kc_pc = [];
    public $nom_tranche_kc_pc = [];
    public $id_kc_pc = [];
    public $prix_vente_normal_kg_pc=[];
    public $prix_vente_fidele_kg_pc=[];
    public $prix_vente_business_kg_pc=[];



    public $sortBy = 'valide';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render(){

        /* $lot_stock_kg_pc = array_unique(StockKgPc::where('cr','=',0)->pluck('br_num')->toArray());
        $lot_stock_poids_pc = array_unique(StockPoidsPc::where('cr','=',0)->pluck('br_num')->toArray());

        $archived_lots_ids = array_merge($lot_stock_kg_pc, $lot_stock_poids_pc);

        $in_progress_lots_ids = array_unique(BonReception::whereIn('ref', $archived_lots_ids)->pluck('ref')->toArray()); */

        /* $t = BonReception::with(["stockPoidsPc" => function($q){
            $q->where('cr', '=',0)
            ->where('prix_n','=',0)
            ->where('prix_f','=',0)
            ->where('prix_p','=',0);
        }])->get();
        dd($t->first()->stockS); */

        /* $search = 0;

        $br = BonReception::whereHas('stockPoidsPc', function($q) use($search){
            $q->where('cr', '=', $search);

        })->get(); */


        $items = BonReception::query()
        //->where('ref', $archived_lots_ids)
        ->where('ref','ilike','%'.$this->search.'%')
        //->where('valide',false)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        /* $br_valide = BonReception::query()
        ->where('ref','ilike','%'.$this->search.'%')
        ->where('valide',true)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage); */

        return view('livewire.vente.designation-prix',[
            'items'=> $items,
/*             'br_valide'=>$br_valide,
 */        ]);
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

    public function designationPrix($id){

        $this->liste_poids_pc = collect(StockPoidsPc::where('br_num', $id)->get()->groupBy(['tranche_id', 'produit_id']));
        $this->liste_kg_pc = StockKgPc::where('br_num', $id)->get();
        $this->bon_reception_ref = $id;


        foreach ($this->liste_poids_pc as $key => $value) {
            $this->nom_tranche[$key] = TranchesPoidsPc::where('uid', $key)->first()->nom;

            foreach ($value as $produit => $details){
                $this->article[$key] = Produit::where('id', $produit)->first()->nom;
                foreach ($details as $k => $v){
                    $this->lot_num[$key] =$v->lot_num;
                    $this->produit_id[$key]  =$v->produit_id;
                    //$this->produit_id[$key]  = $v->lot->produit->nom;
                    $this->nom_tranche[$key]  = TranchesPoidsPc::where('uid', $v->tranche_id)->first()->nom;
                    $this->tranche_uid[$key]  = $v->tranche_id;
                    $this->poids[$key]  =$v->pas;
                    $this->code[$key] = $v->code;
                    $this->lot_num[$key] = $v->lot_num;

                }
            }

        }

        // $this->liste_poids_pc = StockPoidsPc::where('br_num',$id)->get();
        // $this->liste_kg_pc = StockKgPc::where('br_num',$id)->get();


        // foreach ($this->liste_poids_pc as $key => $value) {
        //     $this->lot_num[$key] =$value->lot_num;
        //     $this->produit_id[$key]  =$value->lot->produit->id;
        //     $this->article[$key]  =$value->lot->produit->nom;
        //     $this->nom_tranche[$key] = TranchesPoidsPc::where('uid', $value->tranche_id)->first()->nom;
        //     $this->poids[$key] = $value->poids;
        //     $this->code[$key] = $value->code;
        // }

        foreach ($this->liste_kg_pc as $k => $v) {
            $this->id_kc_pc[$k] = $v->id;
            $this->lot_num_kg_pc[$k] =$v->lot_num;
            $this->produit_id_kg_pc[$k]  =$v->lot->produit->id;
            $this->article_kg_pc[$k]  =$v->lot->produit->nom;
            $this->nom_tranche_kc_pc[$k] = TranchesKgPc::where('uid', $v->tranche_id)->first()->nom;
            $this->uid_tranche_kc_pc[$k] = TranchesKgPc::where('uid', $v->tranche_id)->first()->uid;

        }
    }

    public function show($id)
    {

        $this->liste_poids_pc = collect(StockPoidsPc::where('br_num', $id)->get()->groupBy(['tranche_id', 'produit_id']));
        $this->liste_kg_pc = StockKgPc::where('br_num', $id)->get();
        $this->bon_reception_ref = $id;


        foreach ($this->liste_poids_pc as $key => $value) {
            $this->nom_tranche[$key] = TranchesPoidsPc::where('uid', $key)->first()->nom;

            foreach ($value as $produit => $details) {
                $this->article[$key] = Produit::where('id', $produit)->first()->nom;
                foreach ($details as $k => $v) {
                    $this->lot_num[$key] = $v->lot_num;
                    $this->produit_id[$key]  = $v->produit_id;
                    //$this->produit_id[$key]  = $v->lot->produit->nom;
                    $this->nom_tranche[$key]  = TranchesPoidsPc::where('uid', $v->tranche_id)->first()->nom;
                    $this->tranche_uid[$key]  = $v->tranche_id;
                    $this->poids[$key]  = $v->pas;
                    $this->code[$key] = $v->code;
                    $this->lot_num[$key] = $v->lot_num;
                    $this->cr[$key] = $v->cr;
                    $this->prix_vente_normal[$key] = $v->prix_n;
                    $this->prix_vente_fidele[$key] = $v->prix_f;
                    $this->prix_vente_business[$key] = $v->prix_p;
                }
            }
        }

        foreach ($this->liste_kg_pc as $k => $v) {
            $this->id_kc_pc[$k] = $v->id;
            $this->lot_num_kg_pc[$k] = $v->lot_num;
            $this->produit_id_kg_pc[$k]  = $v->lot->produit->id;
            $this->article_kg_pc[$k]  = $v->lot->produit->nom;
            $this->nom_tranche_kc_pc[$k] = TranchesKgPc::where('uid', $v->tranche_id)->first()->nom;
            $this->uid_tranche_kc_pc[$k] = TranchesKgPc::where('uid', $v->tranche_id)->first()->uid;
        }
    }

    public function affecterPrix(){

        DB::transaction( function () {

            foreach ($this->produit_id as $key => $value) {
                $produit = Produit::where('id', $value)->first();
                if ($produit->modeVente->id == 1) {
                    StockPoidsPc::where('produit_id', $this->produit_id[$key])
                        ->where('lot_num', $this->lot_num[$key])
                        ->where('tranche_id', $this->tranche_uid[$key])
                        ->where('br_num', $this->bon_reception_ref)
                        ->update([
                            'cr' => $this->cr[$key],
                            'prix_n' => $this->prix_vente_normal[$key],
                            'prix_f' => $this->prix_vente_fidele[$key],
                            'prix_p' => $this->prix_vente_business[$key],
                            ]);
                }
            }
            foreach ($this->produit_id_kg_pc as $key => $value) {

               StockKgPc::where('tranche_id', $this->uid_tranche_kc_pc[$key])
                ->where('produit_id', $value)
                ->where('id', $this->id_kc_pc[$key])
                ->where('lot_num', $this->lot_num_kg_pc[$key])
                ->where('br_num', $this->bon_reception_ref)
                ->update([
                    'cr' => $this->cr_kg_pc[$key],
                    'prix_n' => $this->prix_vente_normal_kg_pc[$key],
                    'prix_f' => $this->prix_vente_fidele_kg_pc[$key],
                    'prix_p' => $this->prix_vente_business_kg_pc[$key],
                    ]);


            }
            BonReception::where('ref', $this->bon_reception_ref) ->update(['valide' => true]);

            session()->flash('message', 'Les prix du BR "' . $this->bon_reception_ref . '" sont désignés');
        });

    }


    public function saved()
    {
        return $this->render();
    }

}
