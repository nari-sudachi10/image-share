<?php

require "db.php";

$id = $_POST["id"];
$text = $_POST["text"];

$stmt = $db->prepare("
UPDATE clips
SET text = ?
WHERE id = ?
");

$stmt->execute([$text, $id]);

echo "保存成功";