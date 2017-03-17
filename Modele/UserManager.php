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

    public function getUserByLogin($login) {

        $pdo = $this->pdo;
        $sql = 'SELECT u.id, u.login, u.password, u.email, u.privilege '
                . 'FROM user u '
                . 'WHERE u.login = :login ';
        $result = $pdo->prepare($sql);
        $result->bindValue(':login', $login, \PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(\PDO::FETCH_CLASS, User::Class);
        $user = $result->fetch();
        return $user;
    }

}
