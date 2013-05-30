{if="maintenance == 1"}
	<div style='color:red; font-size:15px;'>{$sitename} is currently in maintenance mode.</div>
{/if}
<style type="text/css">
body { background-image: url('{$www}/images/bg.png') !important; }
h1 a { height: 52px !important; width: 200px !important; background-image: url('{$www}/images/logo.png') !important; }
</style>

<body id="home" class=" ">
<div id="overlay"></div>


<div id="header-container">
	<div id="header" class="clearfix">
		<h1><a href="{$www}/"></a></h1>


  <div id="subnavi"> 
			<div id="subnavi-user"> 
							<ul>
					<li id="myfriends"><a href="#"><span></span></a><span class="r"></span></li> 
					<li id="mygroups"><a href="#"><span></span></a><span class="r"></span></li> 
					<li id="myrooms"><a href="#"><span></span></a><span class="r"></span></li> 
				</ul> 
						</div> 
			<div id="subnavi-search"> 
                <div id="subnavi-search-upper"> 
                <ul id="subnavi-search-links"> 
                    <li><a href="http://zapboards.com/" target="habbohelp" onclick="openOrFocusHelp(this); return false">Help</a></li> 
					<li><a href="{$www}/account/signout" class="userlink" id="signout">Sign Out</a></li> 
				</ul> 
                </div> 
            </div> 

    <div id="to-hotel">
                <a href="{$www}/client" class="new-button green-button" target="_blank"><b>Enter {$sitename}</b><i></i></a>
    </div>
</div>

<ul id="navi">
	{if="defined('MeSelected')"}
   	<li class="selected">
			<strong>
				{$Username}
			</strong>
			<span></span>
		</li>
	{else}
		<li>
			<a href="/me">{$Username}</a>
			<span></span>
		</li>
	{/if}
	
	{if="defined('CommunitySelected')"}
   	<li class="selected">
			<strong>
				Community
			</strong>
			<span></span>
		</li>
	{else}
		<li>
			<a href="/community">Community</a>
			<span></span>
		</li>
	{/if}
	{if="defined('VipSelected')"}
   	<li class="selected">
			<strong>
				Buy VIP today!
			</strong>
			<span></span>
		</li>
	{else}
		<li>
			<a href="/buyvip">Buy VIP today!</a>
			<span></span>
		</li>
	{/if}
	<li>
		<a href="https://facebook.com/{$facebook}" target="_blank">Facebook</a>
		<span></span>
	</li>

		{if="USER_RANK >= 6"}
			{if="defined('HkSelected')"}
			<li class="selected">
				<strong>Housekeeping</strong>
				<span></span>
			{else}
			<li>
				<a href="{$www}/admin/index.php?_page=dashboard" target="_blank">Housekeeping</a>
				<span></span>
			</li>
			{/if}
		{/if}
</ul>

        <div id="habbos-online"><div class="rounded"><span>{$users_online}</span></div></div>
	</div>
</div>