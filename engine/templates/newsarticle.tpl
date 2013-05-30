<div class="habblet-container " style="float:left; width:550px;"> 
<div class="cbb clearfix notitle "> 


<div id="article-wrapper"> 

<h2>{$mainTitle}</h2> 

<div class="article-meta"> 
 
{$postedDate}
 
</div> 

 
<p class="summary"> 

{$newsSummary}

</p> 
 

<div class="article-body"> 
{$newsArticle}
</div> 

<script type="text/javascript" language="Javascript"> 
document.observe("dom:loaded", function() { 
$$('.article-images a').each(function(a) { 
Event.observe(a, 'click', function(e) { 
Event.stop(e); 
Overlay.lightbox(a.href, "Image is loading"); 
}); 
}); 

$$('a.article-177').each(function(a) { 
a.replace(a.innerHTML); 
}); 
}); 
</script> 
 

</div> 

</div> 
</div> 

<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>