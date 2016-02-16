<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GoogleAds
 *
 * @author alekk
 */
class CommercialAds {

    public function __construct() {
    }

    public function ShowCommercialAds($postPermalink = NULL) {
    $output = '';
    $link = $postPermalink->{'0'}->post_share_link;
    if (PROJECT_ID==3){
        $output .= '<div style="max-width: 460px;margin: 0 auto;margin-bottom: 90px;margin-top: -80px">';
        $output .= '<div class="earnify-widget" data-widget-id="426"></div>';
        $output .= '</div>';
    }

    if (PROJECT_ID==1){
        if ($postPermalink->{0}->is_video_post!=1&&1==2){
            $output .= '<div style="max-width: 460px;margin: 0 auto;margin-bottom: 100px;margin-top: -80px">';
            $output .= '<div id="ld-4597-4491"></div><script>(function(w,d,s,i){w.ldAdInit=w.ldAdInit||[];w.ldAdInit.push({slot:8113833910874727,size:[0, 0],id:"ld-4597-4491"});if(!d.getElementById(i)){var j=d.createElement(s),p=d.getElementsByTagName(s)[0];j.async=true;j.src="//cdn2.lockerdome.com/_js/ajs.js";j.id=i;p.parentNode.insertBefore(j,p);}})(window,document,"script","ld-ajs");</script>';
            $output .= '</div>';

        }else{
        $output .= '<div style="max-width: 460px;margin: 0 auto;margin-bottom: 100px;margin-top: -80px">';
        $show = rand(1,3);
        switch ($show){
            case 1:
                $output .= '<div id="rcjsload_dc0e92"></div>
                            <script type="text/javascript">
                            (function() {
                            var rcel = document.createElement("script");
                            rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                            rcel.type = \'text/javascript\';
                            rcel.src = "https://trends.revcontent.com/serve.js.php?w=10578&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                            rcel.async = true;
                            var rcds = document.getElementById("rcjsload_dc0e92"); rcds.appendChild(rcel);})();
                            </script>';
                break;
            case 2:
                $output .= '<div id="rcjsload_52be56"></div>
                            <script type="text/javascript">
                            (function() {
                            var rcel = document.createElement("script");
                            rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                            rcel.type = \'text/javascript\';
                            rcel.src = "https://trends.revcontent.com/serve.js.php?w=10576&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                            rcel.async = true;
                            var rcds = document.getElementById("rcjsload_52be56"); rcds.appendChild(rcel);})();
                            </script>';
                break;
            case 3:
                $output .= '<div class="earnify-widget" data-widget-id="632"></div>';
                break;
        }
        $output .= '</div>';
        }
    }
            return $output;
        }

}