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
		
		====================================
		MAKE SURE YOU EDIT THE CONFIGURATION	<<<<
		====================================		<<<<
		MAKE SURE YOU EDIT THE CONFIGURATION	<<<<
		====================================
		
	*/
	
	class LightCMS {
	
		// Database Information (IMPORTANT)
		public $db_hostname = "localhost";
		public $db_username = "zap_web";
		public $db_password = "lol123";
		public $db_dbname = "zapdb";
		
		// Password Hashing Options (IMPORTANT)
		// Valid options:
		// MD5 (Uber 1, RevCMS styled hashing)
		// Normal (Uber 2 & Illumina styled hashing)
		public $hashing_method = "Normal";
		
		// Site Information (IMPORTANT)
		public $site_url = "http://zaphotel.net";
		public $site_name = "Zap Hotel";
		public $site_short = "Zap";
		public $facebook_account = "ZapHotel";
		public $twitter_account = "zaphotelnet";
		public $maintenance = false;
		public $thehabbos_enabled = true;
		public $thehabbos_username = "jcat";
		public $c_images = "http://swfs.zaphotel.net/c_images";
		
		// Misc Settings
		public $pin_enabled = true;
		public $pin_code = "1234";
		public $FORCE_SSL = false;
		public $flash_client_dump = true;
		public $mus_ip = '127.0.0.1';
		public $mus_port = '30001';
		
		// Registration Controls
		public $max_per_ip = 30;
		public $reg_enabled = true;
		public $default_credits = "15000";
		public $default_pixels = "15000";
		public $default_homeroom = "598898";
		public $default_look = "hd-180-2.sh-290-92.lg-275-92.ch-3030-63.hr-831-61";
		public $default_rank = "2";
		public $default_motto = "I am new at Zap, hey!";
		public $default_gender = "M";
		
		// Server Settings
		public $server_type = "Butterfly"; // Phoenix or Butterfly
		
		// Caching Settings
		public $apc_enabled = false;

		// Client Settings
		public $connection_info_host = "198.12.15.107";
		public $connection_info_port = "1332";
		public $variables = "http://swfs.zaphotel.net/externals.php?id=external_variables";
		public $texts = "http://swfs.zaphotel.net/externals.php?id=external_flash_texts";
		public $override_texts = "http://swfs.zaphotel.net/externals.php?id=external_override_flash_texts";
		public $productdata = "http://swfs.zaphotel.net/productdata.txt";
		public $furnidata = "http://swfs.zaphotel.net/furnidata.txt";
		public $baseurl = "http://swfs.zaphotel.net/";
		public $habbo_swf = "http://swfs.zaphotel.net/Zap.swf";
		public $loadingtext = "Please wait! Zap 2.0 is loading.";
	
		// o-------------------------------------------------------------o
		// | THIS IS WHERE THE CODING STARTS! DO NOT EDIT IF YOU ARE NEW |
		// o-------------------------------------------------------------o		
		private $extDir = "engine/classes/ext/";
		private $classDir = "engine/classes/";
		public function exec() {
			require $this->extDir . "class_raintpl.php";
			require $this->classDir . "class_users.php";
			require $this->classDir . "class_settings.php";
			require $this->classDir . "class_core.php";
			require $this->classDir . "class_db.php";
			require $this->classDir . "class_tpl.php";
			$this->MySQLi['Hostname'] = $this->db_hostname;
			$this->MySQLi['Username'] = $this->db_username;
			$this->MySQLi['Password'] = $this->db_password;
			$this->MySQLi['Database'] = $this->db_dbname;
			session_start();
		}
		public static function getMainStories($amt) {
			global $db, $tpl;
			if($r = $db->query("SELECT id,title,topstory_image,snippet FROM site_news ORDER BY id DESC LIMIT " . $amt . "")) {
				$c = 0;
				while($a = $r->fetch_assoc()) {
					$disp = 'block';
					$imgurl = $a['topstory_image'];
					if($c > 0) { $disp = 'none'; }
					$_seo = $a['id'] . "-" . strtolower(str_replace(' ', '-', $a['title']));
					echo '<div class="topstory" style="background-image: url(' . $imgurl . '); display: ' . $disp . ';"> 
							<h4>Latest news</h4> 
							<h3><a href="' . WWW . '/articles/' . $_seo . '">' . $a['title'] . '</a></h3> 
							<p class="summary"> 
							' . $a['snippet'] . '
							</p> 
							<p> 
								<a href="' . WWW . '/articles/' . $_seo . '">Read more &raquo;</a> 
							</p> 
						</div>';					
					$c++;
				}
									echo '<div id="topstories-nav" style="display: none"><a href="#" class="prev">&laquo; Previous</a><span>1</span> / ' . $c . '<a href="#" class="next">Next &raquo;</a></div>';
			}
			else {
				$db->databaseError($db->error);
			}
		}
		public static function getSubStories() {
			global $db;
			if($r = $db->query("SELECT id,title,datestr FROM site_news ORDER BY id DESC LIMIT 3,3")) {
				$oE = "odd";
				while($a = $r->fetch_assoc()) {
					if($oE == "odd") { $oE = "even"; } else { $oE = "odd"; }
					$_seo = $a['id'] . "-" . strtolower(str_replace(' ', '-', $a['title']));
					echo '<li class="' . $oE . '"> 
						<a href="' . WWW . '/articles/' . $_seo . '">' . stripslashes($a['title']) . ' &raquo;</a><div class="newsitem-date">' . $a['datestr'] . '</div> 
						</li>';
				}
			}
			else {
				$db->databaseError($db->error);
			}
		}
		public static function drawNewsList($selectedId) {
			global $db;
			if($listquery = $db->query("SELECT id,title FROM site_news ORDER BY id DESC LIMIT 50")) {
				while($newslist = $listquery->fetch_assoc()) {
					$_seo = $newslist['id'] . "-" . strtolower(str_replace(' ', '-', $newslist['title']));
					if($newslist['id'] == $selectedId) {
						echo "<li>" . $newslist['title'] . "</li>";
					}
					else {
						echo "<li><a href='" . WWW . "/articles/" . $_seo . "'>" . htmlentities(stripslashes($newslist['title'])) . "</a></li>";
					}
				}
			}
			else {
				$db->databaseError($db->error);
			}
		}
		public static function getHotCampaigns() {
			global $db;
			if($get = $db->query("SELECT id,enabled,image_url,caption,descr,url FROM site_hotcampaigns ORDER BY id DESC")) {
				$oddEven = "odd";
				while($camps = $get->fetch_assoc()) {
					$imgurl = $camps['image_url'];
					$url = $camps['url'];
					if($oddEven == "odd") { $oddEven = "even"; } else { $oddEven = "odd"; }
					if($camps['enabled'] == 1) {
							echo 	'<li class="' . $oddEven . '">
							<div class="hotcampaign-container">
							<a href="' . $url . '">
							<img src="' . $imgurl . '" align="left" alt="' . htmlentities(stripslashes($camps['caption'])) . '"/></a>
							<h3>' . htmlentities(stripslashes($camps['caption'])) . '</h3>
							<p>' . htmlentities(stripslashes($camps['descr'])) . '</p>
							<p class="link"><a href="' . $url . '">Go there &raquo;</a></p>
							</div>';
					}
				}
			}
			else {
				$db->databaseError($db->error);
			}
		}
		public function errorMessage($str) {
			return '<center><font color="red"><b>' . $str . '</center></font></b>';
		}
		public function successMessage($str) {
			return '<center><font color="green"><b>' . $str . '</center></font></b>';
		}
		public function Mus($header, $data = '') {
			$musData = $header . chr(1) . $data;
			$sock = @socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
			@socket_connect($sock, $this->mus_ip, $this->mus_port);
			@socket_send($sock, $musData, strlen($musData), MSG_DONTROUTE);	
			@socket_close($sock);
		}
		public static function drawBadgeList() {
			global $users, $db, $light;
			echo "<table align='center'>";
			if($bdq = $db->query("SELECT badge_id,cost FROM badge_shop")) {
				while($bdi = $bdq->fetch_assoc()) {	
					if(!$users->doesUserHaveBadge(USER_ID, $bdi['badge_id'])) {
						$src = "http://";
						echo "<tr>";
						echo "<td><img src='" . $light->c_images . "/album1584/" . $bdi['badge_id'] . ".gif'></td>";
						echo "<td style='font-size:11px;'><form method='post'><input type='hidden' value='" . $bdi['badge_id'] . "' name='BadgeId'> <br />
								This badge costs " . number_format($bdi['cost']) . " coins. <br />
								<input type='submit' value='Purchase this badge'></form></td>";
						echo "</tr>";
					}
				}
			}
			else {
				$db->databaseError($db->error);
			}
			echo "</table>";
		}
		public static function drawRandomHabbos() {
			global $db, $users;
			if($gethabbosq = $db->query("SELECT username FROM users WHERE online = '1' ORDER BY RAND() LIMIT 18")) {
				$i = 0;
				while($randomHabbo = $gethabbosq->fetch_assoc()) {
					echo '<div id="active-habbo-data-' . $i . '" class="active-habbo-data"> 
						<div class="active-habbo-data-container"> 
							<div class="active-name ' . (($users->userVar($randomHabbo['username'], 'online') == "1") ? 'online' : 'offline') . '">' . $users->userVar($randomHabbo['username'], 'username') . '</div> 
							Zap created on: ' . $users->userVar($randomHabbo['username'], 'account_created') . '
								<p class="moto">' . $users->userVar($randomHabbo['username'], 'motto') . '</p> 
						</div> 
					</div>                
					<input type="hidden" id="active-habbo-url-' . $i . '" value="' . WWW . '/user/' . $users->userVar($randomHabbo['username'], 'username') . '"/> 
					<input type="hidden" id="active-habbo-image-' . $i . '" class="active-habbo-image" value="' . WWW . '/avatar.php?figure=' . $users->userVar($randomHabbo['username'], 'look') . '&direction=4&head_direction=4" />';
					$i++;
				}
			}
		}
		public static function drawStaffPageForRank($rankno) {
			global $db, $light, $users;
			if($getranks = $db->query("SELECT username FROM users WHERE rank = '" . $rankno . "' ORDER BY id ASC")) {
				$oddEven = "fff";
				while($udata = $getranks->fetch_assoc()) {
					if($oddEven != "E6E6E6") {
						$oddEven = "E6E6E6";
					}
					else {
						$oddEven = "fff";
					}
					
					$u = $udata['username'];
					$displayname = $u;
					
					$getBadge = $db->query("SELECT badge_id FROM user_badges WHERE user_id = '" . $users->userVar($u, 'id') . "' AND badge_slot = '1' LIMIT 1");
					while($bI = $getBadge->fetch_assoc()) {
						$usersBadge = $bI['badge_id'];
					}					
					if($users->userVar($u, 'online') == "1") { $online = "online_anim"; } else { $online = "offline"; }
					echo '<table width="107%" style="padding: 5px; margin-left: -15px; background-color: #' . $oddEven . '; font-size:11px;">
						<tbody>
							<tr>
								<td valign="middle" width="25">
									<img style="margin-top: -10px;" src="' . WWW . '/avatar.php?figure=' . $users->userVar($u, 'look') . '">
								</td>
								<td valign="top">
									<img src="' . WWW . '/images/habbo_' . $online . '.gif" align="left"><b style="font-size: 110%;"><a href="' . WWW . '/user/' . $u . '">' . $displayname . '</a></b><br /><br />
									Motto: <i>' . $users->userVar($u, 'motto') . '</i> <br />
									<img src="' . $light->c_images . '/album1584/' . $usersBadge . '.gif">
								</td>
							</tr>
					</tbody>
					</table>';					
				}
			}
			else {
				echo "<i>There are currently no staff members for this group.</i>";
			}
		}
		public static function getWallComments($pageid) {
			global $db, $light, $users;
			$getComments = $db->query("SELECT id, poster_id, message, likes FROM profile_wall WHERE page_id = '" . $pageid . "' ORDER BY id DESC LIMIT 10");
			echo '<table style="font-size:11px;">';
			while($cData = $getComments->fetch_assoc()) {
				$username = $users->userVar($users->idToName($cData['poster_id']), 'username');
				echo "<tr>";
				echo "<td><img src='" . WWW . "/avatar.php?figure=" . $users->userVar($username, 'look') . "&gesture=sml&size=m'><br /><center><a href='" . WWW . "/user/" . $username . "'><b>" . $username . "</b></a>";
				if($pageid == USER_ID || USER_RANK > 10) {
					echo "<br /><br /><a href='" . WWW . "/user/" . $users->idToName($pageid) . "&deleteComment=" . $cData['id'] . "'>Delete</a>";
				}
				echo "</center></td>";
				echo "<td>" . htmlentities(stripslashes($cData["message"]));
				echo "</td>";
				echo "</tr>";
				
			}
			echo "</table>";
		}
		public static function getUnreadCount($userid) {
			global $db;
			$query = $db->query("SELECT null FROM profile_wall WHERE page_id = '" . $userid . "' AND owner_read = '0' LIMIT 10");
			return $query->num_rows;
		}
		public static function getOnlineFriends($userid) {
			$friendsList = array();
			global $db, $users;
			$getFriends = $db->query("SELECT receiver,sender FROM messenger_friendships WHERE receiver = '" . $userid . "' OR sender = '" . $userid . "'");
			while($friends = $getFriends->fetch_assoc()) {
				if($friends['receiver'] != $userid && $friends['sender'] == $userid) {
					$friendsList[] = $friends['receiver'];
				}
				else if($friends['sender'] != $userid && $friends['receiver'] == $userid) {
					$friendsList[] = $friends['sender'];
				}
			}
			$friendCount = count($friendsList);
			
			if($friendCount > 0) {
				$noFriends = true;
				for($i = 0; $i <= $friendCount; $i++) {
					$username = $users->idToName($friendsList[$i]);
					if($users->userVar($username, 'online') == 1) {
						echo "<a href='" . WWW . "/user/" . $username . "'><img src='" . WWW . "/avatar.php?figure=" . $users->userVar($username, 'look') . "&gesture=wav&size=s'></a>";
						$noFriends = false;
					}
				}
				if($noFriends) {
					echo "<i>This user does not have any friends online.</i>";
				}
			}
			else {
				echo "<i>This user does not have any friends.</i>";
			}
		}
		public static function displayUserBadges($userid) {
			global $db, $light;
			$querye = $db->query("SELECT badge_id FROM user_badges WHERE user_id = '" . $userid . "'");
			while($badges = $querye->fetch_assoc()) {
				echo "<img src='" . $light->c_images . "/album1584/" . $badges['badge_id'] . ".gif'>";
			}
		}
		public function isVotingOnline() {
			return @fsockopen("142.4.4.131", 80, $errno, $errstr, 1) ? true : false;
		}
	}
?>