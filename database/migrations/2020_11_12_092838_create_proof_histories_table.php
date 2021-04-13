<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProofHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proof_history', function (Blueprint $table) {
            $table->increments('id');
            $table->BigInteger('user_id');
            $table->String('page_name');
            $table->String('ip_address')->default('-');
            $table->Integer('debit')->default(0);
            $table->Integer('kredit')->default(0);
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
        Schema::dropIfExists('proof_history');
    }
}
