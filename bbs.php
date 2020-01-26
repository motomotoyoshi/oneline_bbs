<?php
require_once(__DIR__ . '/config.php');
// DBに接続
$link = mysqli_connect('localhost', DB_USERNAME, DB_PASSWORD);
if (!$link) {
    die('DBに接続できません: ' . mysqli_error($link));
}
// DBを選択
mysqli_select_db($link, DB_NAME);
$errors = array();

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = null;
    if (!isset($_POST['name']) || !strlen($_POST['name'])) {
        $errors['name'] = '名前を入力してください';
    } else if (strlen($_POST['name']) > 40) {
        $errors['name'] = '名前は40文字以内で入力してください';
    } else {
        $name = $_POST['name'];
    }
}

// ひとことが正しく入力されているかチェック
$comment = null;
if (!isset($_POST['comment']) || !strlen($_POST['comment'])) {
    $errors['comment'] = 'コメントを入力してください';
} else if (strlen($_POST['comment']) > 200) {
    $errors{
    'comment'} = 'コメントは200文字以内で入力してください';
} else {
    $comment = $_POST['comment'];
}

// エラーがなければ保存
if (count($errors) === 0) {
    $sql = "INSERT INTO post (name, comment, created_at) VALUES ('" . mysqli_real_escape_string($link, $name) . "', '" . mysqli_real_escape_string($link, $comment) . "', '" . date('Y-m-d H:i:s') . "')";

    // printf($sql);
    mysqli_query($link, $sql);
    mysqli_close($link);
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}
$sql = "SELECT * FROM `post` ORDER BY `created_at` DESC";
$result = mysqli_query($link, $sql);

// 取得した結果を$postsに格納
$posts = array();
if ($result !== false && mysqli_num_rows($result)) {
    while ($post = mysqli_fetch_assoc($result)) {
        $posts[] = $post;
    }
}
mysqli_free_result($result);
mysqli_close($link);

include 'view/bbs_view.php';