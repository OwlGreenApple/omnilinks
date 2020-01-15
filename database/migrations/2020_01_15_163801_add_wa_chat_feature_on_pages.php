<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWaChatFeatureOnPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages',function(Blueprint $table){
           $table->boolean('enable_chat')->default(0)->after('bio_color');
           $table->boolean('buzz_btn')->default(0)->after('enable_chat');
           $table->string('wa_btn_text')->nullable()->after('buzz_btn');
           $table->text('wa_header')->nullable()->after('wa_btn_text');
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
