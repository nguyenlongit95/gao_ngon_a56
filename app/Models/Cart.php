<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'code',
        'qa_code',
        'user_id',
        'amount',
        'status',   // 0 draft 1 unCharge 2 charged 3: deleted
        'state',    // 1: Đơn hàng đang xử lý 2: đơn hàng đã huỷ 0: đơn hàng đã giao
        'address',
        'delivery_date',
    ];

    /**
     * Collect 1-n to cart detail table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartDetail()
    {
        return $this->hasMany('App\Models\CartDetail', 'cart_id', 'id');
    }

    /**
     * Collect 1-1 to table users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('\App\Models\User', 'id', 'user_id');
    }
}
