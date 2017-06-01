<?php
function rss_get_contents($url){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url );
	curl_setopt($curl, CURLOPT_HEADER, false );
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_MAXREDIRS, 1);
	$result = curl_exec($curl);
	curl_close($curl);
	return $result;
}

function outPutRss($rss, $maxsize = 5) {

	if (isset($rss->channel->title)) {
		$site_name = $rss->channel->title;
		$site_url  = $rss->channel->link;
	} else {
		$site_name = $rss->title;
		$site_url  = $rss->link['href'];
	}

	// printf('<h2><a href="%s" target="_blank">%s</a></h2>',  $site_url, $site_name);

	if (isset($rss->item)) {
		$items = $rss->item;
	} elseif (isset($rss->channel->item)) {
		$items = $rss->channel->item;
	} else {
		$items = $rss->entry;
	}

	$i = 0;
	foreach ($items as $item) {
		if($i >= $maxsize){
			break;
		} else {
			$i++;
			if (isset($item->link)) {
				$link = $item->link;
			} else {
				$link = $item->link['href'];
			}

			$title = $item->title;
			if (isset($item->description)) {
				$content = $item->description;
			} else {
				$content = $item->content;
			}
			$title = mb_strimwidth($title, 0, 85, '・・・', 'UTF-8');
			$content = strip_tags($content);
			$content = mb_strimwidth($content, 0, 300, '・・・', 'UTF-8');
			$pubDate = $item->children('http://purl.org/dc/elements/1.1/');
			if (isset($item->pubDate)) {
				$time = $item->pubDate;
			} elseif (isset($pubDate->date)) {
				$time = $pubDate->date;
			} elseif (isset($item->issued)) {
				$time = $item->issued;
			} else {
				$time = $item->published;
			}
			$dt = new DateTime($time);
			$time = $dt->format('m/d H:i:s');
			printf('<dl class="cfx"><dt class="time flL">'.$time.'</dt><dt class="news_content flL"><a href="'.$link.'" target="_blank">'.$title.'</a></dt></dl>');
			// printf('<dd>%s</dd>', $content);
		}
	}
}
;?>

<?php

//検索1
$keyword = "犬";
$keyword = urlencode($keyword);
$keyword .= "+";
$kensaku = $keyword;
//検索2
$keyword = "ペット";
$keyword = urlencode($keyword);
$keyword .= "+";
$kensaku .= $keyword;
//検索3
$keyword = "ドッグラン";
$keyword = urlencode($keyword);
$keyword .= "+";
$kensaku .= $keyword;
//検索4
$keyword = "犬飼い方";
$keyword = urlencode($keyword);
$keyword .= "+";
$kensaku .= $keyword;
//検索5
$keyword = "犬生活";
$keyword = urlencode($keyword);
$keyword .= "+";
$kensaku .= $keyword;
//検索6
$keyword = "犬イベント";
$keyword = urlencode($keyword);
$kensaku .= $keyword;

//https://news.google.com/news?hl=ja&ned=us&ie=UTF-8&oe=UTF-8&output=rss&q=%E7%8A%AC
$rss_urls = array(
	"http://news.google.com/news?hl=ja&ned=us&ie=UTF-8&oe=UTF-8&output=rss&q=".$kensaku
);
?>
