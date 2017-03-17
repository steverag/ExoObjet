<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

/**
 * Description of Controleur
 *
 * @author hp asus
 */
abstract class Controleur {

    protected $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function action($action) {
        $method = $action . 'Action';
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            throw new \Exception('Action non trouvé');
        }
    }

    protected abstract function indexAction();

    protected function render($vue, array $data = []) {
        extract($data);
        \ob_start();
        include __DIR__ . '/../Vue/' . $vue;
        $contenu = \ob_get_clean();
        include __DIR__ . '/../Vue/' . $this->app->getLayout();
    }

    protected function setFlash($value) {
        $_SESSION['flash'] = $value;
    }

    protected function hasFlash() {
        return (isset($_SESSION['flash']));
    }

    protected function getFlash() {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

}
