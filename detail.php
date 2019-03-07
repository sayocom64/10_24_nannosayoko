<?php

//セッションスタート
session_start();

//関数ファイルを読み込む
include('functions.php');

//ログイン状態をチェック
chk_ssid();

//ログイン名を取得
$_name = $_SESSION['name'];

//menu（一覧）を表示する
$menu = menu();

//getで送信されたidを取得
$id = $_GET['id'];

//DB接続
$pdo = db_conn();

//データ登録のSQL作成、指定したidのみ表示
$sql = 'SELECT * FROM gs_bm_table WHERE id =:id;';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if($status==false){
    //エラーのとき
    errorMsg($stmt);
}else{
    $rs = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登録内容を更新する</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light bg_yellow">
            <a class="navbar-brand" href="#">本のブックマーク</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?=$menu?>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="index.php">投稿画面</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="select.php">コメント一覧</a>
                    </li> -->
                </ul>
            </div>

            <!-- ログイン名を表示 -->
            <p class="lginStatus"><span><?=$_name?></span>さんがログイン中</p>            
        </nav>
    </header>

    <form action="update.php" method="post">
        <div class="form-group">
            <label for="title">書籍名</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$rs['title']?>">
        </div>
        <div class="form-group">
            <label for="author">著者名</label>
            <input type="text" class="form-control" id="author" name="author" value="<?=$rs['author']?>">
        </div>
        <div class="form-group">
            <label for="url">書籍のURL</label>
            <input type="text" class="form-control" id="url" name="url" value="<?=$rs['url']?>">
        </div>
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea class="form-control" id="comment" rows="3" name="comment"><?=$rs['comment']?></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">更新する</button>
        </div>
        <input type="hidden" name="id" value="<?=$rs['id']?>">
    </form>

</body>

</html>