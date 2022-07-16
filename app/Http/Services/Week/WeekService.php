<?php
namespace App\Http\Services\Week;
use App\Models\Weights;
use App\Models\PFCs;

class WeekService{
    public function getByWeek($date, $user_id){
        $week = [];
        for ($i = 1; $i <= 7; $i++){
            $searchDate = date("Y-m-d", strtotime("-{$i} days", strtotime($date)));
            array_push($week, [
                date("d.m.Y", strtotime($searchDate)) => [
                    'weight' => Weights::getByDate($searchDate, $user_id),
                    'PFC' => PFCs::getByDate($searchDate, $user_id)
                ]
            ]);
        }
        return $week;
    }
}