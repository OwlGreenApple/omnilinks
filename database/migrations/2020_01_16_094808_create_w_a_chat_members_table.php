<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWAChatMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wa_chat_members', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->BigInteger('user_id');
            $table->BigInteger('pages_id');
            $table->string('uid');
            $table->string('member_name');
            $table->string('position');
            $table->string('wa_number');
            $table->string('photo')->nullable();
            $table->boolean('is_online')->default(0);
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
        Schema::dropIfExists('wa_chat_members');
    }
}
