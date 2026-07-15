<?php

require "../includes/db.php";

$db->exec("
CREATE TABLE IF NOT EXISTS clips (
    id INTEGER PRIMARY KEY,
    text TEXT
);
");

for ($i = 1; $i <= 10; $i++) {

    $stmt = $db->prepare("
        INSERT INTO clips (id, text)
        VALUES (?, ?)
        ON CONFLICT (id) DO NOTHING
    ");

    $stmt->execute([$i, ""]);
}

echo "初期化完了";
