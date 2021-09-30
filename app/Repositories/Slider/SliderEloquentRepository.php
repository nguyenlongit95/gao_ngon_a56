<?php

namespace App\Repositories\Slider;

use App\Models\Slider;
use App\Repositories\Eloquent\EloquentRepository;

class SliderEloquentRepository extends EloquentRepository implements SliderRepositoryInterface
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return Slider::class;
    }

    /**
     * Function compare status of slider
     *
     * @param object $slider
     * @return mixed
     */
    public function compareStatus($slider)
    {
        if ($slider->status === 0) {
            return 'InActive';
        }
        if ($slider->status === 1) {
            return 'Active';
        }
    }
}
