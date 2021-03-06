<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('lot_num',10);
            $table->date('date_capture')->nullable();
            $table->date('date_entree');
            $table->date('date_preemption')->nullable();
            $table->float('pas');
            $table->integer('nombre_pieces');
            $table->boolean('active')->default(false);

            $table->string('bon_reception_ref');
            $table->foreign('bon_reception_ref')->references('ref')->on('bon_receptions')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('fournisseur_id');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs');
            $table->unsignedBigInteger('qualite_id')->nullable();
            $table->foreign('qualite_id')->references('id')->on('qualites')->nullable();
            $table->unsignedBigInteger('produit_id');
            $table->foreign('produit_id')->references('id')->on('produits');
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
        Schema::dropIfExists('lots');
    }
}
