<?php

namespace Actions;

include_once "/var/task/user/api" . "/Auth/AuthSecrets.php";

class Cookie
{
    public $hash = "";
    private $salt = CookieSalt;

    public function __construct($email = NULL, $passwordHashed = NULL, $cookieVal = NULL)
    {
        if ($email != NULL && $passwordHashed != NULL && $cookieVal == NULL) {
            $this->hash = self::CalculateCookie($email, $passwordHashed);
        } elseif ($email == NULL && $passwordHashed == NULL && $cookieVal != NULL) {
            $this->hash = $cookieVal;
        }
    }

    public function SetCookie()
    {
        setcookie(CookieName, $this->hash, [
            'expires' => time() + 3600 * 24 * 7,
            'path' => '/',
            'domain' => CookieDomain,
            'secure' => true,
            'httponly' => false,
            'samesite' => 'None'
        ]);
    }

    public function DeleteCookie()
    {
        setcookie(CookieName, "", [
            'expires' => time() + 3600 * 24 * 7,
            'path' => '/',
            'domain' => CookieDomain,
            'secure' => true,
            'httponly' => false,
            'samesite' => 'None'
        ]);
    }

    private function CalculateCookie($email, $passwordHashed)
    {
        return bin2hex(openssl_random_pseudo_bytes(64)); //hash('sha256', "$email $this->salt $passwordHashed");
    }
}
