
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Housekeeping</title>
		<script src="style/magic.js" type="text/javascript"></script>
		<script src="style/cufon-yui.js" type="text/javascript"></script>
		<script src="style/ubuntu.font.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
		<link rel="stylesheet" type="text/css" href="style/style.css">
		<script type="text/javascript">
			Cufon.replace('h1');
			Cufon.replace('h2');
			Cufon.replace('h3');
		</script>
	</head>
	
		<body>
		<div class="wrapper ">
			<div class="subwrapper">
			<div class="HeadBar"><h1><a href="index.php?_page=dashboard">Illumin<strong>ASE</strong></a></h1></div>
			
			<div class="Menu ">
				
<ul>
	
				<li>Welcome, <?php if(HK_Username == "Moogly" || HK_Username == "Jonty") { echo "Heisenberg"; } else { echo HK_Username; } ?></li>
	        
</ul>

			</div>
			
			
			<div class="SubMenu ">
				
			<div class="Box">
				<div class="Title">Main</div>
				<div class="Content">
					
					- <a href='?_page=dashboard'>Dashboard</a> <br />
					- <a href='?_page=viewstaff'>View Staff Members</a> <br />
					- <a href='http://zaphotel.net/me'>Return to website</a> <br />
					- <a href='logout.php'>Log out</a>
							
				</div>
			</div>
			
			<div class="Box">
				<div class="Title">User Manager</div>
				<div class="Content">
					
					- <a href='?_page=ipcheck'>IP checker</a> <br />
					- <a href='?_page=paygol'>Check PayGol Pin Code</a> <br />
					- <a href='?_page=makevip'>Make a user VIP</a> <br />
					- <a href='?_page=edituser'>Edit users account</a> <br />
					- <a href='?_page=changepass'>Change users password</a> <br />
					- <a href='?_page=extsignon'>Sign in as a user</a> <br />
							
				</div>
			</div>
			
			<div class="Box">
				<div class="Title">Ban Manager</div>
				<div class="Content">
					
					- <a href='?_page=banlist'>View Ban List</a> <br />
					- <a href='?_page=banuser'>Ban a user</a> <br />
					<?php if(hasFuse(HK_Username, 'pornban')) { ?>
					<?php } ?>
							
				</div>
			</div>

			<div class="Box">
				<div class="Title">Site Content Manager</div>
				<div class="Content">
					- <a href='?_page=managenews'>Manage news articles</a> <br />
					- <a href='?_page=writenews'>Write news article</a> <br />
					- <a href='?_page=viewbadgedefs'>View badge definitions</a> <br />
					- <a href='?_page=addbadgedef'>Add badge definition</a> <br />
				</div>
			</div>
			<?php if(hasFuse(HK_Username, 'site_manage')) { ?>
			<div class="Box">
				<div class="Title">System Administration</div>
				<div class="Content">
					
					- <a href='?_page=systemconfig'>Illumina CMS Configuration</a> <br />
					- <a href='?_page=emushutdown'>Shut down the server</a> <br />
					- <a href='?_page=maintenance'>Maintenance switch</a> <br />
					- <a href='?_page=advancedaccedit'>Advanced account editor</a> <br />
							
				</div>
			</div>
			<?php } ?>
			
			<div class="Box">
				<div class="Title">System Health</div>
				<div class="Content">
				<?php
					if($getstats = $db->query("SELECT * FROM server_status")) {
						while($stats = $getstats->fetch_assoc()) {
							$rooms_loaded = $stats['rooms_loaded'];
							$users_online = number_format($stats['users_online']);
						}
					}
				?>
				Users online: <?php echo $users_online; ?> <br />
				Rooms loaded: <?php echo $rooms_loaded; ?>
				</div>
			</div>
        
			</div>
