<?php
function output_thumbnail($src,$myNew_width,$myNew_height,$thePart){
      $type = pathinfo($src,PATHINFO_EXTENSION);
      if ($type == "png") {
         $image = imagecreatefrompng($src);
      }
      else{
         $image = imagecreatefromjpeg($src);
      }

      $dimensions = getimagesize($src);
      $width = $dimensions[0];
      $height = $dimensions[1];
      if($width<$height){
         $new_width=2*$myNew_height;
         $new_height=2*$myNew_width;
      }
      else{
         $new_width=$myNew_width;
         $new_height=$myNew_height;
      }
      if (!$new_width && !$new_height) {
         return false;
      }
      if (!$new_width || !$new_height){
         $ratio = $width / $height;
         if ($new_width) {
            $new_height= $new_width / $ratio;
         }
         else{
            $new_width = $new_height * $ratio;
         }
      }

      $resizedImage = imagecreatetruecolor($new_width, $new_height);
      imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
      // header("Content-Type: image/jpeg");
      

      if ($type == "png") {
         imagepng($resizedImage,$thePart);
      }
      else{
         imagejpeg($resizedImage,$thePart);
      }

      //chmod($thePart,null);

      // imagedestroy($image);
      // imagedestroy($resizedImage);

   }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 



function store_uploaded_image($html_element_name, $myNew_width,$myNew_height,$target_file) {
    $image = new SimpleImage();
    $image->load($html_element_name);
    $image->resize($myNew_width, $myNew_height);
    $image->save($target_file);
    return $target_file; //return name of saved file in case you want to store it in you database or show confirmation message to user

}

class SimpleImage {

   var $image;
   var $image_type;

   function load($filename) {

      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {

         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {

         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {

         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {

      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {

         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {

         imagepng($this->image,$filename);
      }
      if( $permissions != null) {

         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {

      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {

         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {

         imagepng($this->image);
      }
   }
   function getWidth() {

      return imagesx($this->image);
   }
   function getHeight() {

      return imagesy($this->image);
   }
   function resizeToHeight($height) {

      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }

   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }

   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }

   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      

}
?>