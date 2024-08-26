<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('client_name')->nullable();
            $table->string('client_number1', 11)->nullable();
            $table->string('client_number2', 11)->nullable();
            $table->string('client_address')->nullable();
            $table->unsignedBigInteger('governorate_id')->nullable();
            $table->string('client_username')->nullable();
            $table->string('seller_name')->nullable();
            $table->decimal('total', 8, 2)->nullable();
            $table->integer('shipping')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['approved', 'pendding', 'refused'])->default('pendding');
            $table->enum('plateform', ['facebook', 'whatsapp', 'instagram', 'olx'])->nullable();
            $table->timestamps();

            $table->foreign('governorate_id')
                ->references('id')
                ->on('governorates');
        });


        Schema::create('order_product', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('discount', 8, 2);
            $table->string('color');
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
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
        Schema::dropIfExists('orders');
    }
}
