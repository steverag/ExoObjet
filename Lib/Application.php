<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

/**
 *
 * @author steve
 */
abstract class Application {

    protected $user;
    protected $layout;

    const ROOT = '/ExoObjet/';
    const REP_IMAGE = '/ExoObjet/Web/images/';

    public function getUser() {
        return $this->user;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function setLayout($layout) {
        $this->layout = $layout;
        return $this;
    }

    public abstract function run();

    public function __construct() {
        if (isset($_SESSION['user'])) {
            $this->user = $_SESSION['user'];
        } else {
            $this->user = new \Modele\User();
        }
        //var_dump($this->user);
    }

    protected function getControleur($module) {
        // Define le method Module

        $nomControleur = '\Controleur\\' . ucfirst($module) . 'Controleur';

        if (class_exists($nomControleur)) {
            $controleur = new $nomControleur($this);

            return $controleur;
        } else {
            throw new \Exception('Module non trouvé');
        }
    }

}
