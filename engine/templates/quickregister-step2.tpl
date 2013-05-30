<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>{$shortname}: {$title}</title>

<script type="text/javascript">
var andSoItBegins = (new Date()).getTime();
</script>
<link rel="shortcut icon" href="{$www}/images/web-gallery/v2/favicon.ico" type="image/vnd.microsoft.icon" />
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
window.name = "d5df5be1edb6663e56ec7f8d61785bcf9c9bfb0b";
if (typeof HabboClient != "undefined") {
    HabboClient.windowName = "d5df5be1edb6663e56ec7f8d61785bcf9c9bfb0b";
    HabboClient.maximizeWindow = true;
}


</script>

<link rel="stylesheet" href="{$www}/images/web-gallery/static/styles/quickregister.css" type="text/css" />
<script src="{$www}/images/web-gallery/static/js/quickregister.js" type="text/javascript"></script>

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

<body id="client" class="background-accountdetails-male">
<div id="overlay"></div>
<img src="{$www}/images/web-gallery/v2/images/page_loader.gif" style="position:absolute; margin: -1500px;" />

<div id="stepnumbers">
    <div class="stepdone">Birthdate &amp; Gender</div>
    <div class="step2focus">Account details</div>
    <div class="step3">Security Check</div>
    <div class="stephabbo"></div>
</div>

<div id="main-container">

    {$errorSpace}

    <form method="post" action="{$www}/quickregister/email_password_submit" id="quickregister-form">

        <h2>Account details</h2>

      <div id="inner-container">
        <div class="inner-content bottom-border">
	        <div class="field">
               <label for="email-address2">Desired Username</label>
               <input type="text" id="email-address2" name="bean.username" value="" />
           </div>
           <div class="help">The name you'd like to use on our website and inside the hotel.</div>
            <div class="field">
                <label for="email-address">Email</label>
                <input type="text" id="email-address" name="bean.email" value="" />
            </div>
            <div class="help">You'll need to use this <b>email address to recover your account</b> if you ever lose the password.</div>
            <div class="field">
                <label for="email-address2">Re-enter Email</label>
                <input type="text" id="email-address2" name="bean.retypedEmail" value="" />
            </div>
            <div class="help">...just to be sure.</div>

            <div id="password-field" class="field">
                <label for="register-password">Password</label>
                <input type="password" name="bean.password" id="register-password" maxlength="32" value="" />
            </div>
            <div class="help">Password must be at least <b>6 characters </b>long and it is suggested to include <b>letters and numbers</b>.</div>
        </div>
        <div class="inner-content top-margin">
			<div class="field-content checkbox ">
			  <label>
			  <input type="checkbox" name="bean.termsOfServiceSelection" id="terms" value="true" class="checkbox-field"/>
			  I agree to speak English on {$shortname} and will respect the others around me.
			  </label>
			</div>            			
        </div>
      </div>
    </form>


    <div id="select">
        <div class="button">
            <a id="proceed-button" href="#" class="area">Next</a>
            <span class="close"></span>
        </div>
        <a href="{$www}/quickregister/back" id="back-link">Go Back</a>
   </div>
</div>

<script type="text/javascript">
    document.observe("dom:loaded", function() {
        Event.observe($("back-link"), "click", function() {
            Overlay.show(null,'Loading...');
        });
        Event.observe($("proceed-button"), "click", function() {
            Overlay.show(null,'Loading...');            
            $("quickregister-form").submit();
        });
            $("email-address").focus();
    });
</script>

<script type="text/javascript">
    HabboView.run();
</script>

</body>
</html>