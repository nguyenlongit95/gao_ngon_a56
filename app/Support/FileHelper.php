<?php

namespace App\Support;

use Illuminate\Support\Facades\Log;

class FileHelper
{
    const SLIDER_PATH = '/image/sliders/';

    /**
     * Function add image of slider and save to storage
     *
     * @param $request
     * @return null|string
     */
    public function addImageSlider($request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->getClientOriginalExtension() === 'jpg' || $file->getClientOriginalExtension() === 'png') {
                $fileName = 'slider_' . rand(0, 999) . '_' . $file->getClientOriginalName();
                try {
                    $request->file('image')->move(public_path(self::SLIDER_PATH), $fileName);
                    return $fileName;
                } catch (\Exception $exception) {
                    Log::error($exception);
                    return 9; // error save file to storage
                }
            }

            return 0; // error file extension
        }

        return null;
    }

    /**
     * Function remove an image of slider
     *
     * @param string $image
     * @return mixed
     */
    public function removeImageSlider($image)
    {
        if (file_exists(public_path(self::SLIDER_PATH . $image))) {
            // destroy the file
            return unlink(public_path(self::SLIDER_PATH . $image));
        }

        return null;
    }
}
