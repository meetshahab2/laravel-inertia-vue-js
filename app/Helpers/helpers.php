<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('upload_multiple_images')) {
    /**
     * 📸 Upload multiple images and return array of stored paths
     *
     * @param  array  $images
     * @param  string $directory
     * @param  string $disk
     * @return array
     */
    function upload_multiple_images(array $images, string $directory = 'products', string $disk = 'public'): array
    {
        $paths = [];

        foreach ($images as $image) {
            if ($image->isValid()) {
                $paths[] = $image->store($directory, $disk);
            }
        }

        return $paths;
    }
}
