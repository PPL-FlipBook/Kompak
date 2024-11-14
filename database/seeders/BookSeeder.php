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

        $userId = 2; // ID untuk admin yang valid

        DB::table('books')->insert([
            [
                'id' => Str::uuid()->toString(),
                'title' => 'Book 2',
                'author' => 'Author 2',
                'upload_date' => '2022-02-01 00:00:00',
                'status' => 'Paid',
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid()->toString(),
                'title' => 'Book 3',
                'author' => 'Author 3',
                'upload_date' => '2022-03-01 00:00:00',
                'status' => 'Free',
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan lebih banyak data buku jika diperlukan
        ]);
    }

}
