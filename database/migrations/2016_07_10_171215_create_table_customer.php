<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_type',20);
            $table->string('customer_vendor',20);
            $table->string('customer_name',255);
            $table->string('company_name',255);
            $table->string('job_position',255);
            $table->string('street',255);
            $table->string('city',100);
            $table->string('country',100);
            $table->string('website',255);
            $table->string('phone',100);
            $table->string('mobile',100);
            $table->string('email',255);
            $table->integer('added_by')->unsigned();
            $table->timestamps();
        });

        // Foreign Keys
        Schema::table('customers', function(Blueprint $table) {
           $table->foreign('added_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers');
    }
}
