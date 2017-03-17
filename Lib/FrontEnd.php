<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

/**
 * Description of FrontEnd
 *
 * @author steve
 */
class FrontEnd extends Application {

    public function __construct() {
        $this->layout = 'layout.html.php';
        $this->name = 'FrontEnd';
        parent::__construct();
    }

    public function run() {
//        echo 'run Front';
//      Define le method Module
        if (isset($_GET['module'])) {
            $module = $_GET['module'];
        } else {
            $module = 'blog';
        }

        // define the method Action
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        } else {
            $action = 'index';
        }

        $controleur = $this->getControleur($module);

        $controleur->action($action);

//        $controleur->$method();
    }

}
