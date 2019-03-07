<?php

//DB接続(PDO)
function db_conn()
{
    //DB接続
    $dbn = 'mysql:dbname=gs_f02_db24;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = 'root';

    try{
        return new PDO($dbn, $user, $pwd);
    }catch(PDOException $e){
        exit('dbError:'.$e->getMessage());
    }
}

//SQL処理エラー
function errorMsg($stmt)
{
    $error = $stmt->errorInfo();
    exit('ErrorQuery:'.$error[2]);
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// SESSIONチェック＆リジェネレイト
function chk_ssid()
{
    if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()){
    // ログイン失敗時の処理（ログイン画面に移動）
        header('Location: select_nologin.php');
    }else{
    // ログイン成功時の処理（一覧画面に移動）
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
    }

}

//navのmenuを作成
function menu() //ログイン済みのユーザー用
{
    $menu = '<li class="nav-item"><a class="nav-link" href="ajax_index.php">お気に入り登録</a></li><li class="nav-item"><a class="nav-link" href="ajax_list.php">お気に入り一覧</a></li>';
    return $menu;
}

function menuNon() //ログインしていないユーザー用
{
    $menuNon = '<li class="nav-item"><a class="nav-link" href="bm_login.php">ログインページ</a></li>';
    $menuNon .= '<li class="nav-item"><a class="nav-link" href="select_nologin.php">お気に入り一覧</a></li>';
    return $menuNon;
}

function menuLogin() //管理者用ログインメニュー
{
    $menuLogin = '<li class="nav-item"><a class="nav-link" href="user_index.php">ユーザー登録</a></li>';
    $menuLogin .= '<li class="nav-item"><a class="nav-link" href="user_select.php">ユーザー管理</a></li>';
    return $menuLogin;
}
