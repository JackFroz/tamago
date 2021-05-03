<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_divisions', function (Blueprint $table) {
            $table->string('division_id', 12)->unique();
            $table->uuid('project_id');
            $table->foreign('project_id')->references('project_id')->on('projects');
            $table->string('division_name', 50);
            $table->string('division_desc', 1000)->nullable();
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
        Schema::dropIfExists('project_divisions');
    }
}
