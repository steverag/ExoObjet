<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modele;

use Lib\EntityManager;

/**
 * Description of UserManager
 *
 * @author hp asus
 */
class UserManager extends EntityManager {

    public function getUser($login, $pwd) {

        $pdo = $this->pdo;
        $sql = 'SELECT u.id, u.login, u.password, u.email '
                . 'FROM user u '
                . 'WHERE u.login = :login '
                . 'AND u.password = :pwd ';
        $result = $pdo->prepare($sql);
        $result->bindValue(':login', $login, \PDO::PARAM_STR);
        $result->bindValue(':pwd', $pwd, \PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(\PDO::FETCH_CLASS, User::Class);
    }

}
