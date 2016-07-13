<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuotations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->date('expiry_date');
            $table->string('status',100)->default('Quotation');//later will be used for invoice 
            $table->string('payment_term',100);
            $table->integer('added_by')->unsigned();
            $table->timestamps();
        });

        // Foreign Keys
        Schema::table('quotations', function(Blueprint $table) {
           $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::drop('quotations');
    }
}
