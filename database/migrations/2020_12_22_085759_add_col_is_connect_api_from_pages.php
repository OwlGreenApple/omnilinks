<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColIsConnectApiFromPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('connect_activrespon')->default(0)->after('user_id');
            $table->string('list_id')->nullable()->after('connect_activrespon');
            $table->boolean('connect_mailchimp')->default(0)->after('list_id');
            $table->string('api_key_mc')->nullable()->after('connect_mailchimp');
            $table->string('server')->nullable()->after('api_key_mc');
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
