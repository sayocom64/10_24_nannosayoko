<?php

//関数ファイル読み込み
include('functions.php');

//POSTデータ取得
$id = $_POST['id'];
$review = $_POST['review'];
// var_dump($_POST);

//DB接続
$pdo = db_conn();

//データ登録SQL作成
$sql = 'UPDATE gs_bm_table SET review=:a8 WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a8', $review, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ登録処理後
if ($status==false) {
    errorMsg($stmt);
} else {
    header('LOCATION: ajax_list.php');
    // exit('error');
}
