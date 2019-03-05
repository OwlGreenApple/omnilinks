<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhatsapplinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whatsapplinks', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('pages_id')->default(0);
            $table->integer('users_id')->default(0);
            $table->string('tittle')->nullable();
            $table->biginteger('nomor')->unique();
            $table->text('pesan')->nullable();
            $table->string('linkgenerator')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whatsapplink');
    }
}
