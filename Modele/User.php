<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modele;

use Exception;
use Lib\Entity;

/**
 * Description of User
 *
 * @author hp asus
 */
class User extends Entity {

    protected $login, $password, $email;

    /**
     *
     * @var integer
     */
    protected $privilege;

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPrivilege() {
        return $this->privilege;
    }

    public function setLogin($login) {
        $this->login = $login;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPrivilege($privilege) {
        $this->privilege = $privilege;
        return $this;
    }

    public function setAuth($vf) {
        if (is_bool($vf)) {
            $_SESSION['auth'] = $vf;
        } else {
            throw new Exception('User non-vérifié');
        }
    }

    public function isAuthenticated() {
        return isset($_SESSION['auth']) && ($_SESSION['auth'] === TRUE);
    }

    public function isAdmin() {
        return $this->isAuthenticated() && $this->privilege >= 2;
    }

    public function isUser() {
        return $this->isAuthenticated() && $this->privilege < 2;
    }

    public function __sleep() {
        return ['id', 'login', 'email', 'privilege'];
    }

}
