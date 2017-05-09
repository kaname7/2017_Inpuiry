<?php
//header_test.php
//ヘッダを出力するのでバッファリング
ob_start();

//少し待つ
sleep(5);

//余計な出力
echo 'test';

//移動させる
header('Location: http://google.com');//location←移動させる

