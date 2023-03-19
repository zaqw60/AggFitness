<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class UploadService
{
    public function uploadImage(UploadedFile $uploadedFile): string
    {
        $path = $uploadedFile->storeAs('image', $uploadedFile->hashName(), 'public');

        if ($path === false){
            throw new UploadException('Ошибка загрузки файла');
        }

        return $path;
    }
}
