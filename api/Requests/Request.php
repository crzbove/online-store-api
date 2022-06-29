<?php

namespace Actions;

include_once "/var/task/user/api" . "/Auth/Password.php";
include_once "/var/task/user/api" . "/Auth/Cookie.php";

class Request
{
    public $createCookie = false;

    public Password $password;
    public Cookie $cookie;
    public Telegram $telegram;

    public bool $specificJob = false;

    public $statement = "select 'Invalid Request' as \"error\"";
    public function GetQueryData(): array
    {
        return array();
    }
    public function DoSpecificJob($params)
    {
    }
}
