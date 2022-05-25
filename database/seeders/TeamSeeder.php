<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([
            'name' => 'Indra Setiawan',
            'email' => 'indra@gmail.com',
            'photo' => 'user.png'
        ]);
        Team::create([
            'name' => 'Andri Cahyono',
            'email' => 'andri@gmail.com',
            'photo' => 'bg-login.jpg'
        ]);
        Team::create([
            'name' => 'Budi Gunawan',
            'email' => 'budi@gmail.com',
            'photo' => 'user.png'
        ]);
        Team::create([
            'name' => 'Dodi Mulyanto',
            'email' => 'dodi@gmail.com',
            'photo' => 'bg-login.jpg'
        ]);
    }
}
