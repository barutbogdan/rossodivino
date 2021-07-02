<?php

use App\PositionCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePositionCategoryTable
 */
class CreatePositionsCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('position_id')->unsigned()->index();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->integer('order');
            $table->enum('status', [
                PositionCategory::ENUM_ACTIVE,
                PositionCategory::ENUM_INACTIVE
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions_category');
    }
}
