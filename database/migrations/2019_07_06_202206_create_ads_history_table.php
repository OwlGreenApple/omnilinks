<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('ads_id');
            $table->integer('credit_before')->default(0);
            $table->integer('credit_after')->default(0);
            $table->integer('jml_credit')->default(0);
            $table->boolean('is_view')->default(0);
            $table->boolean('is_click')->default(0);
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
        Schema::dropIfExists('ads_history');
    }
}
