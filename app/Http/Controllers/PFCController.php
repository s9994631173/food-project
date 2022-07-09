<?php

namespace App\Http\Controllers;

use App\Http\Requests\PFCRequest;
use App\Models\PFCs;

class PFCController extends Controller
{
    public function __invoke(PFCRequest $request){
        $date = date("Y-m-d", strtotime($request->input('date')));
        $user_id = $request->user()->id;
        $proteins = $request->input('proteins');
        $fats = $request->input('fats');
        $carbohydrates = $request->input('carbohydrates');
        $KKAL = $request->input('KKAL');

        $data = [
            'date' => $date,
            'user_id' => $user_id,
            'proteins' => $proteins,
            'fats' => $fats,
            'carbohydrates' => $carbohydrates,
            'KKAL' => $KKAL,
        ];

        PFCs::appendRow($data);
    }
}
