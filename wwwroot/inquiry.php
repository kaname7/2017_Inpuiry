<?php
// inquiry.php
//
ob_start();
session_start();

//確認
//var_dump($_SESSION);

//入力内容を取得
//$input = $_SESSION['buffer']['input'];
if (true === isset($_SESSION['buffer']['input'])){
	$input = $_SESSION['buffer']['input'];
} else{
	//$input = []; // PHP5.4以降ならこっちでもよい
	$input = array();
}

//エラー内容を取得
//$error_detail = $_SESSION['buffer']['error_detail'];
if (true === isset($_SESSION['buffer']['error_detail'])){
	$error_detail = $_SESSION['buffer']['error_detail'];
} else{
	//$error_detail = []; // PHP5.4以降ならこっちでもよい
	$error_detail = array();
}

//XSS対策用関数
function h($s){
	return htmlspecialchars($s, ENT_QUOTES);
}
?>
<html>

<body>
<?php
	if (0 < count($error_detail)){
		echo '<div style="color: blue;">エラーがあります</div>';
}
?>

<?php
	// error_must_email
	if (isset($error_detail['error_must_email'])){
		echo '<div style="color: green;">メアドは必須です。</div>';
}



	// error_must_name
	if (isset($error_detail['error_must_name'])){
		echo '<div style="color: red;">名前は必須です。</div>';
}
?>






	<form action="./inquiry_fin.php" method="post">
		emailアドレス(*):<input type="text" name="email"value="<?php echo h((string)@$input['email']); ?>"><br>

		名前:<input type="text" name="name"value="<?php echo h((string)@$input['name']); ?>"><br>

		誕生日:<input type="text" name="birthday"value="<?php echo h((string)@$input['birthday']); ?>"><br>

		問い合わせ内容:<textarea name="body"><?php echo h((string)@$input['body']); ?></textarea><br>


	<button>問い合わせる</button>
	</form>
</body>
</html>