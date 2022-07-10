<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'user_id', 'product', 'weight', 'pr', 'ft', 'cb', 'KKAL', 'type'];

    public static function getByDate($date, $user_id){
        return self::select('id', 'product', 'weight', 'pr', 'ft', 'cb', 'KKAL', 'type')
            ->where('date', $date)
            ->where('user_id', $user_id)
            ->get();
    }

    public static function upd ($data){
        $item = self::find($data['id']);
        if ($item){
            $item->weight = $data['weight'];
            $item->product = $data['product'];
            $item->pr = $data['pr'];
            $item->ft = $data['ft'];
            $item->cb = $data['cb'];
            $item->KKAL = $data['KKAL'];

            $item->save();
            return true;
        }
        return false;
    }

    public static function del ($data){
        $item = self::find($data['id']);
        if ($item){
            $item->delete();
            return true;
        }
        return false;
    }

    public static function new ($data){
        $item = self::create($data);
        return $item;
    }
}
