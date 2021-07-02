<?php

use App\ServiceCategory;
use App\TeamCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTeamCategoryTable
 */
class CreateTeamCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('team_id')->unsigned()->index();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->integer('order');
            $table->enum('status', [TeamCategory::ENUM_ACTIVE, TeamCategory::ENUM_INACTIVE]);
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
        Schema::dropIfExists('team_category');
    }
}
