<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAssignedTo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_assigned_to', function (Blueprint $table) {
            $table->unsignedInteger('task_id');
            $table->foreign('task_id', 'task_id_fk_1800001')->references('id')->on('tasks')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_1800002')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_assigned_to');
    }
}
