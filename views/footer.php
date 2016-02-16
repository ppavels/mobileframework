</div>  <!-- div id="content-wrapper" -->
<?php
require_once __DIR__ .'/'. 'compress_timestamp.php';
if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && stripos($_SERVER['HTTP_ACCEPT_ENCODING'],'GZIP')!==false)
    $gz='gz';
else
    $gz=null;
echo '<link rel="stylesheet" type="text/css" href="/public/min/css_schedule.css'.$gz.'" />',PHP_EOL;
?>
<div id="page-footer">
    <?php 
    if (PROJECT_ID==1) { 
        echo '<!-- Start Alexa Certify Javascript -->
                    <script type="text/javascript">
                    _atrk_opts = { atrk_acct:"lr3Gj1acJf00wZ",
                    domain:"womanfreebies.com",dynamic: true};
                    (function() { var as = document.createElement(\'script\'); as.type =
                    \'text/javascript\'; as.async = true; as.src =
                    "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s =
                    document.getElementsByTagName(\'script\')[0];s.parentNode.insertBefore(as,
                    s); })();
                    </script>
                    <noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=lr3Gj1acJf00wZ"
                    style="display:none" height="1" width="1" alt="" /></noscript>
                    <!-- End Alexa Certify Javascript -->';
        } ?>
    <?php 
        echo '<!-- Quantcast Tag -->
                <script type="text/javascript">
                var _qevents = _qevents || [];

                (function() {
                var elem = document.createElement(\'script\');
                elem.src = (document.location.protocol == "https:" ? "https://secure"
                : "http://edge") + ".quantserve.com/quant.js";
                elem.async = true;
                elem.type = "text/javascript";
                var scpt = document.getElementsByTagName(\'script\')[0];
                scpt.parentNode.insertBefore(elem, scpt);
                })();

                _qevents.push({
                qacct:"p-bdlE9V19Z_ZBk"
                });
                </script>

                <noscript>
                <div style="display:none;">
                <img src="//pixel.quantserve.com/pixel/p-bdlE9V19Z_ZBk.gif" border="0"
                height="1" width="1" alt="Quantcast"/>
                </div>
                </noscript>
                <!-- End Quantcast tag -->';
         ?>
</div>
<?php
if(defined('FB_PIXEL')){
    echo FB_PIXEL;
}
?>
<?php /* if (PROJECT_ID==3)
    echo '<script type="text/javascript"> var a = document.createElement("script");
            var b = document.getElementsByTagName("script")[0]; a.async = 1; a.src = "//cdn.earnify.com/widget.min.js";
            b.parentNode.insertBefore(a, b);</script>';
*/ ?>
<?php /* if (PROJECT_ID==1)
    echo '<script type="text/javascript">
                var a = document.createElement("script");
                var b = document.getElementsByTagName("script")[0];
                a.async = 1;
                a.src = "//cdn.earnify.com/widget.min.js";
                b.parentNode.insertBefore(a, b);
            </script>';
*/ ?>
<?php if(isset($pagedata->footerinit)) echo $pagedata->footerinit; ?>
</body>
<?php
require __DIR__ .'/'. 'compress_timestamp.php';
if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && stripos($_SERVER['HTTP_ACCEPT_ENCODING'],'GZIP')!==false)
    $gz='gz';
else
    $gz=null;
echo '<script src="'.SITE_ROOT . '/public/min/js_schedule.js'.$gz.'" ></script>',PHP_EOL; ?>
<script>
    $('<script>').attr({
        type: 'text/javascript',
        async: 'async',
        src: 'https://widgets.outbrain.com/outbrain.js'
    }).appendTo('#append1');
</script>
<script>
    $('<script>').attr({
        type: 'text/javascript',
        async: 'async',
        src: 'https://widgets.outbrain.com/outbrain.js'
    }).appendTo('#append2');
</script>
<?php //echo $metadata->js; ?>
<?php if(isset($pagedata->srollInit)) echo $pagedata->srollInit; ?>
</html>