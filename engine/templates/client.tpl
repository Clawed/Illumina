<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<title>{$shortname} -</title> 
 
<script type="text/javascript"> 
var andSoItBegins = (new Date()).getTime();
var ad_keywords = "";
document.habboLoggedIn = true;
var habboName = "Jonty";
var habboReqPath = "{$www}";
var habboStaticFilePath = "{$www}/images/web-gallery";
var habboImagerUrl = "https://www.habbo.nl/habbo-imaging/";
var habboPartner = "";
var habboDefaultClientPopupUrl = "https://zaphotel.net/client";
window.name = "habboMain";
if (typeof HabboClient != "undefined") { HabboClient.windowName = "uberClientWnd"; }
</script> 


<link rel="shortcut icon" href="{$www}/images/web-gallery/v2/favicon.ico" type="image/vnd.microsoft.icon" /> 
<script src="{$www}/images/web-gallery/static/js/libs2.js" type="text/javascript"></script>
<script src="{$www}/images/web-gallery/static/js/visual.js" type="text/javascript"></script>
<script src="{$www}/images/web-gallery/static/js/libs.js" type="text/javascript"></script>
<script src="{$www}/images/web-gallery/static/js/common.js" type="text/javascript"></script>
<script src="{$www}/images/web-gallery/static/js/fullcontent.js" type="text/javascript"></script>
<link rel="stylesheet" href="{$www}/images/web-gallery/styles/style.css" type="text/css" />
<link rel="stylesheet" href="{$www}/images/web-gallery/styles/buttons.css" type="text/css" />
<link rel="stylesheet" href="{$www}/images/web-gallery/styles/boxes.css" type="text/css" />
<link rel="stylesheet" href="{$www}/images/web-gallery/styles/tooltips.css" type="text/css" />
<link rel="stylesheet" href="{$www}/images/web-gallery/styles/habboclient.css" type="text/css" />
<link rel="stylesheet" href="{$www}/images/web-gallery/styles/habboflashclient.css" type="text/css" />
<script src="{$www}/images/web-gallery/static/js/habboflashclient.js" type="text/javascript"></script>

<meta name="description" content="{$shortname} is a virtual world where you can meet and make friends. Make friends, join the fun, get noticed!" /> 
<meta name="keywords" content="nillus, ragezone, retro, keep it real, private server, free, credits, habbo hotel , virtual, world, social network, free, community, avatar, chat, online, teen, roleplaying, join, social, groups, forums, safe, play, games, online, friends, teens, rares, rare furni, collecting, create, collect, connect, furni, furniture, pets , room design, sharing, expression, badges, hangout, music, celebrity, celebrity visits, celebrities, mmo, mmorpg, massively multiplayer" /> 
 
<!--[if IE 8]>
<link rel="stylesheet" href="{$www}/images/web-gallery/v2/styles/ie8.css" type="text/css" />
<![endif]--> 
<!--[if lt IE 8]>
<link rel="stylesheet" href="{$www}/images/web-gallery/v2/styles/ie.css" type="text/css" />
<![endif]--> 
<!--[if lt IE 7]>
<link rel="stylesheet" href="{$www}/images/web-gallery/v2/styles/ie6.css" type="text/css" />
<script src="{$www}/images/web-gallery/static/js/pngfix.js" type="text/javascript"></script>
<script type="text/javascript">
try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {}
</script>
 
