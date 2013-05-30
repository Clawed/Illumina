<div id="container">
	<div id="content" style="position: relative" class="clearfix">
    <div>

<div class="content">
<div class="habblet-container" style="float:left; width:210px;">
<div class="cbb settings">

<h2 class="title">Account Settings</h2>
<div class="box-content">
            <div id="settingsNavigation">
            <ul>
				{if="selected == 'account-settings'"}
					<li class="selected">Basic Account Settings</li>
				{else}
					<li class=""><a href='{$www}/profile/basic_settings'>Basic Account Settings</a></li>
				{/if}
				
				{if="selected == 'pass-settings'"}
					<li class="selected">Account Password Settings</li>
				{else}
					<li class=""><a href='{$www}/profile/password'>Account Password Settings</a></li>
				{/if}
			</ul>
            </div>
</div></div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>