<?php

$file = "clips.json";

if (!file_exists($file)) {
    echo "clips.jsonがありません";
    exit;
}

$data = json_decode(file_get_contents($file), true);

$id = $_POST["id"] ?? "";
$text = $_POST["text"] ?? "";

$data[$id] = $text;

$result = file_put_contents(
    $file,
    json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

if ($result === false) {
    echo "保存失敗";
} else {
    echo "保存成功";
}