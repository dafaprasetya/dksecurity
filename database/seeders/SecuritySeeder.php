<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SecuritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('securities')->insert([
        //     'nama' => 'dafa',
        //     'nik' => '20220457',
        //     'latitude' => '-6.544218',
        //     'longitude' => '5.774823',
        //     'kodeunik' => 'RMTING',
        //     'waktu'=>Carbon::now()->subDays(3),
        //     'jarak' => '10',
        //     'keterangan' => 'dalam radius 30m',
        //     'created_at' => Carbon::now()->subDays(3), // Tanggal 3 hari yang lalu
        //     'updated_at' => Carbon::now()->subDays(3), // Tanggal 3 hari yang lalu
        // ]);
        DB::table('user_securities')->insert([
            'nama' => 'dafaprstya',
            'nik' => '112332',
            'area' => 'TSP',
            'created_at' => Carbon::now()->subDays(3), // Tanggal 3 hari yang lalu
            'updated_at' => Carbon::now()->subDays(3), // Tanggal 3 hari yang lalu
        ]);
    }
}
