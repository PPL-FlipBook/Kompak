<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Category 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data kategori lainnya jika diperlukan
        ]);
    }
}
