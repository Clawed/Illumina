<script type="text/javascript" src="{$www}/engine/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
tinyMCE.init({
        mode : "textareas",
		theme : "simple"
});
</script>

<div class="habblet-container"> 
<div class="cbb clearfix blue"> 
 
<h2 class="title">Page Comments</h2> 
<div class="box-content"> 
	<div style="align:left;">
		{function="lightcms::getWallComments(_pageId)"}
	</div>
</div> 

</div> 
</div>
<div class="habblet-container"> 
<div class="cbb clearfix notitle">
<div class="box-content"> 
		<form method='post'>
			<center>
			<textarea name="_fullMessage" cols="50" rows="15"></textarea>
			</center>
			<br />
			<div align='right'>
				<input type='submit' name='_commentSubmit' value='Post comment'>
			</div>
		</form>
</div> 

</div> 
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>