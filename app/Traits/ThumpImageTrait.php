<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;


trait ThumpImageTrait
{
    /**
     *
     * @param string|null $file
     * @param string|null $path
     * @param int|null $width
     * @param int|null $height
     * @param bool|null $backend
     *
     * @return string
     */
    protected function thumpImageResize(?string $file, ?string $path = "files", ?int $width = 400, ?int $height = 400, ?bool $backend = true): string
    {
        try {
            $path = is_null($path) ? 'files' : $path;
            $width = is_null($width) ? 400 : $width;
            $height = is_null($height) ? 400 : $height;
            $backend = is_null($backend) ? true : $backend;

            if (!is_null($file)) {
                $image = explode('.', $file);
                $filename = 'images/thump/' . $image[0] . '-' . $width . 'x' . $height . '.' . $image[1];
            }

            if (!empty($filename) && !file_exists($filename)) {
                $img = Image::make('images/' . $path . '/' . $file);
                $img->fit($width, $height, function ($constraint) {
                    $constraint->upsize();
                });

                $img->save(public_path($filename));

                return asset($filename);
            }

            return $backend ? asset('images/default/empty.svg') : '( unknown )';
        } catch (\Exception $exception) {
            Log::error('FileInfoTrait ( thumpImageResize ) : ' . $exception->getMessage());

            return $backend ? asset('images/default/empty.svg') : '( unknown )';
        }
    }
}
