<?php
// inquiry_fin.php

ob_start();
session_start();

//入力された情報を取得
//$POSTの中にデータが入っていく。↓こんな風にデータを取るよ
//$email = (string)@$_POST['email'];//@をつける,(string)をつけると後々楽
//$email = (string)filter_input(INPUT_POST, 'email');上に同じ

//$params = array(); //これつかっておけばあんしん
//$params = [];//5.4から使えるが、5.3がセントOSで2020年までサポートされてる

$params = array('email', 'name', 'birthday', 'body');
$input_data = array();
foreach($params as $p){
	$input_data[$p] = (string)@$_POST[$p];
}

var_dump($input_data);

//validate(情報は正しいかどうか確認する)

$error_detail = array(); //エラー情報格納用変数

//必須チェック
$must_params = array('email', 'body');
foreach($must_params as $p){
	if('' === $input_data[$p]){
		//エラー処理
		$error_detail["error_must_{$p}"] = true;
	}
}


//型チェック:email
//RFC非準拠のメアドは知らん
if(false === filter_var($input_data['email'], FILTER_VALIDATE_EMAIL)){
	//エラー処理
$error_detail["error_format_email"] = true;
}


//型チェック:日付
if('' !== $input_data['birthday']){
	if(false === strtotime($input_data['birthday'])){
		//エラー処理
$error_detail["error_format_birthday"] = true;
	}
}



//エラー判定
if (array() != $error_detail){
	//エラー内容をセッションに保持する
	$_SESSION['buffer']['error_detail'] = $error_detail;
	//入力情報をセッションに保持する
	$_SESSION['buffer']['input'] = $input_data;
	//var_dump($error_detail);
	//echo'エラーがあった・・・だと・・・';
	//入力ページに突き返す
	header('Location: ./inquiry.php');
	exit;
}
//ダミー
echo 'データのvalidateはOKでした';



//入力された情報をＤＢにinsert

//「ありがとう」Pageの出力

