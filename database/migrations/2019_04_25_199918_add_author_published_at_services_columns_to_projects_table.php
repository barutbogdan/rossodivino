<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthorPublishedAtServicesColumnsToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->date('published_at')->nullable();
        });

        Schema::table('projects_data', function (Blueprint $table) {
            $table->string('author')->nullable();
            $table->longText('services')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('published_at');
        });

        Schema::table('projects_data', function (Blueprint $table) {
            $table->dropColumn('author');
            $table->dropColumn('services');
        });
    }
}
