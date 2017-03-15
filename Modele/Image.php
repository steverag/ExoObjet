<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modele;

/**
 * Description of Image
 *
 * @author hp asus
 */
class Image extends \Lib\Entity {

    protected $url, $alt;

    public function getUrl() {
        return $this->url;
    }

    public function getAlt() {
        return $this->alt;
    }

    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    public function setAlt($alt) {
        $this->alt = $alt;
        return $this;
    }

}
