<?php

if(!empty($_POST)){

    $dsn = "mysql:dbname=ajax_work;host=localhost;charset=utf8";
    $user = "root";
    $pass = "root";
    $option = array(
        //SQL実行失敗時にはエラーコードのみ設定
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //デフォルトフェッチモードを連想配列形式に設定
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        //バッファードクエリを使う(一度に結果セットを全て取得し、サーバ負荷を軽減)
        //SELECTで得た結果に対してもrowCountメソッドを使えるようにする
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
    );
    //データベース接続
    $dbh = new PDO($dsn, $user, $pass, $option);

    $sql = 'SELECT * FROM users WHERE email = :email';
    $data = array(':email' => $_POST['email']);

    $stmt = $dbh -> prepare($sql);
    $stmt -> execute($data);

    $result = 0;
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);

    if(!empty($result)){
        echo json_encode(array(
            'errorFlg' => true,
            'msg' => '既に登録されています。'
        ));
    }else{
        echo json_encode(array(
            'errorFlg' => false,
            'msg' => '未登録です。'
        ));
    }
    exit();
}