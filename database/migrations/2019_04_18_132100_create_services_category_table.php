<?php

use App\ServiceCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('service_id')->unsigned()->index();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->integer('order');
            $table->enum('is_home', [ServiceCategory::ENUM_ACTIVE, ServiceCategory::ENUM_INACTIVE]);
            $table->enum('status', [ServiceCategory::ENUM_ACTIVE, ServiceCategory::ENUM_INACTIVE]);
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
        Schema::dropIfExists('services_category');
    }
}
