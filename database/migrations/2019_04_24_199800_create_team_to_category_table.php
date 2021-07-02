<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTeamToCategoryTable
 */
class CreateTeamToCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_to_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('team_id')->unsigned()->index();
            $table->foreign('team_id')->references('id')
                                      ->on('team')
                                      ->onDelete('cascade');

            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')
                                     ->on('team_category')
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
        Schema::dropIfExists('team_to_category');
    }
}
