<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hora', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_medico');
            $table->string('hora_inicio_manha');
            $table->string('hora_fim_manha');
            $table->string('hora_inicio_tarde');
            $table->string('hora_fim_tarde');
            $table->timestamps();

            $table->foreign('id_medico')->references('id')->on('medico')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hora');
    }
}
