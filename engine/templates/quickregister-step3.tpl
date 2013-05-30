
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>{$sitename}</title>

<script type="text/javascript">
var andSoItBegins = (new Date()).getTime();
</script>
<link rel="shortcut icon" href="http://www.habbo.com{$www}/images/web-gallery/v2/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="alternate" type="application/rss+xml" title="Habbo Hotel - RSS" href="http://www.habbo.com/articles/rss.xml" />
<meta name="csrf-token" content="36daa1d7bc"/>
<link rel="stylesheet" href="{$www}/images/web-gallery/static/styles/common.css" type="text/css" />
<script src="{$www}/images/web-gallery/static/js/libs2.js" type="text/javascript"></script>
<script src="{$www}/images/web-gallery/static/js/visual.js" type="text/javascript"></script>
<script src="{$www}/images/web-gallery/static/js/libs.js" type="text/javascript"></script>
<script src="{$www}/images/web-gallery/static/js/common.js" type="text/javascript"></script>


<script type="text/javascript">
var ad_keywords = "";
var ad_key_value = "";
</script>
<script type="text/javascript">
document.habboLoggedIn = false;
var habboName = null;
var habboId = null;
var habboReqPath = "";
var habboStaticFilePath = "{$www}/images/web-gallery";
var habboImagerUrl = "http://www.habbo.com/habbo-imaging/";
var habboPartner = "";
var habboDefaultClientPopupUrl = "http://www.habbo.com/client";
window.name = "09fae784fe83f8e552caa9a07f5b7d25184015ae";
if (typeof HabboClient != "undefined") {
    HabboClient.windowName = "09fae784fe83f8e552caa9a07f5b7d25184015ae";
    HabboClient.maximizeWindow = true;
}


</script>

<link rel="stylesheet" href="{$www}/images/web-gallery/static/styles/quickregister.css" type="text/css" />
<script src="{$www}/images/web-gallery/static/js/quickregister.js" type="text/javascript"></script>
<script type="text/javascript" src="https://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>

<!--[if IE 8]>
<link rel="stylesheet" href="{$www}/images/web-gallery/static/styles/ie8.css" type="text/css" />
<![endif]-->
<!--[if lt IE 8]>
<link rel="stylesheet" href="{$www}/images/web-gallery/static/styles/ie.css" type="text/css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" href="{$www}/images/web-gallery/static/styles/ie6.css" type="text/css" />
<script src="{$www}/images/web-gallery/static/js/pngfix.js" type="text/javascript"></script>
<script type="text/javascript">
try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {}
</script>

<style type="text/css">
body { behavior: url(/js/csshover.htc); }
</style>
<![endif]-->
</head>

<body id="client" class="background-captcha">
<div id="overlay"></div>
<img src="{$www}/images/web-gallery/v2/images/page_loader.gif" style="position:absolute; margin: -1500px;" />

<div id="stepnumbers">
    <div class="stepdone">Birthdate &amp; Gender</div>
    <div class="stepdone">Account details</div>
    <div class="step3focus">Security Check</div>
    <div class="stephabbo"></div>
</div>

<div id="main-container">

    {$errorSpace}

    <h2>Step into the Hotel</h2>

    <div id="captcha-container">
        <h3>Just one quick security thingie before we go:</h3>
        <div id="captcha-image-container">
          {$captcha}
        </div>
    </div>

    <div class="delimiter_smooth">
        <div class="flat">&nbsp;</div>
        <div class="arrow">&nbsp;</div>
        <div class="flat">&nbsp;</div>
    </div>

    <div id="inner-container">
        <form id="captcha-form" method="post" action="{$www}/quickregister/captcha_submit" onsubmit="Overlay.show(null,'Loading...');">
            <div id="recaptcha-input-title">Please type in the numbers shown above</div>
            <div id="recaptcha-input">
                <input type="text" tabindex="2" name="captchaResponse" id="recaptcha_response_field">
            </div>
                <input type="hidden" id="avatarFigure" name="bean.figure" value=""/>
        </form>
    </div>

    <div id="select">
        <a href="{$www}/quickregister/start" id="back-link">Go Back</a>
        <div class="button">
            <a id="proceed-button" href="#" class="area">Done</a>
            <span class="close"></span>
        </div>
   </div>

    <script type="text/javascript">
            if($("proceed-button")) {
                $("proceed-button").observe("click", function(e) {
                    Event.stop(e);
                    Overlay.show(null,'Loading...');
                    $("captcha-form").submit();
                });

                Event.observe($("back-link"), "click", function() {
                    Overlay.show(null,'Loading...');
                });
            }
    </script>

</div>

<script type="text/javascript">
    HabboView.run();
</script>

</body>
</html>