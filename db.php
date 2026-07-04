<?php

$databaseUrl = getenv("DATABASE_URL");

if (!$databaseUrl) {
    die("DATABASE_URL が設定されていません");
}

$url = parse_url($databaseUrl);

$host = $url["host"];
$port = $url["port"];
$dbname = ltrim($url["path"], "/");
$user = $url["user"];
$password = $url["pass"];

$db = new PDO(
    "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require",
    $user,
    $password
);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);