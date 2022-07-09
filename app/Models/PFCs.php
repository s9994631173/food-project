<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFCs extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'user_id', 'proteins', 'fats', 'carbohydrates', 'KKAL'];
}
