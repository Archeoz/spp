<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $petugas = [
            [
                'username' => 'admin',
                'password' => bcrypt('123'),
                'nama_petugas' => 'Anton',
                'level' => 'admin',
            ],
            [
                'username' => 'petugas1',
                'password' => bcrypt('123'),
                'nama_petugas' => 'Budi',
                'level' => 'petugas',
            ],
        ];
        foreach ($petugas as $key => $value) {
            Petugas::create($value);
        }
    }
}
