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
	
	error_reporting(0);

	$load = file_get_contents("/proc/loadavg");
	$load = explode(' ',$load);
	$load = $load[0];
    if (!$load && function_exists('exec')) {
		$reguptime=trim(exec("uptime"));
		if ($reguptime) if (preg_match("/, *(\d) (users?), .*: (.*), (.*), (.*)/",$reguptime,$uptime)) $load = $uptime[3];
	}

	$uptime_text = file_get_contents("/proc/uptime");
	$uptime = substr($uptime_text,0,strpos($uptime_text," "));
	if (!$uptime && function_exists('shell_exec')) $uptime = shell_exec("cut -d. -f1 /proc/uptime");
	$days = floor($uptime/60/60/24);
	$hours = str_pad($uptime/60/60%24,2,"0",STR_PAD_LEFT);
	$mins = str_pad($uptime/60%60,2,"0",STR_PAD_LEFT);
	$secs = str_pad($uptime%60,2,"0",STR_PAD_LEFT);
	echo "<load>$load</load>\n";
	if($days == 0){
		if($hours == 0){
			if($mins == 0){
				echo "<uptime>" . $secs . "s</uptime>\n";
			} else {
				echo "<uptime>" . $mins . "m</uptime>\n";
			}
		} else {
			echo "<uptime>" . $hours . "h " . $mins . "m " . $secs . "s</uptime>\n";
		}
	} else {
		echo "<uptime>" . $days . "d " . $hours . "h " . $mins . "m</uptime>\n";
	}
?>