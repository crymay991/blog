<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 插入数据
        DB::table('categories')->insert([
            ['name' => 'PHP'],
            ['name' => 'HTML'],
            ['name' => 'CSS'],
            ['name' => 'JS'],
            ['name' => 'VUE'],
            ['name' => 'REACT'],
        ]);
    }
}
