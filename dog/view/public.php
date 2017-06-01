<?php

function html_header(){
	global $level,$css,$js,$title,$keywords,$description,$author;

	echo'
	<!DOCTYPE html>
	<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="keywords" content="'.$keywords.'">
		<meta name="description" content="'.$description.'">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="'.$author.'">
		<title>'.$title.'</title>
		<link rel="stylesheet" href="'.$level.'css/reset.css" type="text/css" />
		<link rel="stylesheet" href="'.$level.'css/yoyaku.css" type="text/css" />
		<link rel="stylesheet" href="'.$level.'css/style.css" type="text/css" />
		'.$css.'
		<script type="text/javascript" src="'.$level.'js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="'.$level.'js/cookie.js"></script>
			<script type="text/javascript" src="'.$level.'js/easing.js"></script>
		'.$js.'
		<script type="text/javascript" src="'.$level.'js/script.js"></script>
	</head>

<body>
	<div id="wrap">
	<div id="top">
	<header class="flL">
    	<h1 id="top"><a href="'.$level.'"><img src="'.$level.'img/logo.png" width="200" height="100" alt="ロゴ"/></a></h1>
    </header>

';}

function html_nav(){
	global $level,$lcheck;

	echo'
	<nav id="top_nav" class="flL cfx">
		<div id="font" class="flL cfx">
	      <p class="flL">文字</p>
	      <ul class="flL">
	       	<li class="small flL">S</li>
		    <li class="middle flL">M</li>
		    <li class="large flL">L</li>
	      </ul>
	      '.$lcheck.'
	    </div>

		<div id="gnavi" class="flL cfx">
	      <ul class="flL cfx">
	        	<li class="bo flL"><a href="'.$level.'friend/">友達検索</a></li>
	        	<li class="bo flL"><a href="'.$level.'store/">店舗検索</a></li>
	        	<li class="bo flL"><a href="'.$level.'zukan/">犬種一覧</a></li>
	        	<li class="flL"><a href="'.$level.'news/">ニュース</a></li>
	        </ul>
	    </div>
    </nav>
    </div>

';}

function mypage_nav(){
	global $level,$image,$pet_name,$pet_id,$dog_link;

	echo'
	<div class="cfx">
		<div class="flL txC">
			<section id="my_info">
				<p class="img"><img src="'.$level.'img/user_img/'.$image.'" width="200" height="200"/></p>
				<p class="petname">'.$pet_name.'</p>
				<p class="pet_ken">'.$dog_link.'</p>
				<p class="more"><a href="'.$level.'mypage/pet/change/?pet_id='.$pet_id.'">確認・変更する</a></p>
			</section>
			<section id="mypage_navi">
				<ul>
					<li><a href="'.$level.'mypage/">MYページトップ</a></li>
					<li><a href="'.$level.'mypage/user/">会員情報確認・変更</a></li>
					<li><a href="'.$level.'mypage/pet/">ペット一覧</a></li>
					<li><a href="'.$level.'mypage/friend/">フォロー一覧</a></li>
					<li><a href="'.$level.'mypage/uke/">フォロワー一覧</a></li>
					<li><a href="'.$level.'mypage/store/">お気に入り店舗</a></li>
					<li><a href="'.$level.'core/logout.php">ログアウト</a></li>
					<li><a href="'.$level.'mypage/taikai/">退会する</a></li>
				</ul>
				<p><a href="'.$level.'"><span><</span>トップページへ</a></p>
			</section>
		</div>

';}


function html_footer(){
	global $level;

	echo'
	<footer>
		<nav id="fnavi" class="cfx">
			<ul class="txC">
				<!--
				<li class="bo flL"><a href="'.$level.'help/">ヘルプ</a></li>
				<li class="bo flL"><a href="'.$level.'sitemap/">サイトマップ</a></li>
				<li class="bo flL"><a href="'.$level.'agreement/">利用規約</a></li>
				<li class="flL"><a href="'.$level.'privacy/">個人情報の取扱について</a></li>
				-->
				<li class="bo flL"><a href="'.$level.'friend/">friend list</a></li>
				<li class="bo flL"><a href="'.$level.'store/">store list</a></li>
				<li class="bo flL"><a href="'.$level.'zukan/">picture book list</a></li>
				<li class="flL"><a href="'.$level.'news/">news</a></li>
			</ul>
			<p><a href="#top" class="scroll">Back to PAGE TOP ↑</a></p>
		</nav>
		<hr>
    	<p class="txR">copyright&copy; 2016-2017 miwa shuntaro. All Rights Reserved.</p>
    </footer>

';}

?>
