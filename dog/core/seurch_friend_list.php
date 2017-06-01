<?php
//DB連携
include("db_ini.php");

if(!$Link = mysqli_connect($host,$user,$pass)){
  exit("MySQL：DB接続失敗："
  .mysqli_connect_error());
}
//  文字コードの指定（クエリー送信）
if(!mysqli_query($Link,"set names 'utf8'")){
  exit("MySQL：クエリー送信失敗");
}

//  使用するDB指定
if(!mysqli_select_db($Link,$db_name)){
  exit("MySQL：DB指定失敗");
}

///////////////////////////////////////////
if(isset($_POST["friend_seurch"])){
	//県のみセットしてある
	if($_POST["ken"] != 0 && $_POST["dog_size"] == 0 && $_POST["dog_janru"] == 0){

	$userSQL = "
	select users.user_id,
		   users.user_first_name,
		   users.user_second_name,
		   pets.pet_name,
		   pets.dog_size_id,
		   pets.dog_book_id,
		   pets.prefecture_id,
		   pets.pet_image01
    from users
    inner join pets
    on users.pet_id = pets.pet_id
    WHERE users.pet_id != 0 AND pets.prefecture_id =? 
    ";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$userSQL)) {
	/* マーカにパラメータをバインドします */
	$kenid = $_POST["ken"];
	mysqli_stmt_bind_param($stmt, "s", $kenid);

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
						$user_id,
						$userfirstname,
						$usersecondname,
						$petname,
						$dogsize,
						$dogjanru,
						$dogken,
						$dogimage
						);
	/* クライアントのバッファに
	結果セットを保存 */
	mysqli_stmt_store_result($stmt);
	/* 値を取得します */
	while(mysqli_stmt_fetch($stmt)){
		$USER_ID[] = $user_id;
		$USERFIRSTNAME[] = $userfirstname;
		$USERSECONDNAME[] = $usersecondname;
		$PETNAME[] = $petname;
		$DOGSIZE[] = $dogsize;
		$DOGJANRU[] = $dogjanru;
		$DOGKEN[] = $dogken;
		$DOGIMAGE[] = $dogimage;
	//$dbbuid,$dbbunameにデータが抜き出される
	}
	/* ステートメントを閉じます */
	 mysqli_stmt_close($stmt);
	}
	if(isset($USERFIRSTNAME)){
	for($i=0;$i<count($USERFIRSTNAME);$i++){

	$kenSQL = "
		SELECT prefecture_name
		FROM prefectures
		WHERE prefecture_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$kenSQL)) {
		/* マーカにパラメータをバインドします */
		$kenid = $DOGKEN[$i];
		 mysqli_stmt_bind_param($stmt, "s", $kenid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$kenname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$KENNAME[] = $kenname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$KENNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	$janruSQL = "
		SELECT dog_name
		FROM dog_books
		WHERE dog_book_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$janruSQL)) {
		/* マーカにパラメータをバインドします */
		$janruid = $DOGJANRU[$i];
		 mysqli_stmt_bind_param($stmt, "s", $janruid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$janruname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$JANRUNAME[] = $janruname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$JANRUNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	}
	}

	//ジャンルがセットされている(サイズが設定してあってもジャンルのみの選択)
	}else if($_POST["ken"] == 0 && $_POST["dog_janru"] != 0){

	$userSQL = "
	select users.user_id,
		   users.user_first_name,
		   users.user_second_name,
		   pets.pet_name,
		   pets.dog_size_id,
		   pets.dog_book_id,
		   pets.prefecture_id,
		   pets.pet_image01
    from users
    inner join pets
    on users.pet_id = pets.pet_id
    WHERE users.pet_id != 0 AND pets.dog_book_id =?
    ";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$userSQL)) {
	/* マーカにパラメータをバインドします */
	$janruid = $_POST["dog_janru"];
	mysqli_stmt_bind_param($stmt, "s", $janruid);

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
						$user_id,
						$userfirstname,
						$usersecondname,
						$petname,
						$dogsize,
						$dogjanru,
						$dogken,
						$dogimage
						);
	/* クライアントのバッファに
	結果セットを保存 */
	mysqli_stmt_store_result($stmt);
	/* 値を取得します */
	while(mysqli_stmt_fetch($stmt)){
		$USER_ID[] = $user_id;
		$USERFIRSTNAME[] = $userfirstname;
		$USERSECONDNAME[] = $usersecondname;
		$PETNAME[] = $petname;
		$DOGSIZE[] = $dogsize;
		$DOGJANRU[] = $dogjanru;
		$DOGKEN[] = $dogken;
		$DOGIMAGE[] = $dogimage;
	//$dbbuid,$dbbunameにデータが抜き出される
	}
	/* ステートメントを閉じます */
	 mysqli_stmt_close($stmt);
	}
