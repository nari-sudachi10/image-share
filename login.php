<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require "includes/db.php";

$errors = [];
$user = null;
$login = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

$login = trim($_POST["login"] ?? "");
$password = $_POST["password"] ?? "";

if ($login === "") {
$errors[] = "メールアドレスまたはユーザー名を入力してください";
}

if ($password === "") {
$errors[] = "パスワードを入力してください";
}

if (empty($errors)) {

$stmt = $db->prepare("
SELECT *
FROM users
WHERE email = ?
");

$stmt->execute([$login]);

$user = $stmt->fetch();

if (!$user) {

    $stmt = $db->prepare("
    SELECT *
    FROM users
    WHERE username = ?
    ");

    $stmt->execute([$login]);

    $user = $stmt->fetch();
}

if (!$user) {
    $errors[] = "メールアドレス（またはユーザー名）かパスワードが違います";
} elseif (!password_verify($password, $user["password_hash"])) {
    $errors[] = "メールアドレス（またはユーザー名）かパスワードが違います";
} else {
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $user["username"];

    header("Location: index.php");
    exit;
}

}


}



require "includes/header.php";
?>

<div class="auth-box">

<h2>ログイン</h2>

<?php if (!empty($errors)): ?>

<ul class ="error-list">

<?php foreach ($errors as $error): ?>

<li><?= htmlspecialchars($error) ?></li>

<?php endforeach; ?>

</ul>

<?php endif; ?>

<form method="post">

<div class="form-group">
<label for="login">メールアドレスまたはユーザー名</label>
<input type="text" id="login" name="login" value="<?= htmlspecialchars($login) ?>">
</div>

<div class="form-group">
<label for="password">パスワード</label>
<input type="password" id="password" name="password">
</div>

<button class="btn upload" type="submit">
ログイン
</button>

</form>

<div class="auth-footer">
アカウントをお持ちでないですか？
<a href="register.php">新規登録</a>
</div>

</div>

<?php
require "includes/footer.php";
?>