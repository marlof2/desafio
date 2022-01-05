<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_setor');
            $table->unsignedBigInteger('id_perfil');
            $table->string('cpf');
            $table->string('login');
            $table->string('name');
            $table->string('password');
            $table->boolean('ativo')->default('1');
            $table->string('email')->unique();
            $table->timestamps();

            $table->foreign('id_setor')->references('id')->on('setor')->onDelete('cascade');
            $table->foreign('id_perfil')->references('id')->on('perfil')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
