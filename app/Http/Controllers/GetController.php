<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weights;
use App\Models\PFCs;
use App\Models\Products;

use App\Http\Services\Week\WeekService;

class GetController extends Controller
{
    public function getByDate(Request $request){
        $date = date("Y-m-d", strtotime($request->input('date')));
        $user_id = $request->user()->id;

        $weightToday = Weights::getByDate($date, $user_id);
        $pfcToday = PFCs::getByDate($date, $user_id);
        $productsToday = Products::getByDate($date, $user_id);

        $week = WeekService::getByWeek($date, $user_id);

        return response([
            'today' => [
                'weight' => $weightToday,
                'PFC' => $pfcToday,
                'products' => $productsToday
            ],
            'week' => $week
        ], 200);
    }
}
