<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefone', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tipo_telefone');
            $table->string('numero');
            $table->string('ddd');
            $table->string('nome_secretaria');
            $table->timestamps();

            $table->foreign('id_tipo_telefone')->references('id')->on('tipo_telefone')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefone');
    }
}
