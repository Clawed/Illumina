
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>{$shortname}: {$title}</title>
	
	<script type="text/javascript" src="{$www}/images/css/jquery.min.js"></script>
	<script type="text/javascript" src="{$www}/images/css/jquery.tweet.js"></script>
	
	<link href="{$www}/images/css/maintenance.css" rel="stylesheet" type="text/css" />
	
</head>
<body>

<h3>Visit our <a href='http://zapboards.com/'>forums</a> or <a href='http://babbo.org/'>Babbo Hotel</a> while you wait!</h3>
<div id="container">
	<div id="content">
		<div id="header" class="clearfix">
			<h1><span></span></h1>
		</div>
		<div id="process-content">

<div class="fireman">

<h1>Maintenance break!</h1>

<p>
Sorry! {$sitename} is being worked on at the moment.<br><br>
We'll be open soon. We promise.
<p>

</div>

<div class="tweet-container">

<h2>What's going on?</h2>

<div class="tweet"></div>

</div>

<div id="footer">
<div class="followbtn" style="text-align:right">
<a href="https://twitter.com/{$twitteraccount}" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @{$twitteraccount}</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
</div>

		</div>
	</div>
</div>

<script type='text/javascript'>
$(document).ready(function(){
  $(".tweet").tweet({
    username: "{$twitteraccount}",
    count: 10
  });
});
</script>

</body>
</html>
