<?php

namespace App\Http\Livewire;

trait FileNameable
{
    /**
     *  Method to rename uploaded files
     */
    private function fileName($file)
    {
        $fileOriginalName = $file->getClientOriginalName();

        $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);

        $fileExtension = pathinfo($fileOriginalName, PATHINFO_EXTENSION);

        return $fileName . '-' . auth()->id() . rand() . '-' . time() . '.' . $fileExtension;
    }
}