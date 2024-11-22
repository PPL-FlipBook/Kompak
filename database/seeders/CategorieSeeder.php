<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Fiksi', 'Nonfiksi', 'Agama', 'Anak-anak', 'Remaja & Young Adult',
            'Pendidikan', 'Ilmu Pengetahuan & Teknologi', 'Hobi & Keterampilan',
            'Komik & Novel Grafis', 'Kesehatan & Kebugaran', 'Psikologi & Filosofi',
            'Sastra', 'Pariwisata & Perjalanan', 'Keluarga & Parenting',
            'Keuangan', 'Olahraga', 'Seni & Musik', 'Filsafat', 'Bahasa',
            'Peta & Geografi'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'id' => Str::uuid()->toString(),
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
