<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name',255);
            $table->string('address1',255);
            $table->string('address2',255);
            $table->string('country',255);
            $table->string('email',255);
            $table->string('phone',100);
            $table->string('mobile',100);
            $table->longtext('terms');
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        // Foreign Keys
        Schema::table('settings', function(Blueprint $table) {
           $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
