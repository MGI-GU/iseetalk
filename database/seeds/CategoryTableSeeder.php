<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'name' => 'Hiburan',
                'description' => 'Kategori untuk mendengarkan hiburan',
                'status' => 'active',
            ],
            [
                'name' => 'Motivasi',
                'description' => 'Kategori untuk mendengarkan motivasi',
                'status' => 'active',
            ],
            [
                'name' => 'Musik',
                'description' => 'Kategori untuk mendengarkan lagu',
                'status' => 'active',
            ],
            [
                'name' => 'Cerita',
                'description' => 'Kategori untuk mendengarkan cerita',
                'status' => 'review',
            ],
            [
                'name' => 'Anak',
                'description' => 'Kategori untuk khusus untuk anak umur dibawah 10 tahun',
                'status' => 'disabled',
            ]
        );
        DB::table('category')->insert($data);
    }
}
