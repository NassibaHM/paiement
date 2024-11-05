<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMontantRestantToEtudiantsTable extends Migration
{
    public function up()
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->decimal('MontantRestant', 10, 2)->default(0)->after('Branche_id');
        });
    }

    public function down()
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->decimal('MontantRestant', 8, 2)->nullable();
        });
    }
}
