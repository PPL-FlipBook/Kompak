<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sales_information', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id')->nullable();
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->string('bank_bri')->nullable();
            $table->string('bank_bca')->nullable();
            $table->string('bank_mandiri')->nullable();
            $table->string('dana')->nullable();
            $table->string('ovo')->nullable();
            $table->string('gopay')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_information');
    }
};
