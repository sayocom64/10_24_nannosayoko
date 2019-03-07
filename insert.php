<?php

include('functions.php');

// 入力チェック
if(
    !isset($_POST['title']) || $_POST['title']==''||
    !isset($_POST['url']) || $_POST['url']==''
){
    exit('ParamError');
}

//POSTデータ取得
$title = $_POST['title'];
$author = $_POST['author'];
$url = $_POST['url'];
$comment = $_POST['comment'];

// Fileアップロードチェック
if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] ==0) {
    // ファイルをアップロードしたときの処理
    // ①送信ファイルの情報取得
    $file_name = $_FILES['upfile']['name']; //ファイル名 
    $tmp_path = $_FILES['upfile']['tmp_name']; //tmpフォルダ 
    $file_dir_path = 'upload/'; //アップロード先

    // ②File名の準備
    $extension = pathinfo($file_name, PATHINFO_EXTENSION); //拡張子を取得
    $uniq_name = date('YmdHis').md5(session_id()) . "." . $extension; //ユニークなファイル名にする
    $file_name = $file_dir_path.$uniq_name; //画像をフォルダに入れる
    
    // ③サーバの保存領域に移動&④表示
    if (is_uploaded_file($tmp_path)) {
        if (move_uploaded_file($tmp_path, $file_name)) {
             chmod($file_name, 0644); // 所有者に読み込み、書き込みの権限を与え、その他には読み込みだけ許可する。
    } else {
        exit('Error:アップロードできませんでした.');
    }}
} else {
    // ファイルをアップしていないときの処理
    exit('画像が送信されていません');
}

//DB接続
$pdo = db_conn();

//データ登録SQL作成
$sql ='INSERT INTO gs_bm_table(id,title,image,author,url,comment,indate) VALUES(NULL,:a1,:image,:a2,:a3,:a4,sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $title, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':image', $file_name, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $author, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $url, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//データ登録処理後
if ($status==false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('sqlError:'.$error[2]);
} else {
    //５．index.phpへリダイレクト
    header('LOCATION: index.php');
}