if(isset($USERFIRSTNAME)){
	for($i=0;$i<count($USERFIRSTNAME);$i++){

	$kenSQL = "
		SELECT prefecture_name
		FROM prefectures
		WHERE prefecture_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$kenSQL)) {
		/* マーカにパラメータをバインドします */
		$kenid = $DOGKEN[$i];
		 mysqli_stmt_bind_param($stmt, "s", $kenid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$kenname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$KENNAME[] = $kenname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$KENNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	$janruSQL = "
		SELECT dog_name
		FROM dog_books
		WHERE dog_book_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$janruSQL)) {
		/* マーカにパラメータをバインドします */
		$janruid = $DOGJANRU[$i];
		 mysqli_stmt_bind_param($stmt, "s", $janruid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$janruname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$JANRUNAME[] = $janruname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$JANRUNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	}
	}

	//サイズのみがセットされている
	}else if($_POST["ken"] == 0 && $_POST["dog_size"] != 0 && $_POST["dog_janru"] == 0){

	$userSQL = "
	select users.user_id,
		   users.user_first_name,
		   users.user_second_name,
		   pets.pet_name,
		   pets.dog_size_id,
		   pets.dog_book_id,
		   pets.prefecture_id,
		   pets.pet_image01
    from users
    inner join pets
    on users.pet_id = pets.pet_id
    WHERE users.pet_id != 0 AND pets.dog_size_id =?
    ";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$userSQL)) {
	/* マーカにパラメータをバインドします */
	$sizeid = $_POST["dog_size"];
	mysqli_stmt_bind_param($stmt, "s", $sizeid);

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
						$user_id,
						$userfirstname,
						$usersecondname,
						$petname,
						$dogsize,
						$dogjanru,
						$dogken,
						$dogimage
						);
	/* クライアントのバッファに
	結果セットを保存 */
	mysqli_stmt_store_result($stmt);
	/* 値を取得します */
	while(mysqli_stmt_fetch($stmt)){
		$USER_ID[] = $user_id;
		$USERFIRSTNAME[] = $userfirstname;
		$USERSECONDNAME[] = $usersecondname;
		$PETNAME[] = $petname;
		$DOGSIZE[] = $dogsize;
		$DOGJANRU[] = $dogjanru;
		$DOGKEN[] = $dogken;
		$DOGIMAGE[] = $dogimage;
	//$dbbuid,$dbbunameにデータが抜き出される
	}
	/* ステートメントを閉じます */
	 mysqli_stmt_close($stmt);
	}
for($i=0;$i<count($USERFIRSTNAME);$i++){

	$kenSQL = "
		SELECT prefecture_name
		FROM prefectures
		WHERE prefecture_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$kenSQL)) {
		/* マーカにパラメータをバインドします */
		$kenid = $DOGKEN[$i];
		 mysqli_stmt_bind_param($stmt, "s", $kenid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$kenname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$KENNAME[] = $kenname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$KENNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	$janruSQL = "
		SELECT dog_name
		FROM dog_books
		WHERE dog_book_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$janruSQL)) {
		/* マーカにパラメータをバインドします */
		$janruid = $DOGJANRU[$i];
		 mysqli_stmt_bind_param($stmt, "s", $janruid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$janruname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$JANRUNAME[] = $janruname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$JANRUNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	}
	//県と犬ジャンルが入力されていたら(サイズが入力されていても無視)
	}else if($_POST["ken"] != 0 && $_POST["dog_janru"] != 0){

	$userSQL = "
	select users.user_id,
		   users.user_first_name,
		   users.user_second_name,
		   pets.pet_name,
		   pets.dog_size_id,
		   pets.dog_book_id,
		   pets.prefecture_id,
		   pets.pet_image01
    from users
    inner join pets
    on users.pet_id = pets.pet_id
    WHERE users.pet_id != 0 AND pets.prefecture_id = ? AND pets.dog_book_id =?
    ";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$userSQL)) {
	/* マーカにパラメータをバインドします */
	$kenid = $_POST["ken"];
	$janruid = $_POST["dog_janru"];
	mysqli_stmt_bind_param($stmt, "ss",$kenid,$janruid);

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
						$user_id,
						$userfirstname,
						$usersecondname,
						$petname,
						$dogsize,
						$dogjanru,
						$dogken,
						$dogimage
						);
	/* クライアントのバッファに
	結果セットを保存 */
	mysqli_stmt_store_result($stmt);
	/* 値を取得します */
	while(mysqli_stmt_fetch($stmt)){
		$USER_ID[] = $user_id;
		$USERFIRSTNAME[] = $userfirstname;
		$USERSECONDNAME[] = $usersecondname;
		$PETNAME[] = $petname;
		$DOGSIZE[] = $dogsize;
		$DOGJANRU[] = $dogjanru;
		$DOGKEN[] = $dogken;
		$DOGIMAGE[] = $dogimage;
	//$dbbuid,$dbbunameにデータが抜き出される
	}
	/* ステートメントを閉じます */
	 mysqli_stmt_close($stmt);
	}
