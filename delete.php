<?php

//関数ファイル読み込み
include('functions.php');

//GETデータ取得
$id = $_GET['id'];

//DB接続
$pdo = db_conn();

//データ登録SQL作成
$sql = 'DELETE FROM gs_bm_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//登録処理後
if ($status==false) {
    errorMsg($stmt);
} else {
    //select.phpへリダイレクト
    header('LOCATION: select.php');
    exit;
}
