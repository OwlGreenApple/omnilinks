<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->nullable()->default(0);
            $table->integer('pages_id')->nullable()->default(0);
            $table->integer('pixel_id')->nullable()->default(0);
            $table->integer('counter')->nullable()->default(0);
            $table->string('title')->nullable();
            $table->string('images_banner')->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('banner');
    }
}
