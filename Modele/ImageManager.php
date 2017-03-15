<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modele;

/**
 * Description of ImageManager
 *
 * @author hp asus
 */
class ImageManager extends \Lib\EntityManager {

    public function getImageById($id) {
        $pdo = $this->pdo;
        $sql = 'SELECT i.id, i.url, i.alt '
                . 'FROM image i '
                . 'WHERE i.id = :id';
        $result = $pdo->prepare($sql);
        $result->bindValue(':id', $id, \PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(\PDO::FETCH_CLASS, Image::class);
        $image = $result->fetch();
//        var_dump($image);

        return $image;
    }

}
