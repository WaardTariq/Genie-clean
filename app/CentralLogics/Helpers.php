<?php
namespace App\CentralLogics;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class Helpers
{

    public static function customUpload($dir, $file)
    {
        $extension = $file->getClientOriginalExtension();
        $uniqueId = uniqid();
        $fileName = $uniqueId . '.' . $extension;
        $destinationPath = public_path("storage/{$dir}");

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $file->move($destinationPath, $fileName);

        return $fileName;
    }

    public static function customUpdate($dir, $file, $oldFile = null)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = uniqid() . '.' . $extension;
        $destinationPath = public_path("storage/{$dir}");

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $file->move($destinationPath, $fileName);

        if ($oldFile) {
            $oldFilePath = public_path("storage/{$dir}/{$oldFile}");
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        return $fileName;
    }

    

}
