<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modele;

/**
 * Description of User
 *
 * @author hp asus
 */
class User extends \Lib\Entity {

    protected $login, $password, $email;

    /**
     *
     * @var integer
     */
    protected $privilege;

}
