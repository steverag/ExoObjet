<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

/**
 * Description of Entity
 *
 * @author hp asus
 */
abstract class Entity {

    use \Tools\Extrait;
    use \Tools\Upload;
    use \Tools\Thumbnail;

    protected $id;

    /**
     *
     * @var array
     */
    protected $error = [];

    public function getId() {
        return $this->id;
    }

    function getError() {
        return $this->error;
    }

    public function setId($id) {
        $this->id = $id;
    }

    function setError($error = []) {
        $this->error = $error;
    }

    public function __construct($data = []) {
        $this->hydrate($data);
    }

    protected function hydrate($data = []) {
        foreach ($data as $key => $value) {
            // define $setter as setXxx where Xxx = name of key with 1st letter in upper case
            $setter = 'set' . ucfirst($key);
            // make sur we don't try to add OK
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    static public function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

}
