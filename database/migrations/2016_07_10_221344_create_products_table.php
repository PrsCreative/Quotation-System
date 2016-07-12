<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_type',50);
            $table->string('product_name',255);
            $table->string('internal_reference',255);
            $table->string('barcode',255);
            $table->decimal('sale_price', 10, 2);
            $table->decimal('cost', 10, 2);
            $table->decimal('weight', 10, 2);
            $table->decimal('volume', 10, 2);
            $table->integer('added_by')->unsigned();
            $table->timestamps();
        });
        // Foreign Keys
        Schema::table('products', function(Blueprint $table) {
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
        Schema::drop('products');
    }
}
