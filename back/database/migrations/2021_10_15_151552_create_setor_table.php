<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setor', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->unsignedBigInteger('id_semana');
            $table->string('codigo_setor');
            $table->string('nome');
            $table->boolean('ativo')->default(1);
            $table->timestamps();

//            $table->foreign('id_semana')->references('id')->on('semana')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setor');
    }
}
