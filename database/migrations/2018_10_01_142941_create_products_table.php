<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('brand_name');
            $table->string('generic_name');
            $table->text('description');
            $table->date('date_arrival');
            $table->date('expiry_date');
            $table->float('selling_price');
            $table->float('original_price');
            $table->integer('quantity');
            $table->integer('quantity_left');
            $table->integer('profit');
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
        Schema::dropIfExists('products');
    }
}
