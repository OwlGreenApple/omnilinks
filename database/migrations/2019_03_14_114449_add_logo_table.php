<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
        $table->string('wa_logo')->nullable()->after('wa_pixel_id');
        $table->string('fb_logo')->nullable()->after('fb_pixel_id');
        $table->string('ig_logo')->nullable()->after('ig_pixel_id');
        $table->string('twitter_logo')->nullable()->after('twitter_pixel_id');
        $table->string('youtube_logo')->nullable()->after('youtube_pixel_id');
        $table->string('telegram_logo')->nullable()->after('telegram_pixel_id');
        $table->string('skype_logo')->nullable()->after('skype_pixel_id');
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
