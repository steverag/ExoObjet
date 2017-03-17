<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modele;

use DateTime;
use Lib\Entity;

/**
 * Description of Article
 *
 * @author hp asus
 */
class Article extends Entity {

    protected $titre, $contents, $image, $slug;

    /**
     *
     * @var \DateTime
     */
    protected $date;
    protected $auteur;

    public function getTitre() {
        return $this->titre;
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

    public function getDate() {
        return $this->date;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function setTitre($titre) {
        if (strlen($titre) < 2) {
            $this->error[] = 'titre invalide';
        }
        $this->titre = $titre;
    }

    public function setContents($contents) {
        if (strlen($contents) < 5) {
            $this->error[] = 'Texte trop court';
        }
        $this->contents = $contents;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    public function setDate($date) {
        $this->date = new \DateTime($date);
    }

    public function setAuteur($auteur) {
        $this->auteur = $auteur;
    }

    function __construct($data = []) {
        $this->date = new \DateTime();
        parent::__construct($data);
    }

}
