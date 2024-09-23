<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada user dengan id yang valid di tabel users
        $userId = 1; // Ganti dengan id pengguna yang valid jika berbeda

        DB::table('books')->insert([
            [
                'id' => Str::uuid()->toString(),
                'title' => 'Book 1',
                'author' => 'Author 1',
                'upload_date' => '2022-01-01 00:00:00',
                'status' => 'Free',
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data buku lainnya jika diperlukan
        ]);
    }
}
