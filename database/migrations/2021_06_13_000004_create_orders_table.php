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
            $table->bigIncrements('id');
            $table->foreignId('user_id')->nullable();
            $table->string('code')->unique()->nullable();
            $table->text('shipping_address')->nullable();
            $table->enum('delivery_status', ['ordered', 'accepted', 'processing', 'delivered', 'canceled',])->default('ordered');
            $table->enum('payment_type', ['cash on delivery', 'ssl commerce', 'income balance', 'shopping balance', 'mobile banking'])->nullable();
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');
            $table->decimal('grand_total', 20, 2)->default(0);
            $table->double('coupon_discount', 20, 2)->nullable();
            $table->double('commission', 20, 2)->default(0);
            $table->double('shipping_cost', 20, 2)->nullable();
            $table->string('shipping_district')->nullable();
            $table->string('trx', 100)->nullable();
            $table->string('payment_number', 50)->nullable();
            $table->boolean('viewed')->default(0);
            $table->index('code');
            $table->string('transaction_id')->unique()->nullable();
            $table->string('status')->nullable();
            $table->float('amount')->nullable();
//            $table->string('name')->nullable();
//            $table->string('phone')->nullable();
//            $table->string('email')->nullable();
//            $table->string('address')->nullable();
            $table->string('currency')->nullable();
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
