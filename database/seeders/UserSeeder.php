<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        User::create([
            'name' => 'Admin Staff',
            'email' => '01admin@staff.edu',
            'password' => bcrypt('admin123') 
        ]);

        User::create([
            'name' => 'Operator Sistem',
            'email' => '02operator@operator.edu',
            'password' => bcrypt('operator123') 
        ]);

        
        User::create([
            'name' => 'Dosen Pengajar',
            'email' => '03dosen@lecture.edu',
            'password' => bcrypt('dosen123') 
        ]);

        User::create([
            'name' => 'Mahasiswa',
            'email' => '04mahasiswa@student.edu',
            'password' => bcrypt('mahasiswa123')
        ]);
    }
}
