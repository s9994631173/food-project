<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFCs extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'user_id', 'proteins', 'fats', 'carbohydrates', 'KKAL'];

    public static function getByDate($date, $user_id){
        return self::select('proteins', 'fats', 'carbohydrates', 'KKAL')
            ->where('date', $date)
            ->where('user_id', $user_id)
            ->first();
    }

    public static function appendRow($data){
        $item = self::where('date', $data['date'])->where('user_id', $data['user_id'])->first();
        if ($item){
            $item->proteins = $data['proteins'];
            $item->fats = $data['fats'];
            $item->carbohydrates = $data['carbohydrates'];
            $item->KKAL = $data['KKAL'];

            $item->save();
        }else{
            $item = [
                'date' => $data['date'],
                'user_id' => $data['user_id'],
                'proteins' => $data['proteins'],
                'fats' => $data['fats'],
                'carbohydrates' => $data['carbohydrates'],
                'KKAL' => $data['KKAL']
            ];
            self::create($item);
        }
    }
}
