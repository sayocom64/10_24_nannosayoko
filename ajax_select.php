<!-- <?php

//セッションスタート
session_start();

//外部ファイル読み込み
include('functions.php');

//ログイン状態チェック
chk_ssid();

//menu（一覧）を表示する
$menu = menu();
$menuLogin = menuLogin();
if($_SESSION['kanri_flg']==1){
    $menuSwitch = $menu.$menuLogin.'<li class="nav-item"><a class="nav-link" href="bm_logout.php">ログアウト</a></li>';
}else{
    $menuSwitch = $menu.'<li class="nav-item"><a class="nav-link" href="bm_logout.php">ログアウト</a></li>';
};


//DB接続
$pdo = db_conn();

var_dump($_SESSION['indate']);
var_dump($_SESSION['name']);
var_dump($_SESSION['kanri_flg']);
var_dump($_SESSION['lid']);
$_name = $_SESSION['name'];
$_lid = $_SESSION['lid'];

//データ表示SQL作成
$sql = ' SELECT * FROM gs_bm_table';
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
        $view .= '<p>'.$result['title'].' （登録日：'.$result['indate'].'）</p>';
        $view .= '<p>'.$result['author'].'</p>';
        $view .= '<p><a href="'.$result['url'].'">'.$result['url'].'</a></p>';
        $view .= '<p>'.$result['comment'].'</p>';
        $view .= '<a href="detail.php?id='.$result['id'].'" class="badge badge-success">編集する</a>';
        $view .= '<a href="delete.php?id='.$result['id'].'" class="badge badge-danger">削除する</a>';
        $view .= '</li>';
    }
}

?> -->


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>本のajaxブックマーク</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light bg_yellow">
            <a class="navbar-brand" href="#">本のajaxブックマーク</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="ajax_index.html">お気に入り登録</a></li>
                    <li class="nav-item"><a class="nav-link" href="bm_logout.php">ログアウト</a></li>
                </ul>
            </div>

            <!-- ログイン名を表示 -->
            <!-- <p class="lginStatus"><span><?=$_lid?></span>さんがログイン中</p> -->
        </nav>
    </header>

    <ul id="echo" class="list-group">
        <!-- ここにDBから取得したデータを表示しよう -->
    </ul>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        // DBから取得したデータを表示する関数
        function listData(data) {
            // 書ける人は書いてみよう
            var str = '';
            for (var i = 0; i < data.length; i++) {
                str += '<li class="list-group-item">'
                str += `<p>作品名：${data[i].title}</p>`
                str += `<p><img src="${data[i].bookImgURL}"></p>`
                str += `<p>著者名：${data[i].author}</p>`
                str += `<p><a href="${data[i].url}">商品情報</a></p>`
                str += `<p>コメント：${data[i].comment}</p>`
                str += `<p>登録日：${data[i].indate}</p>`
                str += '<li>'
            }
            return str;
            console.log(str);
        }

        // DBからデータを取得する関数
        function selectData() {
            const url = 'ajax_get.php';
            $.getJSON(url)
                .done(function (data, textStatus, jqXHR) {
                    console.log(data);
                    $('#echo').html(listData(data));
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.log('error');
                })
                .always(function () {
                    console.log('complete');
                });
        }
        selectData();


    </script>

</body>

</html>