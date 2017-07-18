<?php
// inquiry_fin.php


require_once(__DIR__. '/init.php');

//
require_once(__DIR__. '/dbh.php');

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

//var_dump($input_data);

//validate(情報は正しいかどうか確認する)
$error_detail = array(); //エラー情報格納用変数

//CSRFチェック
//tokenの存在確認(check exist)
$posted_token = $_POST['csrf_token'];
if(false === isset($_SESSION['csrf_token'][$posted_token])){
	//tokenがないんでエラー
$error_detail['error_csrf_token'] = true;
} else {
	//tokenの寿命確認(check life)
	$ttl = $_SESSION['csrf_token'][$posted_token];
	if(time() >= $ttl + 60){
		//token作成から60秒以上経過しているのでNG
		$error_detail['error_csrf_timeover'] = true;
	}
	//いずれにしてもtokenは1回しか使えないので、消す
	unset($_SESSION['csrf_token'][$posted_token]);
}



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
//echo 'データのvalidateはOKでした';



//入力された情報をＤＢにinsert
//DBハンドルを取得
$dbh = get_dbh();
//var_dump($dbh);


//SQL文(準備された文:プリペアドステーメント)を作成
$sql = 'INSERT INTO inquirys(email, inquiry_body, name, birthday) VALUES(:email, :inquiry_body, :name, :birthday);';
$pre = $dbh->prepare($sql);
//var_dump($pre);


//プレースホルダにデータをバインド
$pre->bindValue(':email', $input_data['email']);
$pre->bindValue(':inquiry_body', $input_data['body']);
$pre->bindValue('birthday', $input_data['birthday']);
$pre->bindValue(':name', $input_data['name']);
//SQLを実行
$r = $pre->execute();
//var_dump($r);
if (false === $r){
		// XXX 本当はもうちょっと丁寧にいろいろとやる
		echo 'すみませんデータが取得できませんでした';
		exit;
}
 


//「ありがとう」
error_reporting(E_ALL & ~E_NOTICE);
$smarty_obj->display('inquiry_fin.tpl');
?>
