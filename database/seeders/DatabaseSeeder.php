<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kunjungan;
use App\Models\Upload;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234'),
            'role' => 'admin'
        ]);


        $faker = Faker::create('id_ID');
        $faker->seed(123);
        $this->call(AnakSeeder::class);
        $this->call(TerapisSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(KunjunganSeeder::class);
    }
}
