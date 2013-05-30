<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link href="images/css/login.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		#people-inside{display:block;float:right;height:65px;position:relative;overflow:hidden;white-space:nowrap;z-index:100;bottom:100px;right:140px}#people-inside b{float:left;padding:5px 10px 4px 16px;font-size:11px;height:56px;min-width:45px;max-width:145px;margin-right:8px;background:transparent url('{$www}/images/users_online_bubble.png') no-repeat -8px 0;color:#000;font-weight:normal;text-align:center;display:inline}
		#people-inside i{position:absolute;right:0;top:0;width:8px;height:65px;background:transparent url('{$www}/images/users_online_bubble.png') no-repeat 0 0}#people-inside span{display:block}#people-inside .stats-fig{font-size:18px;font-weight:bold}
	</style>
</head>
<body>

<div class="header">
	<div class="center static relative">
		<div class="logo"><img src='images/logo.png' id='picOne'></div>
		<form method="post">
			<div class="loginBox-E">
				<label for="username">Username</label>
					<br />
				<input type="text" name="credentials_username" id="username" />
					<br />
			</div>
			<div class="loginBox-P">
				<label for="password">Password</label>
					<br />
				<input type="password" name="credentials_password" id="password" />
					<br />
			</div>
			<div class="loginBox-S">
				<input type="submit" value="Login" name="Login" />
			</div>
		</form>
	</div>
</div>
<div class="main">
	<div class="center static relative backdrop" onclick="location.href='quickregister/start'">
		<div class="joinNow-C">
			<div class="button" onclick="location.href='quickregister/start'">
				<span class="text-big">{$greenTopText}</span>
				<span class="text-small">{$greenBottomText}</span>
				
			</div>
		</div>
		<div id="people-inside">
        <b><span><span class="stats-fig">{$stat_fig}</span> {$onlineBubbleText}</span></b>
        <i></i>
    </div>
    
	</div>
</div>

</body>
</html>
