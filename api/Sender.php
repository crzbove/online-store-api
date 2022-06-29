<?php

namespace Actions;

use PHPMailer\PHPMailer\Exception;

include_once "/var/task/user/api" . "/Database/DatabaseWorker.php";
include_once "/var/task/user/api" . "/Requests/Request.php";

class Handler
{
    protected $answer;
    private $status = false;

    private $IsCookieOK = true;

    public function __construct(Request $r)
    {
        try {
            $this->answer = \DatabaseWorker::DatabaseQueryHandle($r->statement, $r->GetQueryData());
            $this->status = true;
        } catch (Exception $e) {
            $this->answer = $e->getCode();
            $this->status = false;
        }

        if ($r->createCookie && $this->ValidSize()) {
            $r->cookie->SetCookie();
        }

        if ($r->specificJob) {
            $r->DoSpecificJob($this->answer);
        }
    }

    public function ToJson()
    {
        $result = [
            "queryresult" => $this->answer,
            "status" => $this->status,
            "handler" => '🛸; Vercel PHP Runtime \\ ' . $_ENV['VERCEL_GIT_REPO_SLUG'],
            "lastcommit" => $_ENV['VERCEL_GIT_COMMIT_SHA']
        ];

        return json_encode($result);
    }

    public function GetArray()
    {
        return $this->answer;
    }

    public function ValidSize()
    {
        return sizeof($this->answer) > 0;
    }
}
