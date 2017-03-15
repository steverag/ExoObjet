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

    public abstract function run();

    const ROOT = '/ExoObjet/';
    const REP_IMAGE = '/ExoObjet/Web/images/';

    protected function getControleur($module) {
        // Define le method Module

        $nomControleur = '\Controleur\\' . ucfirst($module) . 'Controleur';

        if (class_exists($nomControleur)) {
            $controleur = new $nomControleur();

            return $controleur;
        } else {
            throw new \Exception('Module non trouvé');
        }
    }

}
