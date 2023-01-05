<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('parent_id')->nullable();
            $table->enum('user_type', ['regular', 'premium', 'admin'])->default('regular')->nullable();
            $table->string('username')->nullable()->unique();
            $table->unsignedDecimal('point')->default(0);
            $table->unsignedDecimal('balance')->default(0);
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('referral_user')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->string('password');
            $table->string('remember_token', 100)->nullable();
            $table->string('shipping', 300)->nullable();
            $table->string('nid1')->nullable();
            $table->string('nid2')->nullable();
            $table->string('nid')->unique()->nullable();
            $table->boolean('is_pending')->default(0);
            $table->boolean('is_accepted')->default(0);
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->index('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
