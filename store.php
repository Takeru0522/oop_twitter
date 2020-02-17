<?php

// ファイルの読み込み
require_once('Models/Task.php');
session_start();
// データの受け取り
// $title = $_POST['title'];
$contents = $_POST['contents'];
$currentTime = date("Y/m/d H:i:s");
if(isset($_SESSION['user']))
{
    $tweetedBy = $_SESSION['user']['username'];
} else {
    echo 'Error'; die;
}
// DBへのデータ保存
$task = new Task();
$task->create([$contents, $currentTime, $tweetedBy]);

// リダイレクト
header('location:index.php');
exit;