<?php
// 今はここは空でOK

require "includes/header.php";
?>

<h2>新規登録</h2>

<form method="post">
<div>
<label for="name">ユーザー名</label>
<input type="text" id="name" name="username">
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