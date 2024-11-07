<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreignId('sales_information_id')->nullable()
                ->after('book_id')
                ->constrained('sales_information')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['sales_information_id']);
            $table->dropColumn('sales_information_id');
        });
    }
};
