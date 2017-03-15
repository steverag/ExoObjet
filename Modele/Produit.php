<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modele;

/**
 * Description of Produit
 *
 * @author hp asus
 */
class Produit extends \Lib\Entity {

    protected $title, $contents, $slug, $prix;

    /**
     *
     * @var boolean
     */
    protected $online;

    /**
     *
     * @var Image
     */
    protected $image;

    /**
     *
     * @var Category
     */
    protected $category;

    public function getTitle() {
        return $this->title;
    }

    public function getContents() {
        return $this->contents;
    }

    public function getImage() {
        return $this->image;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setContents($contents) {
        $this->contents = $contents;
        return $this;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
        return $this;
    }

    public function setCategory(Category $category) {
        $this->category = $category;
        return $this;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getOnline() {
        return $this->online;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
        return $this;
    }

    public function setOnline($online) {
        $this->online = $online;
        return $this;
    }

}
