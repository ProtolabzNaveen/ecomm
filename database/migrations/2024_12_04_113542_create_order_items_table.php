<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key (order item ID)
            
            // Foreign keys to orders and products
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // References the orders table
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // References the products table

            // Product details for the order item
            $table->integer('quantity'); // Quantity of the product ordered
            $table->decimal('price', 10, 2); // Price of a single unit of the product
            $table->decimal('total_price', 10, 2); // Total price for this item (quantity * price)

            // Timestamps
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
