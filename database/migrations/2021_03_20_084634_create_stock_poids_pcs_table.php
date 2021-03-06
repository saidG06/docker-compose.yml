<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPoidsPcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_poids_pcs', function (Blueprint $table) {
            $table->id();
            $table->integer('qte');
            $table->decimal('prix_achat');
            $table->string('code');
            $table->double('poids');
            $table->decimal('cr');
            $table->decimal('prix_n');
            $table->decimal('prix_f');
            $table->decimal('prix_p');
            $table->decimal('pas');

            $table->unsignedBigInteger('unite_id');
            $table->foreign('unite_id')->references('id')->on('unites');

            $table->string('br_num');
            $table->foreign('br_num')->references('ref')->on('bon_receptions');

            $table->string('lot_num');
            //$table->foreign('lot_num')->references('lot_num')->on('lots');
            $table->unsignedBigInteger('sous_categorie_id');
            $table->unsignedBigInteger('categorie_id');

            $table->unsignedBigInteger('produit_id');
            $table->foreign('produit_id')->references('id')->on('produits');

            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->foreign('sous_categorie_id')->references('id')->on('sous_categories');

            $table->string('tranche_id');
            //$table->foreign('tranche_id')->references('id')->on('tranches');
            $table->foreign('tranche_id')->references('uid')->on('tranches_poids_pcs');

            $table->unsignedBigInteger('depot_id');
            $table->foreign('depot_id')->references('id')->on('depots');

            $table->unsignedBigInteger('qualite_id');
            $table->foreign('qualite_id')->references('id')->on('qualites');

            $table->unsignedBigInteger('promo_id')->nullable();;
            $table->foreign('promo_id')->references('id')->on('promos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_poids_pcs');
    }
}