<style type="text/css">
body { behavior: url(https://www.habbo.nl/js/csshover.htc); }
</style>
<![endif]--> 
<meta name="build" content="" /> 
</head>

<noscript>
    <meta http-equiv="refresh" content="0;url=/client/nojs" />
</noscript>

<script type="text/javascript">
    FlashExternalInterface.loginLogEnabled = false;
    
    FlashExternalInterface.logLoginStep("web.view.start");
    
    if (top == self) {
        FlashHabboClient.cacheCheck();
    }
	 var flashvars = {
	            "client.allow.cross.domain" : "1", 
	            "client.notify.cross.domain" : "0",
	            "connection.info.host" : "{$connection_info_host}",
				"connection.info.port" : "{$connection_info_port}",
	            "site.url" : "{$www}", 
	            "url.prefix" : "{$www}", 
	            "client.reload.url" : "{$www}/client", 
	            "client.fatal.error.url" : "{$www}/flash_client_error", 
	            "client.connection.failed.url" : "{$www}/flash_client_error", 
	            "external.variables.txt" : "{$variables}", 
	            "external.texts.txt" : "{$texts}",
	            "productdata.load.url" : "{$productdata}", 
	            "furnidata.load.url" : "{$furnidata}", 
	            "use.sso.ticket" : "1", 
	            "processlog.enabled" : "1",
	            "account_id" : "19927505",
	            "client.starting" : "{$loadingtext}",
	            "flash.client.url" : "{$www}/client",
				"sso.ticket" : "{$sso}",
	            "user.hash" : "199275052dbf5f89adb0a643bf16b0ea1cd646db", 
	            "flash.client.origin" : "popup",
	    };

    var params = {
        "base" : "{$baseurl}",
        "allowScriptAccess" : "always",
        "menu" : "false"                
    };
    
    if (!(HabbletLoader.needsFlashKbWorkaround())) {
    	params["wmode"] = "opaque";
    }
 
    var clientUrl = "{$habbo_swf}"; 
    swfobject.embedSWF(clientUrl, "flash-container", "100%", "100%", "10.0.0", "{$www}/images/web-gallery/flash/expressInstall.swf", flashvars, params);

    window.onbeforeunload = unloading;
    function unloading() {
        var clientObject;
        if (navigator.appName.indexOf("Microsoft") != -1) {
            clientObject = window["flash-container"];
        } else {
            clientObject = document["flash-container"];
        }
        try {
            clientObject.unloading();
        } catch (e) {}
    }
</script>

<meta name="description" content="Check into the world�s largest virtual hotel for FREE! Meet and make friends, play games, chat with others, create your avatar, design rooms and more�" />
<meta name="keywords" content="habbo hotel, virtual, world, social network, free, community, avatar, chat, online, teen, roleplaying, join, social, groups, forums, safe, play, games, online, friends, teens, rares, rare furni, collecting, create, collect, connect, furni, furniture, pets, room design, sharing, expression, badges, hangout, music, celebrity, celebrity visits, celebrities, mmo, mmorpg, massively multiplayer" />



<!--[if IE 8]>
<link rel="stylesheet" href="{$www}/images/web-gallery/v2/styles/ie8.css" type="text/css" />
<![endif]-->
<!--[if lt IE 8]>
<link rel="stylesheet" href="{$www}/images/web-gallery/v2/styles/ie.css" type="text/css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" href="{$www}/images/web-gallery/v2/styles/ie6.css" type="text/css" />
<script src="{$www}/images/web-gallery/static/js/pngfix.js" type="text/javascript"></script>
<script type="text/javascript">
try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {}
</script>

<style type="text/css">
body { behavior: url(/js/csshover.htc); }
</style>
<![endif]-->
<meta name="build" content="63-BUILD36 - 16.11.2010 11:51 - com" />
</head>

<body id="client" class="flashclient">
<div id="overlay"></div>
<img src="{$www}/images/web-gallery/v2/images/page_loader.gif" style="position:absolute; margin: -1500px;" />

<div id="overlay"></div>
<div id="client-ui" >
    <div id="flash-wrapper">
    <div id="flash-container">
        <div id="content" style="width: 400px; margin: 20px auto 0 auto; display: none">

<div class="cbb clearfix">
    <h2 class="title">Please update your Flash Player to the latest version.</h2>
    <div class="box-content">
            <p>You can install and download Adobe Flash Player here: <a href="https://get.adobe.com/flashplayer/">Install flash player</a>. More instructions for installation can be found here: <a href="https://www.adobe.com/products/flashplayer/productinfo/instructions/">More information</a></p>
            <p><a href="https://www.adobe.com/go/getflashplayer"><img src="{$www}/images/web-gallery/v2/images/client/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
    </div>
</div>

        </div>
        <script type="text/javascript">
            $('content').show();
        </script>
        <noscript>
            <div style="width: 400px; margin: 20px auto 0 auto; text-align: center">
                <p>If you are not automatically redirected, please <a href="/client/nojs">click here</a></p>
            </div>
        </noscript>
    </div>
    </div>
	<div id="content" class="client-content"></div>            
</div>
    <div style="display: none">

	<script language="JavaScript" type="text/javascript">
		setTimeout(function() {
			HabboCounter.init(600);
		}, 20000);
	</script>
    </div>
    <script type="text/javascript">
        RightClick.init("flash-wrapper", "flash-container");
        if (window.opener && window.opener != window && typeof window.opener.location.href != "undefined") {
            window.opener.location.replace(window.opener.location.href);
        }
        $(document.body).addClassName("js");
       	HabboClient.startPingListener();
    </script>

<script type="text/javascript">
    HabboView.run();
</script>

</body> 
</html>



