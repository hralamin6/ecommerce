<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_pages', function (Blueprint $table) {
            $table->id();
            $table->text('terms_conditions')->nullable()->default('terms_conditions');
            $table->text('privacy_policy')->nullable()->default('privacy_policy');
            $table->text('about_us')->nullable()->default('about_us');
            $table->text('terms_of_service')->nullable()->default('terms_of_service');
            $table->text('refund_policy')->nullable()->default('refund_policy');
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
        Schema::dropIfExists('extra_pages');
    }
}
