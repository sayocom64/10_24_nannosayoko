<?php

//セッションスタート
session_start();

//外部ファイル読み込み
include('functions.php');

//ログイン状態チェック
chk_ssid();

//ログイン名を取得
$_lid = $_SESSION['lid'];

//navのmenu関数
$menu = menu();

// google book api
$data = "https://www.googleapis.com/books/v1/volumes?q=intitle:";
$json = file_get_contents($data);
var_dump($json);
$json_decode = json_decode($json, true);

foreach ($json_decode['items'] as $item) {
    // echo $item['volumeInfo']['title'];
    $author = $item['volumeInfo']['authors'][0];
    echo($author);
    $url = $item['selfLink'];
    echo($url);
    $dscrp = $item['volumeInfo']['description'];
    echo($dscrp);
}

// jsonデータ内の『entry』部分を複数取得して、postsに格納
// $posts = $json_decode->items;
// var_dump($posts);
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>本のajaxブックマーク</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery.raty.css">
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
                    <?=$menu?>
                </ul>
            </div>

            <!-- ログイン名を表示 -->
            <p class="lginStatus"><span><?=$_lid?></span>さんがログイン中</p>
        </nav>
    </header>

    <form enctype="multipart/form-data">
        <div class="form-group">
            <label for="serchtitle">書籍名で検索する</label>
            <input type="text" class="form-control" id="serchtitle" name="serchtitle">
        </div>
        <div class="form-group">
            <button type="button" name="serch" value="serch" id="serchBtn" class="btn btn-primary">検索する</button>
        </div>

        <!-- 検索書籍リスト -->
        <div class="form-group">
            <select id="details" name="sample">
                <!-- optionタグ挿入 -->
            </select>

            <div class="form-group" id="bookImg">
                <!-- 画像のサムネイル表示場所 -->
            </div>

            <!-- 画像のURLは非表示に設定 -->
            <div class="form-group nonDisp">
                <label for="bookImgURL">画像のURL</label>
                <input type="text" class="form-control" id="bookImgURL" name="bookImgURL">
            </div>

            <div class="form-group">
                <label for="title">書籍名</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="form-group">
                <label for="author">著者名</label>
                <input type="text" class="form-control" id="author" name="author">
            </div>

            <div class="form-group">
                <label for="url">書籍のURL</label>
                <input type="text" class="form-control" id="url" name="url">
            </div>

            <div class="form-group">
                <label for="comment">作品紹介</label>
                <textarea class="form-control" id="comment" rows="3" name="comment" readonly></textarea>
            </div>

            <div class="form-group">
                <label for="yourCmt">レビューを書く</label>
                <textarea class="form-control" id="yourCmt" rows="3" name="yourCmt"></textarea>
            </div>

            <div class="form-group" id="raty">

            </div>

            <!-- 画像のアップロード -->
            <!-- <input type="file" id="upfile" name="upfile" accept="image/*" capture="camera"> -->

            <div class="form-group">
                <button type="button" id="send" class="btn btn-primary">登録する</button>
            </div>

        </div>

    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.raty.js"></script>

    <script>
        // google book apiの書籍情報をselectタグ内に挿入

        var books;
        var bookImgURL;

        $('#serchBtn').on('click', function () {

            function emp() {
                $('#details').empty();
                $('#bookImg').empty();
                $('#bookImgURL').val("");
                $('#author').val("");
                $('#url').val("");
                $('#comment').val("");
                $('#yourCmt').val("");
            }
            emp();

            var title = $("#serchtitle").val();
            var googleAPI = "https://www.googleapis.com/books/v1/volumes?q=intitle:" + title;

            $.getJSON(googleAPI, function (data) {
                console.log(data);
                books = data
                var str = '<option value="" selected>選択してください</option>';

                if (data.totalItems == 0) {
                    str = '<h3>検索結果がありません</h3>'
                    $('#details').html(str);
                } else if (data.totalItems == 1) {
                    var bookImg1 = data.items[0].volumeInfo.imageLinks.thumbnail;
                    console.log(bookImg1);
                    $("#bookImg").prepend('<img class="remove" src="' + bookImg1 + '"/>');
                    $("#author").val(data.items[0].volumeInfo.authors);
                    $("#url").val(data.items[0].selfLink);
                    $("#comment").val(txt.description);
                } else {
                    for (var i = 0; i < data.items.length; i++) {
                        str += '<option class="remove">【 著者名 】' + data.items[i].volumeInfo.authors;
                        str += '【 作品名 】' + data.items[i].volumeInfo.title;
                        str += '（' + data.items[i].volumeInfo.publishedDate + '年発行）</option>';
                    }
                    $('#details').html(str);
                }
            });
        });

        // セレクトタグから選択したタイトルをinputタグに入れる
        var select = document.querySelector("#details");
        var options = document.querySelectorAll("#details option");
        select.addEventListener('change', function () {
            var index = Number(this.selectedIndex) - 1; ////配列の順番を取得（セレクトタグ内の１行目分を引く）
            // console.log(index);
            console.log(index);

            //サムネールがあれば表示
            var bookImg = books.items[index].volumeInfo.imageLinks.thumbnail; //サムネイルのurl
            console.log(bookImg);
            // bookImgURL = bookImg

            //googleAPIのサムネイル画像アドレス
            $("#bookImgURL").val(bookImg);
            //サムネイルを表示する
            $("#bookImg").empty();
            // $("#bookImg").prepend('<img src="' + bookImg + '"/>');
            $("#bookImg").prepend(`<img src="${bookImg}"/>`);

            //書籍の正式名称を取得
            var selectTitle = books.items[index].volumeInfo.title;
            console.log(selectTitle);
            $('#title').val(selectTitle);
            
            // 著者名を取得
            var selectAuthor = books.items[index].volumeInfo.authors[0];
            console.log(selectAuthor);
            $('#author').val(selectAuthor);

            // urlを取得
            var selectLink = books.items[index].volumeInfo.infoLink;
            console.log(selectLink);
            $('#url').val(selectLink);

            // コメントを取得
            var selectDescrip = books.items[index].volumeInfo.description;
            console.log(selectDescrip);
            $('#comment').val(selectDescrip);
        });

        
        //星の評価スコアを取得する
        var star = 0;
        $.fn.raty.defaults.path = "images";
        $('#raty').raty({
            click: function(score, evt) {
                console.log(score);
                star = score;
                // console.log("score: " + score + "\nevent: " + evt.type);
                $.post('ajax_post.php',{score:score, url_raty:evt.currentTarget.baseURI},
                function(data){
                // console.log(evt);
                // location.href = 'sample.txt';
                });
            }
        });

        ///////////////// ajax /////////////////

        // DBからデータを取得する関数
        function selectData() {
            const url = 'ajax_get.php';
            $.getJSON(url)
                .done(function (data, textStatus, jqXHR) {
                    console.log(data);
                    // $('#echo').html(listData(data));
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.log('error');
                })
                .always(function () {
                    console.log('complete');
                });
        }

        selectData();

        // DBへデータを登録する関数
        function insertData() {
            const post_url = 'ajax_post.php';
            const value = {
                title: $('#title').val(),
                bookImgURL: $('#bookImgURL').val(),
                author: $('#author').val(),
                url: $('#url').val(),
                comment: $('#comment').val(),
                yourCmt: $('#yourCmt').val(),
                score: star
                // image: $('#upfile').val()
            };
            // console.log(value);
            // データ送信
            $.ajax({
                dataType: 'json',
                url: post_url,
                type: 'POST',
                data: value
            })
                .done(function (data) {
                    console.log(data);
                })
                .fail(function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log('error');
                })
                .always(function () {
                    console.log('complete');
                });
        }

        // 読み込み時にDBからデータ取得

        // 送信でDBにデータ送信
        $('#send').on('click', function () {
            insertData();
            $('#title').val('');
            $('#upfile').val('');
            $('#author').val('');
            $('#url').val('');
            $('#comment').val('');
            $('#yourCmt').val('');
            $('#upfile').val('');
            console.log("こっち");
        });

    </script>

</body>

</html>