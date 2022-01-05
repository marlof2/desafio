<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tipo_endereco');
            $table->unsignedBigInteger('id_estado');
            $table->unsignedBigInteger('id_cidade');
            $table->string('cep');
            $table->string('logradouro');
            $table->string('numero');
            $table->string('complemento');
            $table->string('bairro');
            $table->timestamps();

            $table->foreign('id_tipo_endereco')->references('id')->on('endereco')->onDelete('cascade');
            $table->foreign('id_estado')->references('id')->on('estado')->onDelete('cascade');
            $table->foreign('id_cidade')->references('id')->on('cidade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endereco');
    }
}
