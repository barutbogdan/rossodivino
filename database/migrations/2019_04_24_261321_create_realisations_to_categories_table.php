<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRealisationsToCategoriesTable
 */
class CreateRealisationsToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisations_to_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('realisation_id')->unsigned()->index();
            $table->foreign('realisation_id')->references('id')
                                      ->on('realisations')
                                      ->onDelete('cascade');

            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')
                                     ->on('realisations_category')
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
        Schema::dropIfExists('services_to_categories');
    }
}
