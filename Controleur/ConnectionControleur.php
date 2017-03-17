<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controleur;

/**
 * Description of ConnectionControleur
 *
 * @author hp asus
 */
class ConnectionControleur extends \Lib\Controleur {

    public function indexAction() {

        $token = sha1(uniqid(rand(), TRUE));
        $tokentime = time();

        $_SESSION['token'] = $token;
        $_SESSION['tokentime'] = $tokentime;

        $this->render('connection.html.php', ['token' => $token, 'tokentime' => $tokentime,]);
    }

    public function loginAction() {
        echo 'loginAction';
// verifier le token
        if ($_SESSION['token'] == $_POST['token'] && $_SESSION['tokentime'] > (time() - 3600)) {

            // get user information from BDD
            $um = new \Modele\UserManager();
            $user = $um->getUserByLogin($_POST['login']);
            $error = 'Vérifier votre login et/ou mdp';
            // check if user OK
            if ($user) {
                // check if password OK
                if (password_verify($_POST['password'], $user->getPassword())) {
                    $_SESSION['IPAddress'] = sha1($_SERVER['REMOTE_ADDR']);
                    $_SESSION['userAgent'] = sha1($_SERVER['HTTP_USER_AGENT']);
                    setcookie(session_name(), session_id(), time() + 3600, '/', null, null, true);


                    $user->setAuth(TRUE);
                    $_SESSION['user'] = $user;
                    if ($user->isUser()) {
                        $this->setFlash('Vous n\'avez pas les droits nécessaires pour accèder au back office');
                    }
                } else {
                    sleep(1);
                    $this->setFlash($error);
                }
            } else {
                sleep(1);
                $this->setFlash($error);
            }
            var_dump($user);
        } else {
            $this->setFlash('Erreur CSRF');
        }
        header('Location:' . \Lib\Application::ROOT . 'admin');
        exit;
    }

    public function logoutAction() {
        session_destroy();
        header('Location:' . \Lib\Application::ROOT . 'admin');
        exit;
    }

}
