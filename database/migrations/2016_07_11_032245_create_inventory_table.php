<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('vendor')->unsigned();
            $table->string('vendor_product_code',255);
            $table->string('vendor_product_name',255);
            $table->decimal('vendor_quantity', 10, 2);
            $table->decimal('vendor_price', 10, 2);
            $table->date('vendor_produce');
            $table->date('vendor_expiry');
            $table->integer('added_by')->unsigned();
            $table->timestamps();
        });
        // Foreign Keys
        Schema::table('inventory', function(Blueprint $table) {
           $table->foreign('product_id')->references('id')->on('products');
           $table->foreign('vendor')->references('id')->on('customers');
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
        Schema::drop('inventory');
    }
}
