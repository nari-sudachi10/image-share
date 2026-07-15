<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
$username = trim($_POST["username"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

echo "<pre>";
var_dump($username);
var_dump($email);
var_dump($password);
echo "</pre>";

$errors = [];

if ($username === "") {
$errors[] = "ユーザー名を入力してください";
}

if ($email === "") {
$errors[] = "メールアドレスを入力してください";
}
}

require "includes/header.php";
?>

<h2>新規登録</h2>

<form method="post">
<div>
<label for="username">ユーザー名</label>
<input type="text" id="username" name="username">
</div>

<div>
<label for="email">メールアドレス</label>
<input type="email" id="email" name="email">
</div>

<div>
<label for="password">パスワード</label>
<input type="password" id="password" name="password">
</div>

<button type="submit">登録</button>
</form>

<?php
require "includes/footer.php";
?>