<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modele;

/**
 * Description of ArticleManager
 *
 * @author hp asus
 */
class ArticleManager extends \Lib\EntityManager {

    public function getLatest3Articles() {
        $bdd = $this->pdo;
        $sql = 'SELECT a.id, a.titre, a.slug, a.contents, a.date, a.image, u.login auteur '
                . 'FROM article a '
                . 'INNER JOIN user u '
                . 'ON a.auteur = u.id '
                . 'ORDER BY a.date '
                . 'DESC LIMIT 3;';
        $result = $this->pdo->query($sql);
        $result->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Article::class);
        $articles = $result->fetchAll();

        foreach ($articles as $article) {

            $article->setDate($article->getDate());
        }

        return $articles;
    }

    public function getArticleById($id) {

        $bdd = $this->pdo;
        $sql = 'SELECT a.id, a.titre, a.slug, a.contents, a.date, a.image, u.login auteur '
                . 'FROM article a '
                . 'INNER JOIN user u '
                . 'ON a.auteur = u.id '
                . 'WHERE a.id = :id;';
        $result = $this->pdo->prepare($sql);
        $result->bindValue(':id', $id, \PDO::PARAM_INT);
        $result->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Article::class);
        $result->execute();
        $article = $result->fetch();

        $article->setDate($article->getDate());
        return $article;
    }

}
