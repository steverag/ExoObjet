<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tools;

/**
 *
 * @author hp asus
 */
trait Thumbnail {

    function thumbnail($source, $destination, $width = 150, $height = 150) {

        $extension = strtolower(pathinfo($source, PATHINFO_EXTENSION));
        $image = pathinfo($source, PATHINFO_FILENAME);


        switch ($extension) {

            case 'jpg' :

            case 'jpeg' : $src_image = imagecreatefromjpeg($source);
                break;

            case 'png' : $src_image = imagecreatefrompng($source);

                break;

            case 'gif' : $src_image = imagecreatefromgif($source);

                break;
        }

        $dst_image = imagecreatetruecolor($width, $height);

        $r = 168;
        $v = 168;
        $b = 168;

        $couleur_fond = imagecolorallocate($dst_image, $r, $v, $b);
        imagecolortransparent($dst_image, $couleur_fond);
        imagefill($dst_image, 0, 0, $couleur_fond);

        list($src_w, $src_h) = getimagesize($source);



        $ratio_orig = $src_w / $src_h;

        $dst_w = $width;
        $dst_h = $height;



        if ($dst_w / $dst_h > $ratio_orig) {
            $dst_w = $dst_h * $ratio_orig;
        } else {
            $dst_h = $dst_w / $ratio_orig;
        }


        $dst_x = ($width - $dst_w) / 2;
        $dst_y = ($height - $dst_h) / 2;

        imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);


        if (imagepng($dst_image, $destination . '/' . $image . '.png')) {

            return $image . '.png';
        } else {

            return null;
        }
    }

}
