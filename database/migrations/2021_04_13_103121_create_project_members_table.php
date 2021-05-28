<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_members', function (Blueprint $table) {
            $table->string('member_id', 12)->unique();
            $table->uuid('project_id');
            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
            $table->string('division_id', 12)->nullable();
            $table->foreign('division_id')->references('division_id')->on('project_divisions')->onDelete('cascade');
            $table->string('username', 16);
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
            $table->tinyInteger('permission')->nullable();
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
        Schema::dropIfExists('project_members');
    }
}
