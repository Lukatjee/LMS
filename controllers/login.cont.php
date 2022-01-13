<?php

function log_in(string $uid, string $pwd): void
{

    if (empty($uid)) {
        redirect("index.php");
    }

    if (empty($pwd)) {
        redirect("index.php");
    }

    $qry = 'SELECT user_id, user_pwd FROM users WHERE user_uid = ?;';
    $res = fetch($qry, [$uid]);

    if (empty($res)) {
        redirect("index.php");
    }

    $hsh = $res[0]["user_pwd"];

    if (!password_verify($pwd, $hsh)) {
        redirect("index.php");
    }

    $_SESSION['uid'] = $res[0]['user_id'];
    redirect("Templates/Console/index.php");

}