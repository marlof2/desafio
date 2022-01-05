<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medico', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_especialidade');
            $table->string('nome');
            $table->string('crm');
            $table->string('emai');
            $table->string('data_formacao');
            $table->string('data_aniversario');
            $table->boolean('ativo')->default(1);
            $table->string('sexo');
            $table->timestamps();

            $table->foreign('id_especialidade')->references('id')->on('especialidade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medico');
    }
}
