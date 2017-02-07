<?php

/**
 * Description of Language
 *
 * @author  : Songpon Kamsa_at
 * @company : Tak Provincial Health Office
 * @create  : 29 ก.ค. 2555 9:27:20
 * 
 */
class UoloadifyResize {

    public static function Resizes() {
        $width = $this->SetSize(); //*** Fix Width & Heigh (Autu caculate) ***//
        //$new_images = "Thumbnails_".$_FILES["Filedata"]["name"];
        $size = $this->GetimagesizeName();
        $height = round($width * $size[1] / $size[0]);
        $images_orig = imagecreatefromjpeg($this->TempFile());
        $photoX = imagesx($images_orig);
        $photoY = imagesy($images_orig);
        $images_fin = imagecreatetruecolor($width, $height);
        imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
        imagejpeg($images_fin, $this->SetPath(). $this->SetName());
        imagedestroy($images_orig);
        imagedestroy($images_fin);
    }

    public static function SetSize($width = null) {
        if ($width == "") {
            $widths = "1280";
        } else {
            $widths = $width;
        }
        return $widths;
    }

    public static function GetimagesizetmpName($Name = null) {
        //getimagesize($_FILES['Filedata']['tmp_name']);
        return getimagesize($Name);
    }

    public static function SetName($Name = null) {
        return $Name;
    }
    
    public static function TempFile($TempFile = null){
        return $TempFile;
    }
    
    public static function SetPath($Path = null){
        return $Path;
    }
    
}
?>

