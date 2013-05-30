<div class="habblet-container" style="float:left; width: 560px;"> 
<div class="cbb clearfix settings"> 
 
<h2 class="title">Edit your {$shortname} Password</h2> 
<div class="box-content"> 
	<div style="align:left;">
		Welcome to your Password settings page. You can change the password to your account here. You will need to enter your current password to verify.
		<br /> <br />
		{$errorSpace} {$successSpace}
		<form method='post'>
			<strong>Current Password</strong> <br />
			<input type='password' maxlength='32' name='CurrentPass'> <br />
			<br />
			<strong>New Password</strong> <br />
			<input type='password' maxlength='32' name='NewPass'> <br />
			<br />
			<strong>Verify New Password</strong> <br />
			<input type='password' maxlength='32' name='VerifyPass'> <br />
			<br />
			<input type='submit' name='UpdatePassword' value='Update Password'>
		</form>
	</div>
</div> 

</div> 
</div> 
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>