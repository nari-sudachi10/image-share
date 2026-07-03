<?php
$dir = "uploads/";

if (isset($_POST["file"])) {
    $file = basename($_POST["file"]); // パストラバーサル対策
    $path = $dir . $file;

    if (file_exists($path)) {
        unlink($path); // ファイル削除
    }
}

header("Location: index.php");
exit;
?>