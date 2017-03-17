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
