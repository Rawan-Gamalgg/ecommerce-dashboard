<?php
 namespace App\Http\traits;
 trait media{
    public function UploadPhoto($image, $folder){
        $PhotoName = uniqid() . '.' . $image->extension(); //generate a random unique name
        $image->move(public_path('dist/img/'.$folder), $PhotoName); //move the image to the folder
        return $PhotoName;
    }
    public function DeletePhoto($ImagePath){
        //check if the old photo exist
        if (file_exists($ImagePath)) {
            //delete
            unlink($ImagePath);
            return true;
        }
        return false;
    }
 }