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
            $table->bigIncrements('id');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->text('description')->nullable();
            $table->string('thumbnail_img', 255)->nullable();
            $table->json('gallery')->nullable();
            $table->double('sale_price', 20, 2)->default(0);
            $table->double('purchase_price', 20, 2)->default(0);
            $table->double('point', 20, 2)->default(0);
            $table->string('attributes', 1000)->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->mediumText('colors')->nullable();
            $table->mediumText('sizes')->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->boolean('is_flash')->default(0)->nullable();
            $table->boolean('is_feature')->default(0)->nullable();
            $table->boolean('is_variant')->default(0);
            $table->double('rating', 4, 2)->default(0)->nullable();
            $table->unsignedInteger('total_sale')->default(0)->nullable();
            $table->decimal('discount')->nullable();
            $table->enum('discount_type', ['percentage', 'amount'])->nullable();
            $table->index('slug');
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
