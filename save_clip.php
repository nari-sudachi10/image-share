<?php

$file = "db.php";

if (!file_exists($file)) {
echo "clips.jsonがありません";
exit;
}

$data = json_decode(file_get_contents($file), true);

$id = $_POST["id"] ?? "";
$text = $_POST["text"] ?? "";

$data[$id] = $text;

<?php

require "db.php";

$id=$_POST["id"];
$text=$_POST["text"];

$stmt=$db->prepare("
UPDATE clips
SET text=?
WHERE id=?
");

$stmt->execute([$text,$id]);

echo "保存成功";