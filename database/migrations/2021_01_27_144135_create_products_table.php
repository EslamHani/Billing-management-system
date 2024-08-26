<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('code');
            $table->string('product_name')->unique();
            $table->string('photo');
            $table->longtext('description');
            $table->decimal('selling_price', 5, 2)->default(0);
            $table->decimal('Purchasing_price', 5, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->unsignedBigInteger('dep_id');
            $table->unsignedBigInteger('trade_id');
            $table->timestamps();

            $table->foreign('dep_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade');

            $table->foreign('trade_id')
                ->references('id')
                ->on('trademarks')
                ->onDelete('cascade');
        });


        Schema::create('color_product', function(Blueprint $table) {
            $table->primary(['product_id', 'color_id']);
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('color_id');
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onDelete('cascade');
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
