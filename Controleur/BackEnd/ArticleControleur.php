<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controleur\BackEnd;

/**
 * Description of ArticleControleur
 *
 * @author hp asus
 */
class ArticleControleur extends \Lib\Controleur {

    public function indexAction() {
        $page = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }

        $limit = 2;
        $offset = ($page - 1) * $limit;

        $am = new \Modele\ArticleManager();
        $articles = $am->getAllArticles($offset, $limit);
        $nbArt = $am->countArticles();
        $nbArt = $nbArt['NbArt'];
        $nbPage = ceil($nbArt / $limit);

        if ($page > 3) {
            switch ($page) {
                case 1:
                case 2:
                case 3:
                    $p = 1;
                    break;
                case ($nbPage - 2):
                case ($nbPage - 1):
                case $nbPage:
                    $p = $nbPage - 4;
                    break;
                default:
                    $p = $page - 2;
            }
        } else
            $p = 1;


        $this->render('article/article.html.php', ['articles' => $articles, 'nbPage' => $nbPage, 'page' => $page, 'p' => $p]);
    }

    public function addAction() {

//        echo 'addaction';

        var_dump($_POST);
        var_dump($_FILES);




        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $article = new \Modele\Article($_POST);

            if ($article->getError() != []) {
                $this->setFlash('Erreur données:<br>- ' . implode('<br>- ', $article->getError()));
            } else {
                $article->setSlug(\Modele\Article::slugify($article->getTitre()));
                $user = $this->app->getUser();
                $article->setAuteur($user);

                // Once the article object is fully hydrated we can upload the image
                if ($_FILES['image']['error'] != 4) {
                    var_dump($_FILES['image']['name']);
                    $upload = $article->upload(__DIR__ . '/../../Web/images', $_FILES['image']['name']);
                    var_dump($upload);
                }


                $am = new \Modele\ArticleManager();

                if ($am->insertArticle($article)) {
                    $this->setFlash('Article enregistré');
                } else {
                    $this->setFlash('Erreur BDD');
                }
            }
//            header('Location:'.\Lib\Application::ROOT.'admin?action=article&action=add');
//            exit;
        }

        $this->render('article/addArticle.html.php');
    }

    public function editAction() {
        if (isset($_GET['id'])) {
            $am = new \Modele\ArticleManager();
            $article = $am->getArticleById($_GET['id']);

            $this->render('article/editArticle.html.php', ['article' => $article]);
        } else {
            header('Location:' . \Lib\Application::ROOT . 'admin');
            exit;
        }
    }

    ////////////////////

    function adminEditoEdit() {

        $erreur = '';
        global $bdd;
        $id = $_GET['edito'];
        if (isset($_POST['Ok'])) {

            if ($erreur == '' && $_FILES['image']['error'] == 0) {

                $file = upload('IMAGES/upload', $_FILES['image']);

                if ($file['upload']) {

                    $imageO = $file['message'];
                    $image = graphicsDraw('IMAGES/upload/' . $imageO, 'IMAGES/thumbnails');

                    $sql = $bdd->prepare('SELECT image, image_originale '
                            . 'FROM  edito '
                            . 'WHERE id=? ');
                    $sql->bindValue(1, $id, PDO::PARAM_INT);
                    $sql->execute();

                    $images = $sql->fetch(PDO::FETCH_OBJ);

                    if ($images->image)
                        unlink('IMAGES/thumbnails/' . $images->image);
                    if ($images->image_originale)
                        unlink('IMAGES/upload/' . $images->image_originale);
                } else {
                    $erreur .= $file['message'];
                }
            }

            if ($erreur == '') {

                $sql = ('UPDATE edito '
                        . 'SET  titre=?, contenu=? '
                        );

                if (isset($image)) {
                    $sql .= ', image="' . $image . '", image_originale="' . $imageO . '"';
                }
                $sql .= ' WHERE id=?';
                var_dump($sql);
                $rslt = $bdd->prepare($sql);
                $rslt->bindValue(3, $id, PDO::PARAM_INT);
                $rslt->bindValue(1, $_POST['titre'], PDO::PARAM_STR);
                $rslt->bindValue(2, $_POST['contenu'], PDO::PARAM_STR);



                if ($rslt->execute()) {
                    $success = true;
                } else {
                    $erreur .= 'Erreur BDD';
                }
            }
        }

        /////////////////////////////////////
        //********* getArticleByID ********
        //*********************************
//    $sql = $bdd->prepare('SELECT * '
//            . 'FROM edito '
//            . 'WHERE id=? ');
//
//    $sql->bindValue(1, $id, PDO::PARAM_INT);
//
//    $sql->execute();
//
//    $lignes = $sql->fetch();
/////////////////////////////////////////

        include 'adminVue/adminEditoEdit.html.php';
    }

}
