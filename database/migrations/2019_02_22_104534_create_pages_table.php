<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->smallinteger('type');
            $table->string('wa_title')->nullable();
            $table->string('wa_link')->nullable();
            $table->integer('wa_pixel_id')->default(0);
            $table->string('keterangan')->nullable();
            $table->string('fb_title')->nullable();
            $table->string('fb_link')->nullable();
            $table->integer('wa_pixel_id')->default(0);
            $table->string('ig_title')->nullable();
            $table->string('ig_link')->nullable();
            $table->integer('ig_pixel_id')->default(0);
            $table->string('twitter_title')->nullable();
            $table->string('twitter_link')->nullable();
            $table->integer('twitter_pixel_id')->default(0);
            $table->string('youtube_title')->nullable();
            $table->string('youtube_link')->nullable();
            $table->integer('youtube_pixel_id')->default(0);
            $table->string('telegram_title')->nullable();
            $table->string('telegram_link')->nullable();
            $table->integer('telegram_pixel_id')->default(0);
            $table->string('skype_title')->nullable();
            $table->string('skype_link')->nullable();
            $table->integer('skype_pixel_id')->default(0);
            $table->integer('wa_link_counter')->default(0);
            $table->integer('fb_link_counter')->default(0);
            $table->integer('ig_link_counter')->default(0);
            $table->integer('twitter_link_counter')->default(0);
            $table->integer('youtube_link_counter')->default(0);
            $table->integer('telegram_link_counter')->default(0);
            $table->integer('skype_link_counter')->default(0);
            $table->string('description')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
