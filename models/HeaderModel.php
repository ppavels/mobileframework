<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HeaderModel
 *
 * @author alekk
 */
class HeaderModel {

    //put your code here
            private $calldata, $post, $isVideo;

    public function __construct($PostCall = NULL) {
        $this->calldata = $PostCall;
        isset($this->calldata['post'][0]) ? $this->post = $this->calldata['post'][0] : $this->post = FALSE;
        if ($PostCall['post'][0]['is_video_post']==1){
            $this->isVideo=TRUE;
        }else{
            $this->isVideo=FALSE;
        }
    }

    public function init() {
        $output = '<script type="text/javascript">var ajax_url="' . AJAX_URL . '"</script>' . PHP_EOL;
        if(!$this->isVideo){
            if(PROJECT_ID==1){
                $output.= '<script src="//cdn.goroost.com/roostjs/88k9rtr4u6vw3k9qx5l6usit6vjel4dg" async></script>';
            }
        }
        return $output;
    }
	public function signup_popup(){
		
         /* $output = PHP_EOL."<script type='text/javascript'>
              var url = $(location).attr('href');
              if( !$.cookie('signup_cookie')){
		$(function ()
		{   
		    height = $(window).height();
                width = $(window).width();
                popupHeight = height * 0.8;
                popupWidth = width * 0.8;
                if (popupHeight < 420) {
                    popupHeight = 420;
                }
                if (popupWidth < 320) {
                    popupWidth = 320;
                }
			    var myPopup = $(this).speedoPopup({
				height: popupHeight,
                top:'center',
                width: popupWidth,
                theme: 'default',
                draggable:false,
                responsive:false,
                effectIn: 'slideBottom',
                effectOut: 'slideTop',
                css3Effects: 'none',
                autoShow:500,
                onClose: function () { 
                    ga('send', 'event', 'pop up', 'close window', url);
                    if( !$.cookie('signup_cookie'))  {
                $.cookie('signup_cookie', 1, { path    : '/', expires : 7 }); 
                    }
                },
				href: 'http://womanfreebies.com/signup/?view=popm&url=' + encodeURIComponent(url),
			});
			
			window.hidePopup = function ()
			{
				myPopup.hidePopup();
				return false;
			};
		});
                }
	</script> 
		
		
		
        <style>
            .speedo-container{ padding: 5px }
        </style>" . PHP_EOL; 
        return $output;*/
		return FALSE;
	}

    	public function download_app_popup(){
		//   
            $url=''
                    . '<div id="proposal">'
                    . '<div id="proposal_buttons">'
                    . '<a onclick=setCookies(); id="appstore" href="https://play.google.com/store/apps/details?id=com.womanfreebies">'
                    . '<img src="../img/redirectpage/button-available-on-the-app-store.png"></a>'
                    . '<a onclick=setCookies(); id="googleplay" href="https://play.google.com/store/apps/details?id=com.womanfreebies">'
                    . '<img src="../img/redirectpage/button-get-it-on-google-play.png"></a>'
                    . '<a href="javascript: void(0);" onclick=window.hidePopup();><p>SKIP AND USE MOBILE SITE</p></a></div></div>';
          $output = PHP_EOL."<script type='text/javascript'>
              var url = $(location).attr('href');
              
              function setCookies(){
                    days=30; // number of days to keep the cookie
                    myDate = new Date();
                    myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
                    document.cookie = 'android_cookie=1; expires=' + myDate.toGMTString();
            }
              if( !$.cookie('android_cookie')){
		$(function ()
		{   
		    height = $(window).height();
                width = $(window).width();
                popupHeight = height;
                popupWidth = width;
			    var myPopup = $(this).speedoPopup({
				height: popupHeight,
                top:'center',
                width: popupWidth,
                theme: 'default',
                draggable:false,
                responsive:false,
                effectIn: 'none',
                effectOut: 'none',
                css3Effects: 'none',
                autoShow:500,
                htmlContent: '".$url."',
                onClose: function () { 
                    ga('send', 'event', 'pop up', 'android download', url);
                    if( !$.cookie('android_cookie'))  {
                        $.cookie('android_cookie', 1, { path    : '/', expires : 7 });
                    }
                },
			
			});
			window.hidePopup = function ()
			{
				myPopup.hidePopup();
				return false;
			};
		});
                }
	</script> 
        <style>
            .speedo-container{ padding: 5px }
        </style>" . PHP_EOL; 
        return $output;
	}    
        
    public function hunt_init() {
        $hunt = new HuntModel();
        $session_envelope = $hunt->getSession();
        $output='';
	//	$output.='<script type="text/javascript">var popupwidth=294; var popupheight=286; var popuphref = "'.SITE_ROOT .'/thanksgiving/index-m.php"; var aj ="'.SITE_ROOT .'/thanksgiving/includes/classes/AJAX.php";</script>'. PHP_EOL;
	//	$output.='<script type="text/javascript" src="'.SITE_ROOT .'/thanksgiving/fb.js"></script>';
        $output.='<script type="text/javascript">' . PHP_EOL;
        $output.='var open_en_path="' . SITE_ROOT . '/thanksgiving/";
var envelope_id=' . $session_envelope . ';

if (window.attachEvent){
    window.attachEvent("onload", envelope_show);
}
else{
    window.addEventListener("load", envelope_show, false);
}
</script>'. PHP_EOL;
/*$output.='<script type="text/javascript">
var p='.TRAKING_ID.';var t=readc("__tueh");var r=readc("__trueh");if(t!=""){databaseImage=new Image;databaseImage.src="http://track.womanfreebies.com/tracking/g_track.php?p="+p+"&t="+t+"&r="+r}
function readc(e){var t=e+"=";var n=document.cookie.split(";");for(var r=0;r<n.length;r++){var e=n[r].trim();if(e.indexOf(t)==0)return e.substring(t.length,e.length)}return""}
</script>';*/
        return $output;
    }

    public function getwhiteheader() {
        if ($this->post) {
            ($this->post['post_share'] != 0) ? $share = '<b style="">' . $this->post['post_share'] . '</b>
                            <div class="caption" <span>SHARES</span></div>' : $share = '';
            $share_link = str_replace('http://', '//', $this->post['post_share_link']);
            $post_title = htmlspecialchars($this->post['post_title'], ENT_QUOTES);
            $post_img = $this->post['post_image']['570_300'];
        }

        $Social = new SocialButtons($this->post);
        $Social->use_like = true;

        $output = '<div class="scroll_header"><div class="header-shares">';
        $output .= '<a href="' . SITE_ROOT . '" class="logo_small ' . COUNTRY . '"></a>';

        ob_start();
        $Social->place_buttons('header',$share_link,$post_img,$post_title);
        $output .= ob_get_clean();

        $output .='</div></div>';

        return $output;
    }

    public function headerclass() {
        $output = 'header_single';
        return $output;
    }

    public function logoclass() {
        $output = 'logo_single';
        return $output;
    }

    public function googleAnalytics() {
		
		$output = 
"<script type='text/javascript'>
    window.google_analytics_uacct = ' " . GOOGLE_ACCOUNT . "';
</script>".PHP_EOL;

        $output .= 
                "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', ' " . GOOGLE_ACCOUNT . "', '".FOOTER_SITENAME."');
  ga('send', 'pageview');

</script>

";
        return $output; 
    }

}

?>
