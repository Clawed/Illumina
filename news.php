<?php

	/*
	  _____ _ _                 _             
	 |_   _| | |               (_)            
	   | | | | |_   _ _ __ ___  _ _ __   __ _ 
	   | | | | | | | | '_ ` _ \| | '_ \ / _` |
	  _| |_| | | |_| | | | | | | | | | | (_| |
	 |_____|_|_|\__,_|_| |_| |_|_|_| |_|\__,_|
		
		Illumina CMS by Jonteh (http://zaphotel.net/)
		RaGEZONE Thread for updates & help: http://forum.ragezone.com/f353/rel-illumina-cms-php-oop-917506/
	*/
	
	require_once "required.php";
	
	if(!$users->isLogged()) {
		header ("Location: " . WWW . "/");
		exit;
	}
	
	define('CommunitySelected', true);
	define('ArticleTabSelected', true);

	if(isset($_GET["_news_id"])) {
		$_id = $db->real_escape_string($_GET["_news_id"]);
	}
	else if(isset($_GET["_news_article_seo"])) {
		$_getId = explode('-', $db->real_escape_string($_GET["_news_article_seo"]));
		$_id = $_getId[0];
	}
	else if($r = $db->query("SELECT id FROM site_news ORDER BY id DESC LIMIT 1")) {
		while($rs = $r->fetch_assoc()) {
			$_id = $rs['id'];
		}
	}

	if($q = $db->query("SELECT id,title,datestr,snippet,body FROM site_news WHERE id = '" . $_id . "' LIMIT 1")) {
		while($news = $q->fetch_assoc()) {
			$tpl->assign('mainTitle', stripslashes($news['title']));
			$tpl->assign('postedDate', $news['datestr']);
			$tpl->assign('newsSummary', stripslashes($news['snippet']));
			$tpl->assign('newsArticle', stripslashes($news['body']));
			define('Title', $news['title']);
		}
	}
	else {
		$db->databaseError($db->error);
	}
	
	define('_id', $_id);
	
	$tpl->assign('pagetitle', Title);
	
	$tpl->draw('cms-head');
	$tpl->draw('cms-generictop');
	$tpl->draw('com-nav');
	$tpl->draw('col1-start');
	$tpl->draw('newslist');
	$tpl->draw('col-end');
	$tpl->draw('col2-start');
	$tpl->draw('newsarticle');
	$tpl->draw('col-end');
	
	$tpl->draw('footer');
	
?>