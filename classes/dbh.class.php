<?php

$cred = parse_ini_file(__DIR__ . "/../config.ini");

$dsn = "mysql:host=" . $cred["hostname"] . ";dbname=" . $cred["database"] . ";charset=utf8mb4";
$opt = [

    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,

];

try {

    $pdo = new PDO($dsn, $cred['username'], $cred['password']);

} catch (PDOException $e) {

    throw new PDOException($e->getMessage(), (int)$e->getCode());

}

function fetch($qry, $dta): array
{

    global $pdo;

    $smt = $pdo->prepare($qry);
    $smt->execute($dta);

    return $smt->fetchAll(PDO::FETCH_ASSOC);

}