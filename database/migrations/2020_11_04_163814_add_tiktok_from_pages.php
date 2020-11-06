<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTiktokFromPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) 
        {
            $table->string('tk_title')->nullable()->after('ig_logo');
            $table->string('tk_link')->nullable()->after('tk_title');
            $table->Integer('tk_pixel_id')->default(0)->after('tk_link');
            $table->string('tk_logo')->nullable()->after('tk_pixel_id');
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
            //
        });
    }
}
