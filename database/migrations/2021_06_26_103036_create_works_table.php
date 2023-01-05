<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('file')->nullable();
            $table->string('notes', 255)->nullable();
            $table->enum('type', ['image', 'video','youtube'])->nullable();
            $table->unsignedInteger('duration')->default(5);
            $table->unsignedInteger('price')->default(2);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('works');
    }
}
