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
        Schema::table('books', function (Blueprint $table) {
            $table->text('description')->nullable(); // Menambahkan kolom description
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('description'); // Menghapus kolom description saat rollback
        });
    }

};