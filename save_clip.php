<?php

$file = "clips.json";

$data = json_decode(file_get_contents($file), true);

$id = $_POST["id"];
$text = $_POST["text"];

$data[$id] = $text;

file_put_contents(
    $file,
    json_encode(
        $data,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    )
);

echo "OK";