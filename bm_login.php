<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>
        div{
            padding: 10px;
            font-size:16px;
            }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light bg_green">
            <a class="navbar-brand" href="#">ユーザーログイン</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="bm_login.php">ログインページ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ajax_select.php">お気に入り一覧</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- 「login_act.php」にログイン情報をPOSTで送る -->
    <form method="post" action="bm_login_act.php">
        <div class="form-group">
            <label for="lid">LoginID</label>
            <input type="text" class="form-control" id="lid" name="lid" placeholder="Enter LoginID">
        </div>
        <div class="form-group">
            <label for="lpw">Pass</label>
            <input type="password" class="form-control" id="lpw" name="lpw">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">ログインする</button>
        </div>
    </form>

</body>

</html>