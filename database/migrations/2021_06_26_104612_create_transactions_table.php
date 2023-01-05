<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('work_id')->nullable();
            $table->foreignId('order_id')->nullable();
            $table->enum('type', [
                /* income balance */
                'upgrade',
                'referral',
                'work',
                'rank',
                'generation',
                'incentive i-Balance',
                'incentive e-Balance',
                'withdraw',
                'send money',
                /* shop balance income */
                'verification reward',
                'product reward',
                'purchase reward',
                'received balance',
                /*  expense */
                'shop expense',
                'income expense',
                'upgrade expense'

            ])->nullable();
            $table->decimal('amount')->default(0);
            $table->string('note', 255)->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('transactions');
    }
}
