<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


require "includes/db.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
$username = trim($_POST["username"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if ($username === "") {
$errors[] = "ユーザー名を入力してください";
}

if (mb_strlen($username) > 30) {
$errors[] = "ユーザー名は30文字以内で入力してください";
}

if ($email === "") {
$errors[] = "メールアドレスを入力してください";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$errors[] = "メールアドレスの形式が正しくありません";
}

if ($password === "") {
$errors[] = "パスワードを入力してください";
} elseif (strlen($password) < 8) {
$errors[] = "パスワードは8文字で入力してください";
}

if (empty($errors)) {
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

var_dump($passwordHash);

$stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);

$user = $stmt->fetch();
var_dump($user);

if ($user) {
$errors[] = "このメールアドレスは既に登録されています";
} else {
$stmt = $db->prepare("
INSERT INTO users (username, email, password_hash)
VALUES (?, ?, ?)
");

$stmt->execute([
$username,
$email,
$passwordHash
]);
}

}

}

require "includes/header.php";
?>

<h2>新規登録</h2>

<?php if (!empty($errors)): ?>

<ul>

<?php foreach ($errors as $error): ?>

<li><?= htmlspecialchars($error) ?></li>

<?php endforeach; ?>

</ul>

<?php endif; ?>

<form method="post">
<div>
<label for="username">ユーザー名</label>
<input type="text" id="username" name="username" value="<?= htmlspecialchars($username ?? "") ?>">
</div>

<div>
<label for="email">メールアドレス</label>
<input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? "") ?>">
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