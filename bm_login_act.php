<?php
//最初にSESSIONを開始！！
session_start();

//外部ファイル読み込み
include('functions.php');

//DB接続&送信データの受け取り
$pdo = db_conn();

//入力されたIDとPWをPOSTで受取る
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

//データ登録SQL作成
$sql = 'SELECT * FROM user_table WHERE lid=:lid AND lpw=:lpw AND life_flg=0';
// var_dump($sql);
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$res = $stmt->execute();

//SQL実行時にエラーがある場合
if ($res==false) {
    queryError($stmt);
}

//抽出データ数を取得
$val = $stmt -> fetch();

//該当レコードがあればSESSIONに値を代入
if ($val['id'] != '') {
    // ログイン成功の場合はセッション変数に値を代入
    $_SESSION = array();
    $_SESSION['chk_ssid'] = session_id();
    $_SESSION['lid'] = $val['lid'];
    $_SESSION['kanri_flg'] = $val['kanri_flg'];
    $_SESSION['name'] = $val['name'];
    header('Location: ajax_list.php');
} else {
    //ログイン失敗の場合はログイン画面へ戻る
    header('Location: bm_login.php');
}

exit();
