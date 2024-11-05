<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrancheSpecialiteTable extends Migration
{
    public function up()
    {
        Schema::create('branche_specialite', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Branche_id');
            $table->unsignedBigInteger('Specialite_id');
            $table->timestamps();
            
            // Clés étrangères
            $table->foreign('branche_id')->references('Branche_id')->on('branches')->onDelete('cascade');
            $table->foreign('specialite_id')->references('Specialite_id')->on('Specialites')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('branche_specialite');
    }
}
