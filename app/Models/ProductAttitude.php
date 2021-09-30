<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttitude extends Model
{
    use HasFactory;

    protected $table = 'product_attitude';

    protected $fillable = [
        'product_id',
        'attribute',
        'value',
        'sort',
    ];
}
