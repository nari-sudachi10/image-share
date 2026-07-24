<?php
require "includes/db.php";

if (isset($_POST["id"])) {
    $id = (int)$_POST["id"];

    $stmt = $pdo->prepare("DELETE FROM images WHERE id = ?");
    $stmt->execute([$id]);

    $stmt = $pdo->prepare("
    UPDATE clips
    SET content = ''
    WHERE id = ?
");
$stmt->execute([$id]);
}

header("Location: index.php");
exit;