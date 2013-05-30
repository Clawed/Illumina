<?php if(!defined('In_ZapHK')) { exit; }

	if(isset($_POST["ArticleTitle"]) && isset($_POST["ArticleTeaser"]) && isset($_POST["ArticleImage"]) && isset($_POST["ArticleContent"]) && isset($_POST['newsId'])) {
		$q = $db->stmt_init();
		$q->prepare("UPDATE site_news SET title = ?, snippet = ?, body = ?, topstory_image = ? WHERE id = ?");
		$q->bind_param('ssssi', $_POST["ArticleTitle"], $_POST["ArticleTeaser"], $_POST["ArticleContent"], $_POST["ArticleImage"], $_POST["newsId"]);
		$q->execute();
		$q->close();
		define('Edited', true);
	}
	else if(!isset($_GET["articleId"])) {
		header("Location: " . WWW . "/admin/index.php?_page=writenews");
	}
	else {
		$id = filter($_GET["articleId"]);
	}
	
	$getInfo = $db->query("SELECT title,snippet,body,topstory_image FROM site_news WHERE id = '" . $id . "'");
	while($news = $getInfo->fetch_assoc()) {
		$title = stripslashes($news['title']);
		$snippet = stripslashes($news['snippet']);
		$body = stripslashes($news['body']);
		$image = $news['topstory_image'];
		$_POST['ArticleImage'] = $image;
	}
		
?>

<script type="text/javascript" src="../engine/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
function previewTS(el)
{
	document.getElementById('ts-preview').innerHTML = '<img src="<?php echo WWW; ?>/images/ts/' + el + '" />';
}

tinyMCE.init({
	mode : "textareas",
	elements : "content",
	theme : "advanced",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_resizing : true,
	theme_advanced_statusbar_location : "bottom"
});
</script>

<div class="MainContentBox">
	<div class="Box">
		<div class="Title">Publish a News Article</div>
		<div class="Content" align="left;">
			You can make news articles on this page. Please seek Managerial approval before posting or you will be demoted. <br /><br />
			<?php if(!defined('Edited')) { ?>
			<form method='post'>
				<h3>Article Title</h3>
				<input type="text" value="<?php echo $title; ?>" name="ArticleTitle" size="50" onkeyup="suggestSEO(this.value);" style="padding: 5px; font-size: 130%;"><br />
				<br />
				<h3>Teaser Text</h3>
				<input type='text' value="<?php echo $snippet; ?>" name='ArticleTeaser' size='30' style="padding: 5px; font-size: 130%;"><br />
				<br />
				<h3>Article Image</h3>
				<div id="ts-preview"></div>
				<br />				
				<select onkeypress="previewTS(this.value);" onchange="previewTS(this.value);" name="ArticleImage" id="topstory" style="padding: 5px; font-size: 120%;">
				
				<?php
				if ($handle = opendir('../images/ts')) {
					while (false !== ($file = readdir($handle))) {
						if ($file == '.' || $file == '..' || $file == 'index.php') {
							continue;
						}
						echo '<option value="' . $file . '"';
						if ($image == $file) {
							echo ' selected';
						}
						echo '>' . $file . '</option>';
					}
				}
				?>
				
				</select>
								
				<h3>Main Story</h3>
				<textarea name="ArticleContent" cols="70" rows="15"><?php echo $body; ?></textarea>
				
				<br /> <br />
				<input type='hidden' value='<?php echo $id; ?>' name='newsId'>
				<input type='submit' value='Edit Article'>
			</form>
			<?php } else { ?>
			Your News Article has been edited.
			<?php } ?>
		</div>
	</div>
</div>