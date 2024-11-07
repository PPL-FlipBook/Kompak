<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sales_information', function (Blueprint $table) {
            $table->string('bank_bri_name')->nullable()->after('bank_bri');
            $table->string('bank_bca_name')->nullable()->after('bank_bca');
            $table->string('bank_mandiri_name')->nullable()->after('bank_mandiri');
            $table->string('dana_name')->nullable()->after('dana');
            $table->string('ovo_name')->nullable()->after('ovo');
            $table->string('gopay_name')->nullable()->after('gopay');
        });
    }

    public function down()
    {
        Schema::table('sales_information', function (Blueprint $table) {
            $table->dropColumn([
                'bank_bri_name',
                'bank_bca_name',
                'bank_mandiri_name',
                'dana_name',
                'ovo_name',
                'gopay_name'
            ]);
        });
    }
};
