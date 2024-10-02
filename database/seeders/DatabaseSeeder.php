<?php

namespace Database\Seeders;

use App\Http\Controllers\LeaderboardController;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $this->call(UsersSeeder::class);
        $this->call(UserRankingSeeder::class);

        Schema::enableForeignKeyConstraints();

        $leaderBordCnt = new LeaderboardController();
        $leaderBordCnt->recalculate();
    }
}
