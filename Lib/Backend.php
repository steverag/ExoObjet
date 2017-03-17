<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

/**
 * Description of Backend
 *
 * @author hp asus
 */
class Backend extends Application {

    public function run() {

//        var_dump($_SESSION);
        // Define le method Module

        if ($this->getUser()->isAdmin()) {

            if ($_SESSION['IPAddress'] != sha1($_SERVER['REMOTE_ADDR']) || $_SESSION['userAgent'] != sha1($_SERVER['HTTP_USER_AGENT'])) {

                exit('Erreur d\'authentiaction');
            }
            //$module = 'article';
            if (isset($_GET['module'])) {
                $module = $_GET['module'];
            } else {
                $module = 'article';
            }

            if (isset($_GET['action'])) {
                $action = $_GET['action'];
            } else {
                $action = 'index';
            }
        } else {
            $module = 'connection';
            // define the method Action
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $action = 'login';
            } else {
                $action = 'index';
            }
        }




        $connection = $this->getControleur($module);
        $connection->action($action);
    }

//

    public
            function __construct() {
        $this->layout = 'layout_admin.html.php';
        parent::__construct();
    }

}
