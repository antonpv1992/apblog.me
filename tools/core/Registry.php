<?php

namespace tools\core;

class Registry {

    /**
     * method for correctly identifying a user by sessions and cookies
     */
    public static function auth(): void
    {
        session_start();
        if(!isset($_SESSION['user']) && isset($_COOKIE['user'])){
            if(FormValidation::verify(json_decode($_COOKIE['user'], true))){
                $_SESSION['user'] = json_decode($_COOKIE['user'], true);
            } else {
                setcookie("user", "", time() - 3600);
            }
        }
    }

}