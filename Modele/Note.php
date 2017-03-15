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
 * Description of Note
 *
 * @author hp asus
 */
class Note extends Entity {

    protected $user;
    protected $valeur, $produit;

    /**
     *
     * @var DateTime 
     */
    protected $date;

    public function __construct($data = []) {
        $this->date = new DateTime;
        parent::__construct($data);
    }

    public function getUser() {
        return $this->user;
    }

    public function getValeur() {
        return $this->valeur;
    }

    public function getProduit() {
        return $this->produit;
    }

    public function getDate() {
        return $this->date;
    }

    public function setUser($user) {
        if (strlen($user) >= 2) {
            $this->user = $user;
            return $this;
        } else {
            $this->error[] = 'nom invalide';
        }
    }

    public function setValeur($valeur) {
        $this->valeur = $valeur;
        return $this;
    }

    public function setProduit($produit) {
        $this->produit = $produit;
        return $this;
    }

    public function setDate($date) {
        $this->date = new DateTime($date);
        return $this;
    }

}
