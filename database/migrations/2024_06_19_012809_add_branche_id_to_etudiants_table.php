<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBrancheIdToEtudiantsTable extends Migration
{
    public function up()
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->string('Branche_id')->nullable()->after('Annee_Scolaire'); // Ajoutez la colonne Branche_id
          
        });
    }

    public function down()
    {
    }
}
