<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Staff',
            'email' => '01admin@staff.edu',
            'password' => bcrypt('admin123') // password: admin123
        ]);

        // Operator Sistem
        User::create([
            'name' => 'Operator Sistem',
            'email' => '02operator@operator.edu',
            'password' => bcrypt('operator123') // password: operator123
        ]);

        // Dosen
        User::create([
            'name' => 'Dosen Pengajar',
            'email' => '03dosen@lecture.edu',
            'password' => bcrypt('dosen123') // password: dosen123
        ]);

        // Mahasiswa
        User::create([
            'name' => 'Mahasiswa',
            'email' => '04mahasiswa@student.edu',
            'password' => bcrypt('mahasiswa123') // password: mahasiswa123
        ]);
    }
}
