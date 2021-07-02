<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRealisationsDataIndexesTable
 */
class CreateRealisationsDataIndexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('realisations_data', function (Blueprint $table) {
            $table->foreign('realisation_id')
                ->references('id')
                ->on('realisations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('realisations_data', function (Blueprint $table) {
            $table->dropForeign(['realisation_id']);
        });
    }
}
