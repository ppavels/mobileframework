<!DOCTYPE html>
<html lang="en">
    <head>

        <meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=1.0, user-scalable=no" />
        <?php //echo "<pre>". print_r($pagedata, TRUE). "</pre>"; exit;?>

        <?php echo $metadata->favicon; ?>
        <?php echo $metadata->description; ?>

        <?php /*if (defined('EARNIFY'))
            echo '<meta name="earnify-site-verification" content="'.EARNIFY.'" />';*/
        ?>

        <?php //echo $metadata->css; ?>

        <style>/*basic styles to help load more smoothly*/
            body {
                margin: 0;
                background: #ecf2f8;
                color: #6c87a5;
                font-size: 1em;
                line-height: 1.4;
            }
            header {background: #ec67a1;}
            #left-menu, .scroll_header { display: none; }
            #menu {
                display: block;
                float: left;
                background: url(/public/img/menu-button.png) no-repeat;
                background-size: contain;
                width: 40px;
                height: 40px;
            }
            .logo {
                width: 161px;
                height: 50px;
                display: block;
                margin: 0 auto;
                background-image: url(/public/img/logo_us.png);
                background-repeat: no-repeat;
                background-size: contain;
            }
            .white-block {
                -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px;
                box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box;
                width: 100%;
            }

            .index { max-width: 460px; margin: 0 auto; }
            .g-ads-index {background-color: #ecf2f8!important;}
            .index-centered-img {margin: 0 auto; }
            .date { font-size: 9px; color: #a9a9a9;}
            .primary-shares a{ display: inline-block; }
        </style>

        <?php // echo $pagedata->easterinit; ?>
        <?php // echo $pagedata->thanksinit; ?>
        <?php echo $pagedata->init; ?>


        <?php echo $metadata->title; ?>
        <?php echo $pagedata->google_analytics; ?>
        <?php echo $googleads->Init; ?>
        <?php /* echo $pagedata->signup_popup; */ ?> 
        <?php /* echo $pagedata->download_app_popup; */ ?>

        <?php if(defined('IOS_URL') && defined('IOS_APP_NAME') && defined('IOS_APP_STORE_ID')) { ?>
            <meta property="al:ios:url" content="<?php echo IOS_URL; ?>">
            <meta property="al:ios:app_name" content="<?php echo IOS_APP_NAME; ?>">
            <meta property="al:ios:app_store_id" content="<?php echo IOS_APP_STORE_ID; ?>">
        <?php } ?>

        <?php if(PROJECT_ID == 1 || PROJECT_ID == 6){  ?>
            <meta name="apple-itunes-app" content="app-id=1045978088, app-argument=https://geo.itunes.apple.com/us/app/freebies-womanfreebies.com/id1045978088?mt=8">
        <?php } ?>
        <?php if(defined('ANDROID_URL') && defined('ANDROID_PACKAGE') && defined('ANDROID_APP_NAME')) { ?>
            <meta property="al:android:url" content="<?php echo ANDROID_URL; ?>">
            <meta property="al:android:package" content="<?php echo ANDROID_PACKAGE; ?>">
            <meta property="al:android:app_name" content="<?php echo ANDROID_APP_NAME; ?>">
        <?php } ?>

        <meta property="og:title" content="<?php echo $pagedata->title; ?>" />
        <meta property="og:type" content="website" />
        <?php
         echo '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({
                        google_ad_client: "ca-pub-5393530392305555",
                        enable_page_level_ads: true
                        });
                </script>';
        ?>
        <?php if(PROJECT_ID == 1 || PROJECT_ID == 6){  ?>
        <!-- PLACE THIS CODE IN WEBSITE HEADER -->
        <!-- nativeads pixel 110309-womanfreebies.com start -->
        <script type="text/javascript" src="//cpanel.nativeads.com/js/pixel/pixel-110309-ab483a7fcec7da13c7a01fbd1e1dc89b5a587475.js"></script>
        <!-- nativeads pixel 110309-womanfreebies.com end -->
        <?php } ?>
    </head>
    <body>
        <!-- fb like -->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <?php echo $pagedata->menu; ?>

    <div id="content-wrapper"> <!-- closing tag is in the footer -->

            <!-- Header / start -->
            <header class="<?php echo $pagedata->headersingle; ?>">

                <a href="#" id="menu" class="ico"></a>
                <a href="<?php echo $pagedata->home; ?>" class="<?php echo $pagedata->logosingle; ?> logo <?php echo COUNTRY; ?>"></a>



                <?php echo $pagedata->whiteheader; ?>


            </header>
            <!-- Header / end -->