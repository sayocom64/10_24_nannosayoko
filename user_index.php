<?php
//ユーザー登録ページ

//セッションスタート
session_start();

//外部ファイル読み込み
include('functions.php');

//ログイン状態チェック
chk_ssid();

//ログイン名を取得
$_name = $_SESSION['name'];

//menu（一覧）を表示する
$menu = menu();
$menuLogin = menuLogin();
if($_SESSION['kanri_flg']==1){
    $menuSwitch = $menu.$menuLogin.'<li class="nav-item"><a class="nav-link" href="bm_logout.php">ログアウト</a></li>';
}else{
    $menuSwitch = $menu.'<li class="nav-item"><a class="nav-link" href="bm_logout.php">ログアウト</a></li>';
};

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
            <a class="navbar-brand" href="#">管理者ページ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?=$menuSwitch?>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="user_index.php">ユーザー登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_select.php">ユーザー管理</a>
                    </li> -->
                </ul>
            </div>

            <!-- ログイン名を表示 -->
            <p class="lginStatus"><span><?=$_name?></span>さんがログイン中</p>            
        </nav>
    </header>

    <form action="user_insert.php" method="post">
        <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="ユーザー名を入力">
        </div>
        <div class="form-group">
            <label for="lid">ログインID</label>
            <input type="text" class="form-control" id="lid" name="lid">
        </div>
        <div class="form-group">
            <label for="lpw">パスワード</label>
            <input type="password" class="form-control" id="lpw" name="lpw">
        </div>
        <div class="form-group">
            <input type="radio" id="kanri_flg0" name="kanri_flg" value="0" checked="checked">
                <label for="kanri_flg0">通常ユーザーとして登録</label>
            <input type="radio" id="kanri_flg1" name="kanri_flg" value="1">
                <label for="kanri_flg1">管理者として登録</label>
        </div>
        <!-- アクティブ状態で登録する -->
        <div class="form-group nonDisp">
            <input type="radio" id="life_flg0" name="life_flg" value="0" checked="checked">
            <input type="radio" id="life_flg1" name="life_flg" value="1">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="register">登録する</button>
        </div>
        <!-- <div class="form-group">
            <button type="submit" class="btn btn-primary">ログインする</button>
        </div> -->
    </form>

</body>

</html>