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
	
	$req = 'cmd=_notify-validate';
	$header = "";
	
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$req .= "& " . $key . "=" . $value;
	}
	
	$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	
	$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
	
	if($fp) {
		fputs ($fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
			if (strcmp ($res, "VERIFIED") == 0) {
				
				// *************************
				$payment_status = $_POST['payment_status'];
				$transaction_id = $_POST['txn_id'];
				$payer_email 	= $_POST['payer_email'];
				$amount_paid	= $_POST['mc_gross'];
				
				// ************************
				$getPack = explode('|', $_POST["custom"]);
				$pack = $getPack[0];
				$un = $getPack[1];
				$id = $users->userVar($un, 'id');
				$ip = $users->userVar($un, 'ip_last');
				
				// Payment statuses
				//		- Completed
				//		- Canceled_Reversal
				if ($payment_status == 'Completed') {
					if($pack == "1") {
						$db->real_query("INSERT INTO ipn_alerts (username,ipaddress,msg,done) VALUES('" . $un . "', '" . $ip . "', '1 Ultra Rare')");
						define('doQuery', "UPDATE users SET rank = '4', credits = credits + '500000', activity_points = activity_points + '500000' WHERE id = '" . $id . "'");
					}
					else if($pack == "2") {
						$db->real_query("INSERT INTO ipn_alerts (username,ipaddress,msg,done) VALUES('" . $un . "', '" . $ip . "', '10 Ultra Rares')");
						define('doQuery', "UPDATE users SET rank = '4', credits = credits + '1000000', activity_points = activity_points + '1000000' WHERE id = '" . $id . "'");
					}
					else if($pack == "3") {
						define('credAmount', '75000');
						define('rankLevel', '2');
						$db->real_query("INSERT INTO user_badges (user_id, badge_id, badge_slot) VALUES ('" . $id . "', 'GL2', '0')");
					}
					else if($pack == "4") {
						define('credAmount', '100000');
						define('rankLevel', '3');
						$db->real_query("INSERT INTO user_badges (user_id, badge_id, badge_slot) VALUES ('" . $id . "', 'GL4', '0')");
					}
					else if($pack == "5") {
						define('credAmount', '125000');
						define('rankLevel', '4');
						$db->real_query("INSERT INTO user_badges (user_id, badge_id, badge_slot) VALUES ('" . $id . "', 'GL6, '0')");
					}
					else if($pack == "6") {
						define('credAmount', '150000');
						define('rankLevel', '4');
						$db->real_query("INSERT INTO user_badges (user_id, badge_id, badge_slot) VALUES ('" . $id . "', 'GL8', '0')");
					}
					else if($pack == "7") {
						define('doQuery', "INSERT INTO user_badges (user_id, badge_id, badge_slot) VALUES ('" . $id . "', 'XXX', '0')");
					}
					else if($pack == "8") {
						$db->real_query("INSERT INTO user_badges (user_id, badge_id, badge_slot) VALUES ('" . $id . "', 'NLB', '0')");
						define('doQuery', "INSERT INTO ipn_alerts (username,ipaddress,msg,done) VALUES('" . $un . "', '" . $ip . "', '5 Ultra Rares and 35 Event Rares')");
					}
					else if($pack == "9") {
						define('doQuery', "UPDATE users SET rank = '5' WHERE id = '" . $id . "'");
					}
					else if($pack == "10") {
						define('doQuery', "UPDATE users SET credits = credits + '500000' WHERE id = '" . $id . "'");
					}
					else if($pack == "11") {
						define('doQuery', "UPDATE users SET activity_points = activity_points + '500000' WHERE id = '" . $id . "'");
					}
					else if($pack == "12") {
						define('doQuery', "UPDATE users SET credits = credits + '1000000' WHERE id = '" . $id . "'");
					}
					else if($pack == "13") {
						define('doQuery', "UPDATE users SET activity_points = activity_points + '1000000' WHERE id = '" . $id . "'");
					}
					
					if(defined("credAmount") && defined("rankLevel")) {
						define('doQuery', "UPDATE users SET rank = '" . rankLevel . "', credits = credits + '" . credAmount . "', activity_points = activity_points + '" . credAmount . "' WHERE id = '" . $id . "'");
					}
					
					if(defined("doQuery")) {
						$db->real_query(doQuery);
					}
					else {
						exit;
					}
				}
				else if ($payment_status == "Canceled_Reversal") {
					$db->real_query("INSERT INTO `flagged_users` (`user_id`) VALUES ('" . $id . "')");
				}
			}
		}
		fclose ($fp);
	}
	else {
		exit;
	}
?>
