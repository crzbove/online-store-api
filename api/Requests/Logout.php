<?php

namespace Actions;

include_once "/var/task/user/api" . "/Requests/Request.php";

class Logout extends Request
{
    public function __construct($cookieVal)
    {
        $this->cookie = new Cookie(NULL, NULL, $cookieVal);
        //        setcookie(CookieName, "", [
        //            'expires' => time() + 3600 * 24 * 7,
        //            'path' => '/',
        //            'domain' => CookieDomain,
        //            'secure' => true,
        //            'httponly' => false,
        //            'samesite' => 'None'
        //        ]);
        $this->cookie->DeleteCookie();
    }

    public $statement = "update \"user\" set \"cookie\"=null where userid=\"GetUserID\"(:cookie)";

    public function GetQueryData(): array
    {
        return array(
            ":cookie" => $this->cookie->hash
        );
    }
}
