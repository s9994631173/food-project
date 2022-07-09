<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'user_id', 'product', 'pr', 'ft', 'cb', 'KKAL', 'type'];
}
