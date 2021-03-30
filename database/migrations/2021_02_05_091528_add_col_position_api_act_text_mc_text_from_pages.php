<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColPositionApiActTextMcTextFromPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('position_api')->default(0)->after('audience_id');
            $table->string('act_form_text')->default('Form Activrespons')->after('connect_activrespon');
            $table->string('mc_form_text')->default('Form Mailchimps')->after('connect_mailchimp');
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
            $table->dropColumn('position_api');
            $table->dropColumn('act_form_text');
            $table->dropColumn('mc_form_text');
        });
    }
}
