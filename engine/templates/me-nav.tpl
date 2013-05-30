<div id="content-container">

<div id="navi2-container" class="pngbg">
    <div id="navi2" class="pngbg clearfix">
	<ul>
		{if="defined('MeTabSelected')"}
			<li class="selected">
				Home
			</li>
		{else}
		<li class="">
			<a href="{$www}/me">Home</a>
		{/if}
		
		{if="defined('ProfileTabSelected')"}
		<li class="selected">
			Profile
		</li>
		{else}
		</li>
    		<li class="">
				<a href="{$www}/profile">Account Settings</a>
    		</li>
		{/if}
		
		{if="defined('UserProfileTabSelected')"}
		<li class="selected last">
			User Profiles
		</li>
		{else}
		</li>
    		<li class=" last">
				<a href="{$www}/user/{$username}">User Profiles</a> (Unread: {function="lightcms::getUnreadCount(USER_ID)"})
    		</li>
		{/if}
	</ul>
    </div>
</div>