<?php

function log_in(string $uid, string $pwd): void
{

    if (is_empty([$uid, $pwd])) {
        redirect("index.php");
    }

    $qry = 'SELECT id, password FROM user WHERE username = ?;';
    $res = fetch($qry, [$uid]);

    if (empty($res)) {
        redirect("index.php");
    }

    $hsh = $res[0]["password"];

    if (!password_verify($pwd, $hsh)) {
        redirect("index.php");
    }

    $_SESSION['uid'] = $res[0]['id'];
    redirect("public/_console.php");

}