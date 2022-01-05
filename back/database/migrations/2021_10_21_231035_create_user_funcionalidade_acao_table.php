<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFuncionalidadeAcaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_funcionalidade_acao', function (Blueprint $table) {
//            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_funcionalidade');
            $table->unsignedBigInteger('id_acao');
            $table->timestamps();

            $table->foreign('id_funcionalidade')->references('id')->on('funcionalidade')->onDelete('cascade');
            $table->foreign('id_acao')->references('id')->on('acao')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_funcionalidade_acao');
    }
}
