<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('menu_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')
                       ->references('id')
                       ->on('users')
              ->onDelete('cascade');
            $table->foreign('menu_id')
                        ->references('id')
                        ->on('menu')
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
        Schema::dropIfExists('comment');
    }
}
