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
        echo 'Backend<br>';
        echo password_hash(123, PASSWORD_DEFAULT);
    }

}
