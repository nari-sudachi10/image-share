<?php

session_start();


if (!file_exists("uploads")) {
    mkdir("uploads",0777,true);
}

$files=array_diff(scandir("uploads"),[".",".."]);

require "includes/db.php";

$stmt = $db->query("
SELECT *
FROM clips
ORDER BY id
");

$clips = [];

foreach($stmt as $row){
    $clips[$row["id"]] = $row["text"];
}

?>

<?php
$title = "Image Share";
$loadScript = true;
require "includes/header.php";
?>

<?php if (isset($_SESSION["user_id"])): ?>

<p>こんにちは、<?= htmlspecialchars($_SESSION["username"]) ?>さん！</p>

<?php else: ?>

<p>ログインしていません</p>

<?php endif; ?>

<div class="tabs">
<button class="tab-btn active" onclick="showTab('image', this)">
🖼 画像共有
</button>

<button class="tab-btn" onclick="showTab('clipboard', this)">
📋 クリップボード
</button>
</div>

<!-- 画像共有 -->
<div id="image" class="tab-content active">

<div class="upload-box">
<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="image" accept="image/*" required>
<button class="btn upload">アップロード</button>
</form>
</div>

<div class="gallery">

<?php foreach ($files as $file): ?>

<div class="card">

<img src="uploads/<?php echo htmlspecialchars($file); ?>" alt="画像">

<div class="actions">

<a
class="btn download"
href="uploads/<?php echo urlencode($file); ?>"
download>
📥
</a>

<form action="delete.php" method="post">
<input
type="hidden"
name="file"
value="<?php echo htmlspecialchars($file); ?>">

<button
class="btn delete"
onclick="return confirm('削除しますか？');">
🗑
</button>
</form>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

<!-- クリップボード -->
<div id="clipboard" class="tab-content">

<div class="clipboard-grid">

<?php for($i=1;$i<=10;$i++): ?>

<div class="clip-card">

<textarea
id="clip<?= $i ?>"
><?= htmlspecialchars($clips[$i]) ?></textarea>

<div class="clip-buttons">

<button
class="btn download"
onclick="copyClip(<?= $i ?>)">
📋
</button>

<button
class="btn delete"
onclick="clearClip(<?= $i ?>)">
🗑
</button>

<button
onclick="saveClip(<?= $i ?>)">
💾
</button>

</div>

</div>

<?php endfor; ?>

</div>

</div>

<?php
require "includes/footer.php";
?>
