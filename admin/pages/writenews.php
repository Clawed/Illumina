<?php if(!defined('In_ZapHK')) { exit; } 

	if(isset($_POST["ArticleTitle"]) && isset($_POST["ArticleTeaser"]) && isset($_POST["ArticleImage"]) && isset($_POST["ArticleContent"])) {
		$title = filter($_POST["ArticleTitle"]);
		$teaser = filter($_POST["ArticleTeaser"]);
		$image = WWW . "/images/ts/" . filter($_POST["ArticleImage"]);
		$content = filter($_POST["ArticleContent"]);
		if($gett = $db->query("SELECT null FROM site_news")) {
			$res = $gett->num_rows + 1;
		}
		$seo_link = $res . "-" . strtolower(str_replace(' ', '-', $title));
		$db->real_query("INSERT INTO `site_news_autobackup` (`seo_link`,`title`,`category_id`,`topstory_image`,`body`,`snippet`,`datestr`,`timestamp`) VALUES ('" . $seo_link . "', '" . $title . "', '1', '" . $image . "', '" . $content . "', '" . $teaser . "', '" . date('d-M-Y') . "', '" . time() . "')");
		$db->real_query("INSERT INTO `site_news` (`seo_link`,`title`,`category_id`,`topstory_image`,`body`,`snippet`,`datestr`,`timestamp`) VALUES ('" . $seo_link . "', '" . $title . "', '1', '" . $image . "', '" . $content . "', '" . $teaser . "', '" . date('d-M-Y') . "', '" . time() . "')");
		define('Published', true);
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
			<?php if(!defined('Published')) { ?>
			<form method='post'>
				<h3>Article Title</h3>
				<input type="text" value="<?php if(isset($_POST['ArticleTitle'])) { echo $_POST['ArticleTitle']; } ?>" name="ArticleTitle" size="50" onkeyup="suggestSEO(this.value);" style="padding: 5px; font-size: 130%;"><br />
				<br />
				<h3>Teaser Text</h3>
				<input type='text' value="<?php if(isset($_POST["ArticleTeaser"])) { echo $_POST["ArticleTeaser"]; } ?>" name='ArticleTeaser' size='30' style="padding: 5px; font-size: 130%;"><br />
				<br />
				<h3>Article Image</h3>
				<div id="ts-preview"></div>
				<br />				
				<select onkeypress="previewTS(this.value);" onchange="previewTS(this.value);" name="ArticleImage" id="topstory" style="padding: 5px; font-size: 120%;">
				
				<?php
				if ($handle = opendir('../images/ts')) {
					while (false !== ($file = readdir($handle))) {
						if ($file == '.' || $file == '..') {
							continue;
						}
						echo '<option value="' . $file . '"';
						if (isset($_POST['ArticleImage']) && $_POST['ArticleImage'] == $file) {
							echo ' selected';
						}
						echo '>' . $file . '</option>';
					}
				}
				?>
				
				</select>
								
				<h3>Main Story</h3>
				<textarea name="ArticleContent" cols="70" rows="15"></textarea>
				
				<br /> <br />
				<input type='submit' value='Publish Article'>
			</form>
			<?php } else { ?>
			Your News Article has been posted to the website.
			<?php } ?>
		</div>
	</div>
</div>