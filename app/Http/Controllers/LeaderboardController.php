<?php

namespace App\Http\Controllers;

use App\Models\UserRanking;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = UserRanking::with('user');
            $validPeriods = ['day', 'month', 'year'];
            $period = $request->input('period', 'year');

            if (in_array($period, $validPeriods)) {
                $currentDate = now();
                switch ($period) {
                    case 'day':
                        $query->whereDate('created_at', $currentDate->format('Y-m-d'));
                        break;
                    case 'month':
                        $query->whereYear('created_at', $currentDate->year)
                            ->whereMonth('created_at', $currentDate->month);
                        break;
                    case 'year':
                        $query->whereYear('created_at', $currentDate->year);
                        break;
                }

                $query->where('period', $period);
            }

            $leaderboard = $query->orderBy('total_points', 'desc')->get();
            $userId = $request->input('search');
            if ($userId) {
                $userRecord = UserRanking::with('user')
                    ->where('user_id', $userId)
                    ->where('period', $period)
                    ->first();

                if ($userRecord) {
                    if ($userRecord) {
                        $leaderboard = $leaderboard->reject(function ($item) use ($userId) {
                            return $item->user_id == $userId;
                        });

                        $leaderboard->prepend($userRecord);
                    }
                }
            }

            return view('leaderboard', compact('leaderboard', 'period'));
        } catch (\Throwable $th) {
            return redirect()->route('leaderboard')->with('error', $th->getMessage());
        }
    }

    public function recalculate()
    {
        try {
            $periods = ['day', 'month', 'year'];

            foreach ($periods as $period) {
                $userRankings = UserRanking::where('period', $period)
                    ->orderBy('total_points', 'desc')
                    ->get();

                $rankedUsers = [];
                foreach ($userRankings as $index => $userRanking) {
                    $rankedUsers[$userRanking->user_id] = [
                        'rank' => $index + 1,
                        'total_points' => $userRanking->total_points,
                    ];
                }

                foreach ($rankedUsers as $userId => $data) {
                    UserRanking::where('user_id', $userId)
                        ->where('period', $period)
                        ->update(['rank' => $data['rank']]);
                }
            }

            return redirect()->route('leaderboard')->with('success', 'Leaderboard updated.');
        } catch (\Throwable $th) {
            return redirect()->route('leaderboard')->with('error', $th->getMessage());
        }
    }
}