if(isset($USERFIRSTNAME)){
	for($i=0;$i<count($USERFIRSTNAME);$i++){

	$kenSQL = "
		SELECT prefecture_name
		FROM prefectures
		WHERE prefecture_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$kenSQL)) {
		/* マーカにパラメータをバインドします */
		$kenid = $DOGKEN[$i];
		 mysqli_stmt_bind_param($stmt, "s", $kenid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$kenname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$KENNAME[] = $kenname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$KENNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	$janruSQL = "
		SELECT dog_name
		FROM dog_books
		WHERE dog_book_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$janruSQL)) {
		/* マーカにパラメータをバインドします */
		$janruid = $DOGJANRU[$i];
		 mysqli_stmt_bind_param($stmt, "s", $janruid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$janruname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$JANRUNAME[] = $janruname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$JANRUNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	}
	}
	//県とサイズがセットされている
	}else if($_POST["ken"] != 0 && $_POST["dog_size"] != 0 && $_POST["dog_janru"] == 0){
	$userSQL = "
	select users.user_id,
		   users.user_first_name,
		   users.user_second_name,
		   pets.pet_name,
		   pets.dog_size_id,
		   pets.dog_book_id,
		   pets.prefecture_id,
		   pets.pet_image01
    from users
    inner join pets
    on users.pet_id = pets.pet_id
    WHERE users.pet_id != 0 AND pets.prefecture_id = ? AND pets.dog_size_id =?
    ";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$userSQL)) {
	/* マーカにパラメータをバインドします */
	$kenid = $_POST["ken"];
	$sizeid = $_POST["dog_size"];
	mysqli_stmt_bind_param($stmt, "ss",$kenid,$sizeid);

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
						$user_id,
						$userfirstname,
						$usersecondname,
						$petname,
						$dogsize,
						$dogjanru,
						$dogken,
						$dogimage
						);
	/* クライアントのバッファに
	結果セットを保存 */
	mysqli_stmt_store_result($stmt);
	/* 値を取得します */
	while(mysqli_stmt_fetch($stmt)){
		$USER_ID[] = $user_id;
		$USERFIRSTNAME[] = $userfirstname;
		$USERSECONDNAME[] = $usersecondname;
		$PETNAME[] = $petname;
		$DOGSIZE[] = $dogsize;
		$DOGJANRU[] = $dogjanru;
		$DOGKEN[] = $dogken;
		$DOGIMAGE[] = $dogimage;
	//$dbbuid,$dbbunameにデータが抜き出される
	}
	/* ステートメントを閉じます */
	 mysqli_stmt_close($stmt);
	}
