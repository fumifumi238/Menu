<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
          //ユーザーテーブルと連携するためのカラムuser_id
          $table->bigIncrements('id');
          $table->string('name');
          $table->string('image');
          $table->integer('price');
          $table->timestamps();
          $table->bigInteger('user_id')->unsigned();

//外部キー制約
$table->foreign('user_id')
           ->references('id')
           ->on('users')
  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
              Schema::dropIfExists('menu');
    }
}
