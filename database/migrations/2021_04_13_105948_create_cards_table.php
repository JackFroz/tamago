<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->string('card_id', 12)->unique();
            $table->string('list_id', 12);
            $table->foreign('list_id')->references('list_id')->on('progress_lists');
            $table->string('card_name', 50);
            $table->string('card_desc', 1000)->nullable();
            $table->dateTime('card_deadline')->nullable();
            $table->integer('order');
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
        Schema::dropIfExists('cards');
    }
}
