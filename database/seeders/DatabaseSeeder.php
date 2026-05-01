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
        $this->call(PekerjaanSeeder::class);
        $this->call(AnakSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(KmmeSeeder::class);
        $this->call(ChatSeeder::class);
        $this->call(GpphSeeder::class);
        $this->call(QuestionWawancaraSeeder::class);
        $this->call(KpspSeeder::class);
    }
}
