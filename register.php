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

	if($users->isLogged()) {
		header ("Location: " . WWW . "/me");
		exit;
	}
	else if(!$light->reg_enabled) {
		header ("Location: " . WWW . "/index.php?registerDisabled");
		exit;
	}
	else if(isset($_GET["_error"])) {
		$gerr = $db->real_escape_string($_GET["_error"]);
		$err = str_replace('-', ' ', $gerr);
		$tpl->assign('errorSpace', '<div id="error-messages-container" class="cbb">
          <div class="rounded" style="background-color: #cb2121;">
             <div id="error-title" class="error">
                 ' . $err . ' <br />
					 </div>
				  </div>
			  </div>');
	}
	else {
		$tpl->assign('errorSpace', '<div id="error-placeholder"></div>');
	}
	
	if($db->lnumrows("SELECT null FROM users WHERE ip_last = '" . $_SERVER["REMOTE_ADDR"] . "' OR ip_reg = '" . $_SERVER["REMOTE_ADDR"] . "'") >= $light->max_per_ip) {
		header ("Location: " . WWW . "/index.php?maxAccountsReached");
		exit;
	}
	
	$tpl->assign('title', 'Register an account');
	
	if(isset($_GET["_register_step"])) {
		$s = $db->real_escape_string($_GET["_register_step"]);
		if($s == 1) {	// Birth date, gender
			$tpl->draw('quickregister-step1');
		}
		else if($s == 2) { // age_gate_submit - verify birthdate and gender
			if(isset($_POST["bean_month"]) && isset($_POST["bean_day"]) && isset($_POST["bean_year"]) && isset($_POST["bean_gender"])) {
				$m = $db->real_escape_string($_POST["bean_month"]);
				$d = $db->real_escape_string($_POST["bean_day"]);
				$y = $db->real_escape_string($_POST["bean_year"]);
				$g = $db->real_escape_string($_POST["bean_gender"]);

				$_SESSION["_ageGatePass"] = true;
				$_SESSION["_userAge"] = $d . "/" . $m . "/" . $y;
				$_SESSION["_userGender"] = $g;
				header ("Location: " . WWW . "/quickregister/email_password");
				exit;
			}
		}
		else if($s == 3) { // email_password - get their email and their password for future logins
			if(!isset($_SESSION["_ageGatePass"]) || !isset($_SESSION["_userAge"]) || !isset($_SESSION["_userGender"])) {
				header ("Location: " . WWW . "/quickregister/age_gate/error");
				exit;
			}
			else {
				$tpl->draw('quickregister-step2');
			}
		}
		else if($s == 4) { // email_password_submit
			if(isset($_POST["bean_username"]) && isset($_POST["bean_email"]) && isset($_POST["bean_retypedEmail"]) && isset($_POST["bean_password"]) && isset($_POST["bean_termsOfServiceSelection"])) {
				$u1 = str_replace(" ", "", $db->real_escape_string($_POST["bean_username"]));
				$u = $users->forceFormat($u1);
				$e = $db->real_escape_string($_POST["bean_email"]);
				$e2 = $db->real_escape_string($_POST["bean_retypedEmail"]);
				$pwlen = strlen($_POST["bean_password"]);
				$p = 	$users->userHash($_POST["bean_password"], $u);
				$t = $db->real_escape_string($_POST["bean_termsOfServiceSelection"]);
				if(!$users->isUsernameValid($u)) {
					header("Location: " . WWW . "/quickregister/email_password_submit/invalid_username");
					exit;
				}
				else {
					if($e == $e2 && $users->isEmailValid($e)) {
						if($pwlen >= 6 && !empty($u)) {
							$_SESSION["_captcha"] = rand(1,9) . rand(1,9) . rand(1,9) . rand(1,9);
							$_SESSION["_emailGatePass"] = true;
							$_SESSION["_userEmail"] = $e;
							$_SESSION["_userPassword"] = $p;
							$_SESSION["_userName"] = $u;
							header("Location: " . WWW . "/quickregister/captcha");
							exit;
						}
						else {
							header("Location: " . WWW . "/quickregister/email_password_submit/invalid_password");
							exit;
						}
					}
					else {
						header("Location: " . WWW . "/quickregister/email_password_submit/invalid_email");
						exit;
					}
				}	
			}
			else {
				header ("Location: " . WWW . "/quickregister/email_password_submit/fields");
				exit;
			}
		}
		else if($s == 5) {
			if(!isset($_SESSION["_emailGatePass"])) { header ("Location: " . WWW . "/quickregister/start"); }
			$_SESSION["_captcha"] = rand(1,9) . rand(1,9) . rand(1,9) . rand(1,9) . rand(1,9);
			$tpl->assign('captcha', '<font color="white" size="6">' . $_SESSION["_captcha"] . '</font>');
			$tpl->draw('quickregister-step3');
		}
		else if($s == 6) {
			if(isset($_POST["captchaResponse"])) {
				$r = $_POST["captchaResponse"];
				$rc = $_SESSION["_captcha"];
				
				if($r == $rc)
				{
					// Lets recap all the user vars we need, add the user and then unset everything.
					$user_age = $_SESSION["_userAge"];
					$user_name = $_SESSION["_userName"];
					$user_gender = $_SESSION["_userGender"];
					$user_email = $_SESSION["_userEmail"];
					$user_password = $_SESSION["_userPassword"];
					$user_signupip = $_SERVER["REMOTE_ADDR"];
					
					$users->addUser($user_name, $user_password, $user_email, $light->default_rank, $light->default_look, $light->default_gender, $light->default_motto, $light->default_homeroom);
						
					unset($user_age);
					unset($user_gender);
					unset($user_email);
					unset($user_betakey);
					unset($_SESSION["_captcha"]);
					unset($_SESSION["_emailGatePass"]);
					unset($_SESSION["_ageGatePass"]);
					
					$_SESSION["Username"] = $user_name;
					unset($user_name);
					
					$_SESSION["HashedPassword"] = $user_password;
					unset($user_password);

					header ("Location: " . WWW . "/me");
					exit;
				}
				else {
					header ("Location: " . WWW . "/quickregister/captcha/error");
					exit;
				}	
			}
		}
		else {
			header("Location: " . WWW . "/quickregister/captcha");
			exit;
		}
	}
?>