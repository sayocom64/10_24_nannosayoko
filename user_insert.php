<?php
//user_index.phpで入力されたユーザー登録情報の処理ページ

//セッションスタート
session_start();

//外部ファイル読み込み
include('functions.php');

//ログイン状態チェック
chk_ssid();

// 入力チェック
if (
    !isset($_POST['name']) || $_POST['name']=='' ||
    !isset($_POST['lid']) || $_POST['lid']=='' ||
    !isset($_POST['lpw']) || $_POST['lpw']=='' ||
    !isset($_POST['kanri_flg']) || $_POST['kanri_flg']=='' ||
    !isset($_POST['life_flg']) || $_POST['life_flg']==''
) {
    exit('ParamError');
}

//POSTデータ取得
$name = $_POST['name'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
$life_flg = $_POST['life_flg'];

//function.phpの関数を呼び出す！！
$pdo = db_conn();

////////////////////////////////////////////
//入力されたlidがすでにDBにある場合、エラー表示しDB登録しない
//データ登録SQL作成
$sql0 = 'SELECT * FROM user_table WHERE lid=:lid';
$stmt0 = $pdo->prepare($sql0);
$stmt0->bindValue(':lid', $lid, PDO::PARAM_STR);
$res0 = $stmt0->execute();

//SQL実行時にエラーがある場合
if ($res0==false) {
    queryError($stmt0);
}

//抽出データ数を取得
$val = $stmt0 -> fetch();

//
if ($val['lid'] == $lid) {
    exit('使用済みのID名です！');
    // header('Location: bm_login.php');
}
////////////////////////////////////////////

//データ登録SQL作成
$sql ='INSERT INTO user_table(id, name, lid, lpw, kanri_flg, life_flg, indate)
VALUES(NULL, :a1, :a2, :a3, :a4, :a5, sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $lid, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $lpw, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $life_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//データ登録処理後
if ($status==false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('sqlError:'.$error[2]);
} else {
    //user_index.phpへリダイレクト
    header('Location: user_index.php');
}
