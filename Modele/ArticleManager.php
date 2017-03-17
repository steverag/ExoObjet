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

    public function getAllArticles($offset, $limit) {
        $bdd = $this->pdo;
        $sql = 'SELECT a.id, a.titre, a.slug, a.contents, a.date, a.image, u.login auteur '
                . 'FROM article a '
                . 'INNER JOIN user u '
                . 'ON a.auteur = u.id '
                . 'ORDER BY a.id '
                . 'LIMIT :offset, ' . $limit;

        $result = $this->pdo->prepare($sql);
        $result->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $result->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Article::class);
        $result->execute();
        $articles = $result->fetchAll();

        foreach ($articles as $article) {

            $article->setDate($article->getDate());
        }

        return $articles;
    }

    public function countArticles() {
        $bdd = $this->pdo;
        $sql = 'SELECT COUNT(a.id) NbArt '
                . 'FROM article a;';
        $result = $this->pdo->query($sql);
        $nbArt = $result->fetch();

        return $nbArt;
    }

    public function insertArticle(\Modele\Article $article) {
        $pdo = $this->pdo;
        $sql = 'INSERT INTO article (id, titre, slug, contents, date, auteur, image) '
                . 'VALUES (null, :titre, :slug, :contents, :date, :auteur, :image);';
        $result = $pdo->prepare($sql);
        $result->bindValue(':titre', $article->getTitre(), \PDO::PARAM_STR);
        $result->bindValue(':slug', $article->getSlug(), \PDO::PARAM_STR);
        $result->bindValue(':contents', $article->getContents(), \PDO::PARAM_STR);
        $result->bindValue(':date', $article->getDate()->format('Y-m-d h:i:s'), \PDO::PARAM_STR);
        $result->bindValue(':auteur', $article->getAuteur()->getid(), \PDO::PARAM_INT);
        $result->bindValue(':image', $article->getImage(), \PDO::PARAM_STR);
        try {
            $result->execute();
            return TRUE;
        } catch (\PDOException $exc) {
            return FALSE;
        }
    }

}
