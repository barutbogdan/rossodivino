<?php

use App\Modules\Mailer\EmailTemplate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEmailTemplateTable
 */
class CreateEmailTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('template');
            $table->char('locale', 2);
            $table->string('from_name')->nullable();
            $table->string('from_address')->nullable();
            $table->string('subject');
            $table->longText('content');
            $table->boolean('extend');
            $table->enum('status', [EmailTemplate::STATUS_ON, EmailTemplate::STATUS_OFF]);
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
        Schema::dropIfExists('email_templates');
    }
}
