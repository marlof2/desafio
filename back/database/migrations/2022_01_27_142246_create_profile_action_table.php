<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_action', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
//            $table->unsignedBigInteger('id_profile');
            $table->unsignedBigInteger('id_action');
            $table->timestamps();

//            $table->foreign('id_profile')->references('id')->on('profile')->onDelete('cascade');
            $table->foreign('id_action')->references('id')->on('action')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_action');
    }
}
