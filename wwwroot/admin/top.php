<?php
// admin/top.php
require_once(__DIR__ . '/../init.php');

//アクセス制御：ログインしてなければ入れない
if( false === isset($_SESSION['admin_auth']) ) {
	// XXX エラーメッセージ
	header('Location: ./index.php');
	exit;
}

// テンプレートを指定して出力
error_reporting(E_ALL & ~E_NOTICE);
$smarty_obj->display('admin/top.tpl');
