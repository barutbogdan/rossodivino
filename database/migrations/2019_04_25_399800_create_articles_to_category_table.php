<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesToCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_to_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('article_id')->unsigned()->index();
            $table->foreign('article_id')->references('id')
                                      ->on('articles')
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
        Schema::dropIfExists('articles_to_category');
    }
}
