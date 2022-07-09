<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'user_id', 'product', 'pr', 'ft', 'cb', 'KKAL', 'type'];

    public static function getByDate($date, $user_id){
        return self::select('product', 'pr', 'ft', 'cb', 'KKAL', 'type')
            ->where('date', $date)
            ->where('user_id', $user_id)
            ->get();
    }
}
