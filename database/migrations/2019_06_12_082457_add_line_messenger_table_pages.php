<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLineMessengerTablePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages',function(Blueprint $table){
          $table->string('line_title')->nullable();
          $table->string('line_link')->nullable();
          $table->integer('line_pixel_id')->nullable();
          $table->string('line_logo')->nullable();
          $table->string('messenger_title')->nullable();
          $table->string('messenger_link')->nullable();
          $table->integer('messenger_pixel_id')->nullable();
          $table->string('messenger_logo')->nullable();
          $table->integer('line_link_counter')->default(0);
          $table->integer('messenger_link_counter')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
