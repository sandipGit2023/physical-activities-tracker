<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRanking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        UserRanking::query()->truncate();
        foreach ($users as $user) {
            UserRanking::create([
                'user_id' => $user->id,
                'rank' => 1,
                'total_points' => rand(100, 1000),
                'period' => ['day', 'month', 'year'][rand(0,2)],
            ]);
        }
    }
}
