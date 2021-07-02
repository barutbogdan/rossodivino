<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTeamToCategoryTable
 */
class CreatePositionsToCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions_to_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('position_id')->unsigned()->index();
            $table->foreign('position_id')->references('id')
                                      ->on('positions')
                                      ->onDelete('cascade');

            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')
                                     ->on('positions_category')
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
        Schema::dropIfExists('positions_to_category');
    }
}
