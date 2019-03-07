<?php

//セッションスタート
session_start();

//外部ファイル読み込み
include('functions.php');

//ログイン状態チェック
chk_ssid();

//ログイン名を取得
$_lid = $_SESSION['lid'];

//menu（一覧）を表示する
$menu = menu();
$menuLogin = menuLogin();
if($_SESSION['kanri_flg']==1){
    $menuSwitch = $menu.$menuLogin.'<li class="nav-item"><a class="nav-link" href="bm_logout.php">ログアウト</a></li>';
}else{
    $menuSwitch = $menu.'<li class="nav-item"><a class="nav-link" href="bm_logout.php">ログアウト</a></li>';
};

// getで送信されたidを取得
$id = $_GET['id'];

$review = $_POST['review'];

//DB接続します
$pdo = db_conn();

//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT * FROM gs_bm_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if ($status==false) {
    // エラーのとき
    errorMsg($stmt);
} else {
    // エラーでないとき
    $rs = $stmt->fetch(); //SQLを実行した「結果データ」を取得する処理 >>「$rs」にレコードが入る
    // fetch()で1レコードを取得して$rsに入れる
    // $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
    // var_dump()で見てみよう
    var_dump($rs['review']);
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー管理</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light bg_yellow">
            <a class="navbar-brand" href="#">登録情報の更新</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?=$menuSwitch?>
                </ul>
            </div>

            <!-- ログイン名を表示 -->
            <p class="lginStatus"><span><?=$_lid?></span>さんがログイン中</p>
        </nav>
    </header>

    <ul id="echo" class="list-group">
        <!-- ここに選択したidのレコードを表示 -->
        <li class="list-group-item">
            <h5>【作品名】</h5>
                <p><a href="<?= $rs['url'] ?>"><?= $rs['title'] ?></a></p>
                <p><img src= <?= $rs['bookImgURL'] ?>></a></p>

            <h5>【著者名】</h5>
                <p><?= $rs['author'] ?></p>

            <h5>【コメント】</h5>
                <p><?= $rs['comment'] ?></p>

            <h5>【投稿者のレビュー】</h5>
                <p><?= $rs['yourCmt'] ?></p>
 
                <p>登録日：<?= $rs['indate'] ?></p>

            <h5>【みんなのコメント】</h5>
                <p><?= $rs['review'] ?></p>
        </li>
    </ul>
    <div>

    </div>

    <form action="ajax_update.php" method="post">
        <div class="form-group">
            <label for="review">レビューを書く</label>
            <textarea class="form-control" id="review" rows="3" name="review"></textarea>
        </div>

        <!-- 選択した作品のidをpostで送信する -->
        <input type="hidden" name="id" value="<?=$id?>">
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">送信</button>
        </div>

    </form>
        

</body>

</html>