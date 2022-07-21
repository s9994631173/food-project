<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weights extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'user_id', 'weight'];

    public static function getByDate($date, $user_id){
        return self::where('date', $date)
            ->where('user_id', $user_id)
            ->value('weight');
    }

    public static function appendRow($data){
        $item = self::where('date', $data['date'])
            ->where('user_id', $data['user_id'])
            ->first();
        if ($item){
            $item->weight = $data['weight'];

            $item->save();
        }else{
            $item = [
                'date' => $data['date'],
                'user_id' => $data['user_id'],
                'weight' => $data['weight']
            ];
            self::create($item);
        }
    }
}
