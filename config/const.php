<?php
    return [
        'paginate' => 15,
        'role' => [
            'root' => 0,
            'admin' => 1,
            'user' => 2,
        ],
        'orders_status' => [
            0 => 'draft',
            1 => 'Un charge',
            2 => 'Charged',
        ],
        'orders_state' => [
            1 => 'Processing',
            2 => 'Canceled',
        ],
        'users' => [
            'customer' => 2,
            'admin' => 0
        ],
    ];
