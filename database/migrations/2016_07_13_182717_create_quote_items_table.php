<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity');
            $table->decimal('sale_price',10,2);
            $table->decimal('subtotal',10,2);
            $table->string('description',255);
            $table->integer('added_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        // Foreign Keys
        Schema::table('quote_items', function(Blueprint $table) {
           $table->foreign('quote_id')->references('id')->on('quotations');
           $table->foreign('product_id')->references('id')->on('products');
           $table->foreign('added_by')->references('id')->on('users');
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
        Schema::drop('quote_items');
    }
}
