<?php



namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;



trait ImageTrait

{
    public function imageUpload($image, $path){

        $namebydate = date("Y-m-d-his");

        $imageName = $namebydate.'_'.rand().'.'.$image->getClientOriginalExtension();

        $image->move(public_path($path),$imageName);

        return $imageName;

    }

    // public function deleteImage($path,$file){
    //     if(!empty($file)){
    //         unlink(public_path($path.$file));
    //     }

    // }

    //delete images from storage
    public function deleteImage($imgDisk, $imgPath, $isArray = false)
    {
        //an array of images
        if ($isArray === true) {
            foreach ($imgPath as $key => $value) {
                if ($value && isset($value) && $value != null) {
                    Storage::disk($imgDisk)->delete($value);
                }
            }

            return true;
        } else {
            //single img
            if ($imgPath && isset($imgPath)) {
                Storage::disk($imgDisk)->delete($imgPath);

                return true;
            }
        }
    }


}