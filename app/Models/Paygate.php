<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Paygate extends Model
{
    use SoftDeletes;// add soft delete

    protected $table='paygates';

    protected $fillable = [
        'id',
        'name',
        'code',
        'url',
        'configs',
        'icon'
    ];
}
