<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

/**
 * Description of EntityManager
 *
 * @author hp asus
 */
abstract class EntityManager {

    /**
     *
     * @var \PDO 
     */
    protected $pdo;

    function getPdo() {

        return $this->pdo;
    }

    function setPdo($pdo) {
        $this->pdo = $pdo;
    }

    function __construct() {
        $this->pdo = PDOFactory::get();
    }

}
