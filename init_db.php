<?php

require "db.php";

$db->exec("
CREATE TABLE IF NOT EXISTS clips(
    id INTEGER PRIMARY KEY,
    text TEXT
)
");

for($i=1;$i<=10;$i++){

    $stmt = $db->prepare("
        INSERT OR IGNORE INTO clips(id,text)
        VALUES(?,?)
    ");

    $stmt->execute([$i,""]);

}

echo "初期化完了";