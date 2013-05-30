<?php if(!defined('In_ZapHK')) { exit; } 

	if(isset($_GET["p"]) && is_numeric($_GET["p"]) && $_GET["p"] > 1) {
		$currentPage = $_GET["p"];
		$limiter = $currentPage * 50;
	}
	else {
		$currentPage = 1;
		$limiter = 0;
	}
	
	$laget = $db->query("SELECT null FROM bans");
	$getMax = $laget->num_rows;
	$getMax = $getMax / 50;
	$getMax = round($getMax, 0, PHP_ROUND_HALF_UP);
	$pageStr = "";
	for($i = 1; $i < $getMax + 1; $i++) {
		if($i == $getMax) {
			$pageStr .= "<a href='index.php?_page=banlist&p=" .$i . "'>" . $i ."</a>";
		}
		else if($i == $currentPage) {
			if($currentPage == $getMax) {
				$pageStr .= "<b>" . $i . "</b>";
			}
			else {
				$pageStr .= "<b>" . $i . "</b>, ";
			}
		}
		else {
			$pageStr .= "<a href='index.php?_page=banlist&p=" .$i . "'>" . $i ."</a>, ";
		}
	}
	$getBanQuery = "SELECT * FROM bans";
	$countQuery = "SELECT count(null) FROM bans";
	if(isset($_POST["searchBans"])) {
		$searchu = $db->real_escape_string($_POST["usernameToSearch"]);
		$getBanQuery .= " WHERE value = '" . $searchu . "' ORDER BY id DESC LIMIT " . $limiter . ",50";
	}
	else {
		$getBanQuery .= " ORDER BY id DESC LIMIT " . $limiter . ",50";
	}
?>

<div class="MainContentBox">
	<div class="Box">
		<div class="Title">View the banned users</div>
		<div class="Content" align="left;">
			You can view the ban list here. Note the search and page features to help you navigate.
			<?php
				if(isset($_GET["unban"])) {
					$unbanValue = $db->real_escape_string($_GET["id"]);
					$db->real_query("DELETE FROM bans WHERE id = '" . $unbanValue . "'");
					echo "<br /><br />Ban lifted";
				}
			?>
			<br /><br />
			Search Username/IP: <br />
			<form method='post'>
				<input type='text' name='usernameToSearch'> <br />
				<input type='submit' name='searchBans' value='Search ban list'>
			</form> <br /><br />
			Pages: <br />
			<h3><?php echo $pageStr; ?></h3><br />
			<table>
				<tr>
					<td>Username/IP</td>
					<td>Ban Reason</td>
					<td>Date Unbanned</td>
					<td>Banned By</td>
					<td>Options</td>
				</tr>
				<?php
					if($getbans = $db->query($getBanQuery)) {
						while($bans = $getbans->fetch_assoc()) {
							echo "<tr><td>" . $bans['value'] . "</td>
								<td>" . $bans['reason'] . "</td>
								<td>" . date('F j, Y, g:i a', $bans['expire']) . "</td>
								<td>" . $bans['added_by'] . "</td>
								<td><a href='?_page=banlist&unban&id=" . $bans['id'] . "'>Unban</a></td></tr>";
						}
					}
				?>
			</table>
		</div>
	</div>
</div>