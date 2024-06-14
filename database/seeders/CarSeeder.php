<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cars')->insert([
            'body' => Arr::random(['E28', 'E30', 'E36', 'E46', 'E60', 'E92']),
            'model' => Arr::random(['316', '318', '320', '323', '325', '328', '330']),
            'year' => Arr::random(['1988', '1992', '1998', '2003', '2009', '2013']),
            'brand' => Arr::random(['BMW', 'Lada', 'Dacia']),
            'mileage' => rand(10000, 2500000)
        ]);
    }
}