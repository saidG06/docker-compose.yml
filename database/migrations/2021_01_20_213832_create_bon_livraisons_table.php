<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_livraisons', function (Blueprint $table) {
            $table->id();

            $table->string('ref');
            $table->date('date');
            $table->integer('validation');
            //$table->integer('etat')->nullable();
            $table->double('totalMt');
            $table->double('totalTva');
            $table->double('totalTtc');
            $table->foreignId('site_id');
            $table->foreignId('depot_id');
            $table->foreignId('client_id');
            $table->foreignId('client_site_id')->nullable();
            $table->foreignId('client_depot_id')->nullable();
            $table->foreignId('commercial_id');
            $table->foreignId('user_id');

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
        Schema::dropIfExists('bon_livraisons');
    }
}
