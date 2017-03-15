<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modele;

use Lib\EntityManager;
use PDO;

/**
 * Description of ProduitManager
 *
 * @author hp asus
 */
class ProduitManager extends EntityManager {

    public function getProductsByCategoryId($id) {
        $pdo = $this->pdo;
        $sql = 'SELECT p.id, p.title, p.contents, p.slug, p.image, p.prix, p.online, p.category '
                . 'FROM produit p '
                . 'WHERE p.online = 1 '
                . 'AND p.category = :id;';
        $result = $pdo->prepare($sql);
        $result->bindValue(':id', $id, \PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Produit::class);
        $products = $result->fetchAll();

        $im = new ImageManager();
        foreach ($products as $product) {
            if ($product->getImage()) {
                $id = $product->getImage();
                $img = $im->getImageById($id);
                $product->setImage($img);
            }
        }

        return $products;
    }

    public function getProductById($id) {
        $pdo = $this->pdo;
        $sql = 'SELECT p.id, p.title, p.contents, p.slug, p.image, p.online, p.prix, p.category '
                . 'FROM produit p '
                . 'WHERE p.id = :id';
        $result = $pdo->prepare($sql);
        $result->bindValue(':id', $id, \PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Produit::class);
        $product = $result->fetch();

        $im = new ImageManager();

        $id = $product->getImage();
        $img = $im->getImageById($id);
        $product->setImage($img);


        return $product;
    }

}
