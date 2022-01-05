<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetorSemanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setor_semana', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_setor');
            $table->unsignedBigInteger('id_semana');
            $table->timestamps();

            $table->foreign('id_setor')->references('id')->on('setor')->onDelete('cascade');
            $table->foreign('id_semana')->references('id')->on('semana')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setor_semana');
    }
}
