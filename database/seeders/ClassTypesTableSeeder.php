<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ClassTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('class_types')->delete();

        $data = [
            ['name' => 'Creche', 'code' => 'C'],
            ['name' => 'Pre Nursery', 'code' => 'PN'],
            ['name' => 'Nursery', 'code' => 'N'],
            ['name' => 'Primary', 'code' => 'P'],
            ['name' => 'Junior Secondary', 'code' => 'J'],
            ['name' => 'Senior Secondary', 'code' => 'S'],
        ];

        DB::table('class_types')->insert($data);
    }
}
