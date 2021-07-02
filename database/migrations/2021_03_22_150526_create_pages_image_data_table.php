<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesImageDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_image_data', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('page_image_id')->unsigned()->index();
            $table->char('locale', 2)->index();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();

            $table->unique(['page_image_id', 'locale']);
            $table->foreign('page_image_id')
                  ->references('id')
                  ->on('pages_image')
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
        Schema::dropIfExists('pages_image_data');
    }
}
