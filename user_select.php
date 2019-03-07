<?php

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

//データベース接続
$pdo = db_conn();

//データ表示SQL作成
$sql = 'SELECT * FROM user_table WHERE life_flg = 0'; //アクティブ会員データのみ取得
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//kanri_flg==１(管理者)のときだけ全て表示する
//データ表示
$view='';
$resultDelete;
// var_dump($resultDelete);
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('sqlError:'.$error[2]);
} else{
    //Selectデータの数だけ自動でループしてくれる
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // var_dump($result);
        $resultDelete = $result;
        global $resultDelete;
        // var_dump($resultDelete);
        $view .= '<li class="list-group-item">';
        $view .= '<p>'.$result['name'].'</p>';
        //  var_dump($result['kanri_flg']);
        $view .= '<p>'.$result['lid'].'</p>';
        $view .= '<p>'.$result['lpw'].'</p>';
        $view .= '<a href="user_detail.php?id='.$result['id'].'" class="badge badge-success">Edit</a>';
        $view .= '<a href="user_delete.php?id='.$result['id'].'" class="badge badge-danger" onClick=disp()>Delete</a>';
        // $view .= '<a href="" class="badge badge-danger" onClick="disp()">Delete</a>';
        $view .= '</li>';
    }
}

var_dump($resultDelete);

?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <div>
        <ul class="list-group">
            <?=$view?>
        </ul>
    </div>
    <input type="text" id="hoge" value="<?=$resultDelete['id']?>">てすてす


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        
        // 効かない。。
        function disp(){
            // 「OK」時の処理開始 ＋ 確認ダイアログの表示
            if(window.confirm('本当に削除しますか？')){
                location.href = "<?php 'user_delete.php?id='.$resultDelete['id'] ?> "; 
            }
            // 「OK」時の処理終了

            // 「キャンセル」時の処理開始
            else{
                console.log("削除をキャンセル");
                window.alert('キャンセルされました'); // 警告ダイアログを表示
                location.href = "user_select.php"; 
            }
            // 「キャンセル」時の処理終了
        }      
    </script>

</body>

</html>