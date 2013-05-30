<div id="content-container">

<div id="navi2-container" class="pngbg">
    <div id="navi2" class="pngbg clearfix">
	<ul>
		{if="defined('CommunityTabSelected')"}
		<li class="selected">
			Community
		</li>
		{else}
		<li class="">
			<a href='{$www}/community'>Community</a>
		</li>
		{/if}	
		{if="defined('ArticleTabSelected')"}
		<li class="selected">
			News Articles
		</li>
		{else}
		<li class="">
		<a href='{$www}/articles'>News Articles</a>
		</li>
		{/if}
		{if="defined('BadgeShopSelected')"}
		<li class="selected">
			Badge Shop
		</li>
		{else}
		<li class="">
		<a href='{$www}/community/badgeshop'>Badge Shop</a>
		</li>
		{/if}
		{if="defined('StaffPageSelected')"}
		<li class="selected last">
			Zap Staff
		</li>
		{else}
		<li class="last">
		<a href='{$www}/community/staff'>Zap Staff</a>
		</li>
		{/if}
	</ul>
    </div>
</div>

<div id="container">
	<div id="content" style="position: relative" class="clearfix">