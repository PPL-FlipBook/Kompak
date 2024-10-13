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
        Schema::table('activity_log', function (Blueprint $table) {
            $table->char('subject_id', 36)->change(); // Ubah tipe menjadi CHAR(36)
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->integer('subject_id')->change(); // Kembalikan ke tipe integer jika perlu
        });
    }

};
