<?php
//非ログイン会員向け、お気に入り一覧ページ（閲覧のみ、編集不可）

//セッションスタート
session_start();

//外部ファイル読み込み
include('functions.php');

//ログイン状態チェック
// chk_ssid();

//menu（一覧）を表示する
$menuNon = menuNon();

//DB接続
$pdo = db_conn();

//データ表示SQL作成
$sql = ' SELECT * FROM gs_bm_table ORDER BY id DESC';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//データ表示
$view='';
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('sqlError:'.$error[2]);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<li class="list-group-item">';
        $view .= '<p><img src="'.$result['bookImgURL'].'"></p>';
        $view .= '<p><a href="'.$result['url'].'"><span>'.$result['title'].'</span></a></p>';
        $view .= '<p>著者：'.$result['author'].'</p>';
        $view .= '<p>'.$result['comment'].'</p>';
        // ログインしてない状態での「ajax_chose.php」ページは作成間に合わず…
        $view .= '<a href="ajax_chose.php?id='.$result['id'].'" class="badge badge-success">レビューを見る</a>';
        $view .= '</li>';
    }
}
?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>本のブックマーク</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light bg_green">
            <a class="navbar-brand" href="#">本のブックマーク</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?=$menuNon?>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="index.php">投稿画面</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="select.php">コメント一覧</a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </header>

    <div>
        <ul class="list-group">
            <!-- ここにDBから取得したデータを表示しよう -->
            <?=$view?>
        </ul>
    </div>
</body>
</html>