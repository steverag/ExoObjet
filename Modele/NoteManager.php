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
 * Description of NoteManager
 *
 * @author hp asus
 */
class NoteManager extends EntityManager {

    public function getNoteByProductId($prod) {
        $pdo = $this->pdo;
        $sql = 'SELECT n.id, n.valeur, n.user, n.date, n.produit '
                . 'FROM note n '
                . 'WHERE n.produit = :prod '
                . 'ORDER BY n.date DESC';
        $result = $pdo->prepare($sql);
        $result->bindValue(':prod', $prod, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Note::class);
        $notes = $result->fetchall();

        foreach ($notes as $note) {

            $note->setDate($note->getDate());
        }


        return $notes;
    }

    public function insertNote($note) {
        var_dump($note);
        $pdo = $this->pdo;
        $sql = 'INSERT INTO note (id, valeur, user, date, produit) '
                . 'VALUES (null, :valeur, :user, :date, :produit)';
        $result = $pdo->prepare($sql);
        $result->bindValue(':valeur', $note->getValeur(), PDO::PARAM_INT);
        $result->bindValue(':user', $note->getUser(), PDO::PARAM_STR);
        $result->bindValue(':date', $note->getDate()->date, PDO::PARAM_STR);
        $result->bindValue(':produit', $note->getProduit(), PDO::PARAM_INT);
        $result->execute();
    }

}
