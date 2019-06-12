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
          $table->string('line_title');
          $table->string('line_link');
          $table->integer('line_pixel_id');
          $table->string('line_logo');
          $table->string('messenger_title');
          $table->string('messenger_link');
          $table->integer('messenger_pixel_id');
          $table->string('messenger_logo');
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
