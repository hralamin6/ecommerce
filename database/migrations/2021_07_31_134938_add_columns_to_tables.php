<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
           $table->foreignId('category_id')->default(0)->nullable()->after('id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_blocked')->default(0);
            $table->string('rank')->nullable()->after ('user_type')->index ();
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->string('sku')->nullable()->after ('id');
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->string('sku')->nullable()->after ('products_id');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['category_id']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_blocked', 'rank']);
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['sku']);
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['sku']);
        });
    }
}
