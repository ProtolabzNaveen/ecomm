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
            $table->id(); // Primary key (Order ID)
            
            // User information (Customer placing the order)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // References users table
            $table->string('order_number')->unique(); // Unique order number
            $table->string('status')->default('pending'); // Order status (e.g., pending, completed, canceled)
            
            // Shipping details
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_zip');
            $table->string('shipping_country');
            $table->string('shipping_method'); // Method of shipping (e.g., standard, express)
            $table->decimal('shipping_cost', 10, 2)->default(0); // Shipping cost

            // Order totals
            $table->decimal('total_amount', 10, 2); // Total order amount
            $table->decimal('discount', 10, 2)->default(0); // Discount applied to the order
            $table->decimal('tax', 10, 2)->default(0); // Tax applied

            // Optional: Tracking and other details
            $table->string('tracking_number')->nullable(); // Tracking number for shipment
            $table->string('carrier')->nullable(); // Carrier name (e.g., FedEx, UPS)
            $table->timestamp('ordered_at')->nullable(); // When the order was placed
            $table->timestamp('shipped_at')->nullable(); // When the order was shipped
            $table->timestamp('delivered_at')->nullable(); // When the order was delivered

            // Timestamps for created_at and updated_at
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
        Schema::dropIfExists('orders');
    }
}
