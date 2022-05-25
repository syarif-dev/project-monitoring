<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'name' => 'company profile',
            'client' => 'Pt jaya makmu',
            'leader_id' => 1,
            'start_date' => '2022-05-22',
            'end_date' => '2022-10-20'
        ]);
        Project::create([
            'name' => 'sistem informasi perpustkaan',
            'client' => 'sma 2 nagari',
            'leader_id' => 2,
            'start_date' => '2022-05-22',
            'end_date' => '2022-10-20'
        ]);
        Project::create([
            'name' => 'sistem management',
            'client' => 'pt konstruksi jaya',
            'leader_id' => 3,
            'start_date' => '2022-05-22',
            'end_date' => '2022-10-20'
        ]);
        Project::create([
            'name' => 'landing page',
            'client' => 'pt sentosa',
            'leader_id' => 4,
            'start_date' => '2022-05-22',
            'end_date' => '2022-10-20'
        ]);
    }
}
