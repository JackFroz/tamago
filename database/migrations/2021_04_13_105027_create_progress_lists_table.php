<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_lists', function (Blueprint $table) {
            $table->string('list_id', 12)->unique();
            $table->string('division_id', 12);
            $table->foreign('division_id')->references('division_id')->on('project_divisions');
            $table->string('list_name', 25);
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
        Schema::dropIfExists('progress_lists');
    }
}
