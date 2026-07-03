<?php
$dir = "uploads/";

if (!file_exists($dir)) {
mkdir($dir, 0777, true);
}

if (isset($_FILES["image"])) {

$ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

// ファイル名をランダム化（重要）
$filename = uniqid("img_", true) . "." . $ext;

$path = $dir . $filename;

if (move_uploaded_file($_FILES["image"]["tmp_name"], $path)) {
header("Location: index.php");
exit;
} else {
echo "アップロード失敗";
}
}
?>