if(isset($USERFIRSTNAME)){
	for($i=0;$i<count($USERFIRSTNAME);$i++){

	$kenSQL = "
		SELECT prefecture_name
		FROM prefectures
		WHERE prefecture_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$kenSQL)) {
		/* マーカにパラメータをバインドします */
		$kenid = $DOGKEN[$i];
		 mysqli_stmt_bind_param($stmt, "s", $kenid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$kenname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$KENNAME[] = $kenname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$KENNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	$janruSQL = "
		SELECT dog_name
		FROM dog_books
		WHERE dog_book_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$janruSQL)) {
		/* マーカにパラメータをバインドします */
		$janruid = $DOGJANRU[$i];
		 mysqli_stmt_bind_param($stmt, "s", $janruid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$janruname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$JANRUNAME[] = $janruname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$JANRUNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	}
	}
	//ボタンは押したけど何もセットされていない
	}else{
		$userSQL = "
	select users.user_id,
		   users.user_first_name,
		   users.user_second_name,
		   pets.pet_name,
		   pets.dog_size_id,
		   pets.dog_book_id,
		   pets.prefecture_id,
		   pets.pet_image01
    from users
    inner join pets
    on users.pet_id = pets.pet_id
    WHERE users.pet_id != 0
    ";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$userSQL)) {

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
						$user_id,
						$userfirstname,
						$usersecondname,
						$petname,
						$dogsize,
						$dogjanru,
						$dogken,
						$dogimage
						);
	/* クライアントのバッファに
	結果セットを保存 */
	mysqli_stmt_store_result($stmt);
	/* 値を取得します */
	while(mysqli_stmt_fetch($stmt)){
		$USER_ID[] = $user_id;
		$USERFIRSTNAME[] = $userfirstname;
		$USERSECONDNAME[] = $usersecondname;
		$PETNAME[] = $petname;
		$DOGSIZE[] = $dogsize;
		$DOGJANRU[] = $dogjanru;
		$DOGKEN[] = $dogken;
		$DOGIMAGE[] = $dogimage;
	//$dbbuid,$dbbunameにデータが抜き出される
	}
	/* ステートメントを閉じます */
	 mysqli_stmt_close($stmt);
	}
if(isset($USERFIRSTNAME)){
	for($i=0;$i<count($USERFIRSTNAME);$i++){

	$kenSQL = "
		SELECT prefecture_name
		FROM prefectures
		WHERE prefecture_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$kenSQL)) {
		/* マーカにパラメータをバインドします */
		$kenid = $DOGKEN[$i];
		 mysqli_stmt_bind_param($stmt, "s", $kenid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$kenname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$KENNAME[] = $kenname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$KENNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	$janruSQL = "
		SELECT dog_name
		FROM dog_books
		WHERE dog_book_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$janruSQL)) {
		/* マーカにパラメータをバインドします */
		$janruid = $DOGJANRU[$i];
		 mysqli_stmt_bind_param($stmt, "s", $janruid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$janruname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$JANRUNAME[] = $janruname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$JANRUNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	}
	}
	}
//ボタンが押されていない(リンクから飛んだ場合)
}else{
	$userSQL = "
	select users.user_id,
		   users.user_first_name,
		   users.user_second_name,
		   pets.pet_name,
		   pets.dog_size_id,
		   pets.dog_book_id,
		   pets.prefecture_id,
		   pets.pet_image01
    from users
    inner join pets
    on users.pet_id = pets.pet_id
    WHERE users.pet_id != 0
    ";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$userSQL)) {

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
						$user_id,
						$userfirstname,
						$usersecondname,
						$petname,
						$dogsize,
						$dogjanru,
						$dogken,
						$dogimage
						);
	/* クライアントのバッファに
	結果セットを保存 */
	mysqli_stmt_store_result($stmt);
	/* 値を取得します */
	while(mysqli_stmt_fetch($stmt)){
		$USER_ID[] = $user_id;
		$USERFIRSTNAME[] = $userfirstname;
		$USERSECONDNAME[] = $usersecondname;
		$PETNAME[] = $petname;
		$DOGSIZE[] = $dogsize;
		$DOGJANRU[] = $dogjanru;
		$DOGKEN[] = $dogken;
		$DOGIMAGE[] = $dogimage;
	//$dbbuid,$dbbunameにデータが抜き出される
	}
	/* ステートメントを閉じます */
	 mysqli_stmt_close($stmt);
	}
for($i=0;$i<count($USERFIRSTNAME);$i++){

	$kenSQL = "
		SELECT prefecture_name
		FROM prefectures
		WHERE prefecture_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$kenSQL)) {
		/* マーカにパラメータをバインドします */
		$kenid = $DOGKEN[$i];
		 mysqli_stmt_bind_param($stmt, "s", $kenid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$kenname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$KENNAME[] = $kenname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$KENNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	$janruSQL = "
		SELECT dog_name
		FROM dog_books
		WHERE dog_book_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$janruSQL)) {
		/* マーカにパラメータをバインドします */
		$janruid = $DOGJANRU[$i];
		 mysqli_stmt_bind_param($stmt, "s", $janruid);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$janruname);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		mysqli_stmt_fetch($stmt);
		if(isset($kenname)){
		$JANRUNAME[] = $janruname;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		$JANRUNAME[] = "未入力";
		}
		//}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

	}
}

//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}
?>
