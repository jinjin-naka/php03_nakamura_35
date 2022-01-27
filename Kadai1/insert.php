<?php

require_once('funcs.php');

//1. POSTデータ取得
$portfolio = $_POST['portfolio'];
$author = $_POST['author'];
$URL = $_POST['URL'];
$content = $_POST['content'];

$pdo = db_conn();

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, portfolio, author, URL, content, date)
                        VALUES(NULL, :portfolio, :author, :URL, :content, sysdate())");

//  2. バインド変数を用意
$stmt->bindValue(':portfolio', $portfolio, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':author', $author, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':URL', $URL, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':content', $content, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //５．index.phpへリダイレクト
  rediret('index.php');

}
?>
