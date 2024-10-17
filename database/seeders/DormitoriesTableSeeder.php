<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DormitoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dormitories')->delete();
        $data = [
            ['name' => 'Faith Hostel'],
            ['name' => 'Peace Hostel'],
            ['name' => 'Grace Hostel'],
            ['name' => 'Success Hostel'],
            ['name' => 'Trust Hostel'],
        ];
        DB::table('dormitories')->insert($data);
    }
}
