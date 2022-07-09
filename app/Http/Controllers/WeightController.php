<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeightRequest;
use App\Models\Weights;

class WeightController extends Controller
{
    public function __invoke(WeightRequest $request){
        $date = date("Y-m-d", strtotime($request->input('date')));
        $user_id = $request->user()->id;
        $weight = $request->input('weight');

        $data = [
            'date' => $date,
            'user_id' => $user_id,
            'weight' => $weight
        ];

        Weights::appendRow($data);
    }
}
