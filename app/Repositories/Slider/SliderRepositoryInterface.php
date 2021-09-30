<?php


namespace App\Repositories\Slider;


interface SliderRepositoryInterface
{
    /**
     * @param $slider
     * @return mixed
     */
    public function compareStatus($slider);
}
