<?php

namespace Actions;

include_once "/var/task/user/api" . "/Auth/AuthSecrets.php";

class Telegram
{
    public $userid;

    public function __construct($userid)
    {
        $this->userid = $userid;
    }
}
