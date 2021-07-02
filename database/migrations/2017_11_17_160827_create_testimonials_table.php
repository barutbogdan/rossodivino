<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('testimonials_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('testimonial_id')->unsigned()->index();
            $table->char('locale', 2)->index();
            $table->string('slug');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('seo_keywords');
            $table->string('name');
            $table->string('profession');
            $table->string('short_description');
            $table->text('description');
            $table->timestamps();

            $table->unique(['testimonial_id', 'locale']);
            $table->foreign('testimonial_id')
                ->references('id')
                ->on('testimonials')
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
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('testimonials_data');
    }
}
