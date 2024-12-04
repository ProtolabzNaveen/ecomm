<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Product name
            $table->text('description')->nullable(); // Product description (nullable)
            $table->decimal('price', 10, 2); // Product price with two decimal places
            $table->decimal('sale_price', 10, 2)->nullable(); // Product sale price (nullable)
            $table->integer('stock')->default(0); // Stock quantity
            $table->integer('category_id')->nullable(); // Category ID (nullable for unclassified products)
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); // Foreign key for category
            $table->string('sku')->unique(); // Unique Stock Keeping Unit
            $table->string('image')->nullable(); // Image URL or file path (nullable)
            $table->enum('status', ['active', 'inactive'])->default('active'); // Product status
            $table->softDeletes(); // Soft delete timestamp (optional, if you want to keep deleted records)
            $table->boolean('is_featured')->default(false); // Featured product flag
            $table->json('attributes')->nullable(); // JSON column for additional product attributes (e.g., color, size)
            $table->float('rating')->default(0); // Product rating (can be used for reviews)
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
