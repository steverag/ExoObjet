<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controleur;

/**
 * Description of CatalogueControleur
 *
 * @author steve
 */
class CatalogueControleur extends \Lib\Controleur {

    protected function indexAction() {

        $cm = new \Modele\CategoryManager();
        $categories = $cm->getCategories();


        $this->render('catalogue/index.html.php', $categories);
    }

    protected function categoryAction() {
        $pm = new \Modele\ProduitManager();
        $id = $_GET['id'];

        $produits = $pm->getProductsByCategoryId($id);
//        var_dump($produits);
        $this->render('catalogue/category.html.php', $produits);
    }

    protected function produitAction() {

        $pm = new \Modele\ProduitManager();

        $id = $_GET['id'];
        $product = $pm->getProductById($id);


        $nm = new \Modele\NoteManager();
        $notes = $nm->getNoteByProductId($id);

        if ($this->hasFlash()) {

            $message = $this->getFlash();
//            $product->setError($this->getFlash());
        }

        $this->render('catalogue/produit.html.php', ['product' => $product, 'notes' => $notes, 'message' => $message]);
    }

    public function noteAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $note = new \Modele\Note($_POST);

            $pm = new \Modele\ProduitManager();
            $product = $pm->getProductById($note->getProduit());

            if ($note->getError() == []) {
                $nm = new \Modele\NoteManager();
                $nm->insertNote($note);
            } else {
                $this->setFlash($note->getError());
            }

            header('Location: produit/' . $product->getSlug() . '-' . $note->getProduit());
            exit();
        }
    }

}
