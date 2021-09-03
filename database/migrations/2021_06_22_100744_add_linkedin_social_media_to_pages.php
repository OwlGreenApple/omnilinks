<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkedinSocialMediaToPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('lnd_title')->nullable()->after('ig_logo');
            $table->string('lnd_link')->nullable()->after('lnd_title');
            $table->Integer('lnd_pixel_id')->default(0)->after('lnd_link');
            $table->string('lnd_logo')->nullable()->after('lnd_pixel_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('lnd_title');
            $table->dropColumn('lnd_link');
            $table->dropColumn('lnd_pixel_id');
            $table->dropColumn('lnd_logo');
        });
    }
}
