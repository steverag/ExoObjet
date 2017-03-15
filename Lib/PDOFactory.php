<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

use \PDO;

/**
 * Description of PDOFactory
 *
 * @author hp asus
 */
class PDOFactory {

    public static $pdo = null;

    const USER = 'root';
    const PWD = '';
    const HOST = 'localhost';
    const DBNAME = 'obj_catalogue';

    public static function get() {

        if (self::$pdo == null) {
            self::$pdo = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DBNAME, self::USER, self::PWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return self::$pdo;
        } else
            return self::$pdo;
    }

}
