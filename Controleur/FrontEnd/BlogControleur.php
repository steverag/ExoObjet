<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controleur\FrontEnd;

use Lib\Controleur;
use Modele\Article;

/**
 * Description of BlogControleur
 *
 * @author steve
 */
class BlogControleur extends Controleur {

    protected function indexAction() {

        $am = new \Modele\ArticleManager();
        $articles = $am->getLatest3Articles();

        $this->render('blog/index.html.php', $articles);
    }

    protected function detailAction() {

        $am = new \Modele\ArticleManager();
        $article = $am->getArticleById($_GET['id']);
        $this->render('blog/detail.html.php', ['article' => $article]);
    }

}
