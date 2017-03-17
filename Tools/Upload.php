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
trait Upload {

    function upload($dir, $file) {
        echo $dir;
        echo $file;
        var_dump(is_dir($dir));
        $erreur = '';
// check $dir is exists and is a directory
        if (!is_dir($dir)) {
            return ['upload' => false, 'message' => 'L\'emplacement du fichier n\'existe pas'];
        }
// check the $file array does not have any errors. If error, send back a message
        if ($file['error'] > 0) {
            switch ($file['error']) {
                case UPLOAD_ERR_INI_SIZE :
                    $message = "erreur : " . UPLOAD_ERR_INI_SIZE . "Le fichier téléchargé excède la taille de upload configuré dans php.ini";
                    break;
                case UPLOAD_ERR_FORM_SIZE :
                    $message = "erreur : " . UPLOAD_ERR_FORM_SIZE . "Le fichier téléchargé n'est pas au bon format";
                    break;
                case UPLOAD_ERR_PARTIAL :
                    $message = "erreur : " . UPLOAD_ERR_PARTIAL . "Erreur dans le téléchargement du fichier";
                    break;
//      We have chosen to authorise no image => this case is excluded
//                case UPLOAD_ERR_NO_FILE :
//                    $message = "erreur : " . UPLOAD_ERR_NO_FILE . "Pas de fichier téléchargé";
//                    break;
                default :
                    $message = "Erreur upload";
            }
            return ['upload' => false, 'message' => $message];
        }
        // check file really is an image file
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        $extensionAuth = strtolower($extension);
        $typesMime = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];

        $finfo = new \finfo(FILEINFO_MIME_TYPE);

        $types = $finfo->file($file['tmp_name']);

        if (!in_array($types, $typesMime)) {
            return ['upload' => false, 'message' => 'Choisir une image'];
        }

        $fileName = sha1(uniqid(rand(), true)) . '.' . $extensionAuth;
        $destination = $dir . '/' . $fileName;

        if (move_uploaded_file($file['tmp_name'], $destination)) {

            return ['upload' => true, 'message' => $fileName];
        } else {
            return ['upload' => false, 'message' => 'Erreur copie fichier'];
        }
    }

}
