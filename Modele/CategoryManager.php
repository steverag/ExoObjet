<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modele;

/**
 * Description of CategoryManager
 *
 * @author hp asus
 */
class CategoryManager extends \Lib\EntityManager {

    public function getCategories() {
        $pdo = $this->pdo;
        $sql = 'SELECT c.id, c.title, c.slug, count(p.id) nbProd '
                . 'FROM produit p '
                . 'INNER JOIN category c '
                . 'ON p.category = c.id '
                . 'GROUP BY c.id '
                . 'ORDER BY c.title;';
        $result = $pdo->query($sql);
        $result->setFetchMode(\PDO::FETCH_CLASS, Category::class);
        $categories = $result->fetchAll();
        return $categories;
    }

}
