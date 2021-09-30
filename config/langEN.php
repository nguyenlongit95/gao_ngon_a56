<?php
return [
    'admin' => [
        // CURD message
        'create' => [
            'success' => 'Create item success.',
            'failed' => 'Create item failed, please check again.',
        ],
        'update' => [
            'success' => 'Update item success.',
            'failed' => 'Update item failed, please check again.',
        ],
        'delete' => [
            'success' => 'Delete item success.',
            'failed' => 'Delete item failed, please check again.',
            'dependent' => 'Delete record failed because there was data dependency.',
        ],
        'find' => [
            'failed' => 'Data not found.',
        ],

        // Element message
        'category' => [
            'name_required' => 'Please enter name of category.',
            'sort_required' => 'Please enter sort order of category.',
        ],
        'tags' => [
            'name_required' => 'Please enter name of tags.',
            'sort_required' => 'Please enter sort order of tags.',
            'assign_failed' => 'Failed to assign the tag, recheck the card, but the product was added successfully!',
        ],
        'product' => [
            'name_required' => 'Please enter name of product!',
            'name_min' => 'Please enter name has min 3 characters!',
            'slug_required' => 'Please enter slug of product!',
            'category_id_required' => 'please select an category!',
            'price_required' => 'Please enter price of product!',
            'status_required' => 'Please chose an status of product!',
            'qty_required' => 'Please enter number of product now!',
            'qty_numeric' => 'Data entered is numeric!',
        ],
        'image' => [
            'add_failed' => 'Add this image for product failure, please check the system again.',
            'add_success' => 'Add images for successful products.',
            'delete_success' => 'Delete the photo of the product successfully.',
            'delete_failed' => 'Delete photos of product failed, please check again!',
        ],
        'attribute' => [
            'attribute_required' => 'Please enter name of attribute',
            'value_required' => 'Please enter value attribute',
            'sort_required' => 'Please enter sort order of attribute',
            'sort_numeric' => 'Format an numeric',
            'add_success' => 'Add attribute success.',
            'add_failed' => 'Add attribute failed.',
            'delete_success' => 'Delete attribute success.',
            'delete_failed' => 'Delete attribute failed.',
        ],
        'sliders' => [
            'name_required' => 'Please enter name of slider',
            'name_max' => 'Name has max 255 char',
            'slogan_required' => 'Please enter slogan of slider',
            'slogan_max' => 'Slogan max 255 char',
            'info_required' => 'Please enter info of slogan',
            'image_required' => 'Please chose an image of slider',
            'status_required' => 'Please select status of slider',
            'sort_required' => 'Please enter sort of slider',
            'sort_numeric' => 'Index sort of slider has numeric',
        ],
    ],

    // front_end page
    'product' => [
        'status' => [
            'out_of_stock' => 'Out of stock',
            'in_stock' => 'In stock',
        ]
    ]
];
