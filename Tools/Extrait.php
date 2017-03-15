<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tools;

/**
 *
 * @author hp asus
 */
trait Extrait {

    public function extractText($text, $lim = 150) {
        $text = strip_tags($text);
        if (strlen($text) > $lim) {
            $text = substr($text, 0, $lim);
            $pos = strrpos($text, ' ');
            if ($pos != false)
                $text = substr($text, 0, $pos);
            $text .= '...';
        }
        return $text;
    }

}
