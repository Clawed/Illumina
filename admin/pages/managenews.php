<?php if(!defined('In_ZapHK')) { exit; }

	if($queryd = $db->query("SELECT id,title,datestr FROM site_news ORDER BY id DESC")) {
		$output = "<table>
						<tr>
							<td>Article ID</td>
							<td>Title</td>
							<td>Date Posted</td>
							<td>Actions</td>
						</tr>";
						
		while($ndata = $queryd->fetch_assoc()) {
			$output .= "<tr>";
			$output .= "<td>" . $ndata['id'] . "</td>";
			$output .= "<td>" . $ndata['title'] . "</td>";
			$output .= "<td>" . $ndata['datestr'] . "</td>";
			$output .= "<td><a href='index.php?_page=managenews&del=" . $ndata['id'] . "'>Delete</a>, <a href='index.php?_page=editnews&articleId=" . $ndata['id'] . "'>Edit</a></td>";
			$output .= "</tr>";
		}
		
		$output .= "</table>";
	}
?>
<div class="MainContentBox">
	<div class="Box">
		<div class="Title">Manage News Articles</div>
		<div class="Content" align="left;">
			You can view the current news articles, as well as delete them here. <br />
			<br />
			<?php if(isset($_GET["del"])) {
					$db->real_query("DELETE FROM site_news WHERE id = '" . filter($_GET["del"]) . "'");
					echo "Article has been deleted successfully. <br /><br />";
			}
			
			echo $output;
			
			?>
		</div>
	</div>
</div>