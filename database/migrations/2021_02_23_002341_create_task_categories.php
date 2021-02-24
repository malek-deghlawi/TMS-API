<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_categories', function (Blueprint $table) {
            $table->unsignedInteger('task_id');
            $table->foreign('task_id', 'task_id_fk_1800003')->references('id')->on('tasks')->onDelete('cascade');
            $table->unsignedInteger('categorie_id');
            $table->foreign('categorie_id', 'categorie_id_fk_1800004')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_categories');
    }
}
