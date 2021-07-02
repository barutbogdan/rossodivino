<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_to_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('project_id')->unsigned()->index();
            $table->foreign('project_id')->references('id')
                                      ->on('projects')
                                      ->onDelete('cascade');

            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')
                                     ->on('projects_category')
                                     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects_to_categories');
    }
}
