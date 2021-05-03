<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_members', function (Blueprint $table) {
            $table->string('card_member_id', 12)->unique();
            $table->string('card_id', 12);
            $table->foreign('card_id')->references('card_id')->on('cards');
            $table->string('member_id', 12);
            $table->foreign('member_id')->references('member_id')->on('project_members');
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
        Schema::dropIfExists('card_members');
    }
}
