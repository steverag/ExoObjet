<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modele;

/**
 * Description of Category
 *
 * @author hp asus
 */
class Category extends \Lib\Entity {

    protected $title, $slug;

    /**
     *
     * @var integer
     */
    protected $nbProd;

    public function getTitle() {
        return $this->title;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
        return $this;
    }

    public function getNbProd() {
        return $this->nbProd;
    }

    public function setNbProds(int $nbProd) {
        $this->nbProd = $nbProd;
        return $this;
    }

    public function __construct($data = []) {
        parent::__construct($data = []);
    }

}
