<div class="habblet-container" style="float:left; width: 560px;"> 
<div class="cbb clearfix settings"> 
 
<h2 class="title">Edit your {$shortname} Account</h2> 
<div class="box-content"> 
	<div style="align:left;">
	Welcome to your {$shortname} basic account settings page. From this page, you can toggle friend requests, your trading status
	or change your ingame motto.
	<br /> <br />
	<form method='post'>
		<strong>{$shortname} Motto</strong> <br /> <input type='text' name='Motto' maxlenth='32' value='{$motto}'> <br /><br />
		<input type='checkbox' name='FriendRequests' {$fr_checkvalues}> Friend Requests Enabled <br />
		<input type='checkbox' name='TradeStatus' {$trd_checkvalues}> Trading Enabled <br />
		<br />
		<input type='submit' name='SaveSettings' value='Update Account'>
	</form>
	</div>
</div> 

</div> 
</div> 
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>