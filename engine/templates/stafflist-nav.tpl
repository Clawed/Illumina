<div class="habblet-container"> 
<div class="cbb clearfix green"> 
 
<h2 class="title">Navigator</h2> 
<div class="box-content"> 
	<div style="align:left;">
	Please select which rank you would like to view... <br />
	<br />
	{if="selected == 'staff-founders'"}
	- Heisenberg (Founders) <br />
	{else}
	- <a href='{$www}/community/founders'>Heisenberg (Founders)</a> <br />
	{/if}
	{if="selected == 'staff-sadmins'"}
	- Senior Administrators (Managers) <br />
	{else}
	- <a href='{$www}/community/sadmins'>Senior Administrators (Managers)</a> <br />
	{/if}
	{if="selected == 'staff-admins'"}
	- Administrators <br />
	{else}
	- <a href='{$www}/community/admins'>Administrators</a> <br />
	{/if}
	{if="selected == 'staff-moderators'"}
	- Moderators <br />
	{else}
	- <a href='{$www}/community/mods'>Moderators</a> <br />
	{/if}
	</div>
</div> 

</div> 
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>