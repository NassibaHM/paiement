<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id('etudiants_id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->string('CNE');
            $table->boolean('Bourse')->default(false);
            $table->decimal('valeur_bourse', 8, 2)->nullable();
            $table->boolean('parents_profs')->default(false);
            $table->string('paiement_annuel')->nullable();
            $table->string('mode_paiement');
            $table->date('Date_Naissance');
            $table->string('Annee_Scolaire');
            $table->unsignedBigInteger('Branche_id');
            $table->unsignedBigInteger('specialite_id')->nullable();
            $table->timestamps();

            $table->foreign('Branche_id')->references('Branche_id')->on('branches')->onDelete('cascade');
            $table->foreign('specialite_id')->references('Specialite_id')->on('specialites')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('etudiants');
    }
};
