<div id="container">
	<div id="content" style="position: relative" class="clearfix">

    <div id="wide-personal-info">

    <div id="habbo-plate">
            <a href="{$www}/profile">
            <img alt="{$Username}" src="{$www}/avatar.php?figure={$Look}&gesture=sml&size=m"/>
        </a>
    </div>

    <div id="name-box" class="info-box">
        <div class="label">Name:</div>
        <div class="content">{$Username}</div>
    </div>
    <div id="motto-box" class="info-box">
        <div class="label">Motto:</div>
        <div class="content">{$Motto} - <a href='{$www}/profile/basic_settings'>Change</a></div>
    </div>
    <div id="last-logged-in-box" class="info-box">
        <div class="label">Account balance</div>
        <div class="content"> {$Credits} coins & {$Pixels} pixels</div>
    </div>

<div class="enter-hotel-btn">
    <div class="open enter-btn">
            <a href="{$www}/client" target="eaac8f36e6e5ed7892d37b2ea32c4108c6719407" onclick="HabboClient.openOrFocus(this); return false;">Enter {$sitename}<i></i></a>
        <b></b>
    </div>
</div>

</div>
