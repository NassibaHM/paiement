<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id('paiement_id');
            $table->unsignedBigInteger('etudiant_id');
            $table->date('date_paiement');
            $table->string('mode_paiement');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('etudiant_id')->references('etudiants_id')->on('etudiants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiements');
    }
}
