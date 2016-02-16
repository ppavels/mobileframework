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
class GoogleAds {

    //

    public function __construct() {
        ;
    }

    public function googleHeadeInit() {

        $output = "<script type='text/javascript'>
                  var googletag = googletag || {};
                  googletag.cmd = googletag.cmd || [];
                  (function() {
                  var gads = document.createElement('script');
                  gads.async = true;
                  gads.type = 'text/javascript';
                  var useSSL = 'https:' == document.location.protocol;
                  gads.src = (useSSL ? 'https:' : 'http:') + 
                  '//www.googletagservices.com/tag/js/gpt.js';
                  var node = document.getElementsByTagName('script')[0];
                  node.parentNode.insertBefore(gads, node);
              })();
             </script>
            <script type='text/javascript'>
            googletag.cmd.push(function() { ";
        for ($i = 0; $i < DFP_UNITS_NUMBER; $i++) {
            $output.="googletag.defineSlot('" . DFP_SLOT_NAME . "', [300, 250], 'div-gpt-ad-" . DFP_SLOT_NUMBER . "-" . $i . "').addService(googletag.pubads());";
            $output.=PHP_EOL;
            $output.="googletag.defineSlot('" . DFP_SLOT_2_NAME . "', [300, 250], 'div-gpt-ad-" . DFP_SLOT_2_NUMBER . "-" . $i . "').addService(googletag.pubads());";
            $output.=PHP_EOL;
			$output.="googletag.defineSlot('" . DFP_SLOT_3_NAME . "', [300, 250], 'div-gpt-ad-" . DFP_SLOT_3_NUMBER . "-" . $i . "').addService(googletag.pubads());";
            $output.=PHP_EOL;
        }

        $output.= "googletag.enableServices();
            });
        </script>";

        return $output;
    }

    public function googleFeedBoxR() {

        $pagenumber = preg_match('#page\/(\d+)#', $_SERVER['REQUEST_URI'], $mtch);
        if (empty($mtch)) {
            $c = 0;
        } else {
            $c = $mtch[1] - 1;
        }
 if ($c == 0) {

$output = "<div class='white-block g-ads-index addiv responsiveads' style='margin-top:8px;width: 100%;max-width:350px;  background-color:#fff;padding:4px'>
                <div style='margin:0 auto; width:auto' id='google-ads-1' class='addsponsored'>
 
<script type=\"text/javascript\"> 
 
    /* Calculate the width of available ad space */
    ad = document.getElementById('google-ads-1');
 
    if (ad.getBoundingClientRect().width) {
        adWidth = ad.getBoundingClientRect().width; // for modern browsers 
    } else {
        adWidth = ad.offsetWidth; // for old IE 
    }
 
    /* Replace ca-pub-XXX with your AdSense Publisher ID */ 
    google_ad_client = \"ca-pub-5393530392305555\";
 
    /* Replace 1234567890 with the AdSense Ad Slot ID */ 
    google_ad_slot = \"".FEED_SLOT_R1_NUMBER."\";
  
    /* Do not change anything after this line */
    if ( adWidth >= 728 )
      google_ad_size = [\"336\", \"280\"];  /* Leaderboard 728x90 */
    else if ( adWidth >= 468 )
      google_ad_size = [\"336\", \"280\"];  /* Banner (468 x 60) */
    else if ( adWidth >= 336 )
      google_ad_size = [\"336\", \"280\"]; /* Large Rectangle (336 x 280) */
    else if ( adWidth >= 300 )
      google_ad_size = [\"300\", \"250\"]; /* Medium Rectangle (300 x 250) */
    else if ( adWidth >= 250 )
      google_ad_size = [\"250\", \"250\"]; /* Square (250 x 250) */
    else if ( adWidth >= 200 )
      google_ad_size = [\"200\", \"200\"]; /* Small Square (200 x 200) */
    else if ( adWidth >= 180 )
      google_ad_size = [\"180\", \"150\"]; /* Small Rectangle (180 x 150) */
    else
      google_ad_size = [\"125\", \"125\"]; /* Button (125 x 125) */
 
    document.write (
     '<ins class=\"adsbygoogle\" style=\"display:inline-block;width:' 
      + google_ad_size[0] + 'px;height:' 
      + google_ad_size[1] + 'px\" data-ad-client=\"' 
      + google_ad_client + '\" data-ad-slot=\"' 
      + google_ad_slot + '\"></ins>'
    );
  
    (adsbygoogle = window.adsbygoogle || []).push({});
 
</script>
 
<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\">
</script></div></div>";  
     
           
          
        } else {
            $output = "<div class='white-block g-ads-index addiv' style='margin-top:8px;width: 100%;max-width:460px; height:170px;background-color:#fff;padding:4px'>
            <div style='margin:0 auto; width:300px; height: 255px' class='addsponsored'>
            <div id='div-gpt-ad-" . DFP_SLOT_NUMBER . "-" . $c . "'>
                <script type='text/javascript'>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-" . DFP_SLOT_NUMBER . "-" . $c . "'); });
               </script>
           </div></div>
          </div>";
        }
        return $output;
    }
	
	
	
public function googleFeedBoxR2() {

        $pagenumber = preg_match('#page\/(\d+)#', $_SERVER['REQUEST_URI'], $mtch);
        if (empty($mtch)) {
            $c = 0;
        } else {
            $c = $mtch[1] - 1;
        }
 if ($c == 0) {

$output = "<div class='white-block g-ads-index addiv responsiveads' style='margin-top:8px;width: 100%;max-width:350px;background-color:#fff;padding:4px'>
                <div style='margin:0 auto; width:auto' id='google-ads-2'  class='addsponsored'>
 
<script type=\"text/javascript\"> 
 
    /* Calculate the width of available ad space */
    ad = document.getElementById('google-ads-2');
 
    if (ad.getBoundingClientRect().width) {
        adWidth = ad.getBoundingClientRect().width; // for modern browsers 
    } else {
        adWidth = ad.offsetWidth; // for old IE 
    }
 
    /* Replace ca-pub-XXX with your AdSense Publisher ID */ 
    google_ad_client = \"ca-pub-5393530392305555\";
 
    /* Replace 1234567890 with the AdSense Ad Slot ID */ 
    google_ad_slot = \"".FEED_SLOT_R2_NUMBER."\";
  
    /* Do not change anything after this line */
    if ( adWidth >= 728 )
      google_ad_size = [\"336\", \"280\"];  /* Leaderboard 728x90 */
    else if ( adWidth >= 468 )
      google_ad_size = [\"336\", \"280\"];  /* Banner (468 x 60) */
    else if ( adWidth >= 336 )
      google_ad_size = [\"336\", \"280\"]; /* Large Rectangle (336 x 280) */
    else if ( adWidth >= 300 )
      google_ad_size = [\"300\", \"250\"]; /* Medium Rectangle (300 x 250) */
    else if ( adWidth >= 250 )
      google_ad_size = [\"250\", \"250\"]; /* Square (250 x 250) */
    else if ( adWidth >= 200 )
      google_ad_size = [\"200\", \"200\"]; /* Small Square (200 x 200) */
    else if ( adWidth >= 180 )
      google_ad_size = [\"180\", \"150\"]; /* Small Rectangle (180 x 150) */
    else
      google_ad_size = [\"125\", \"125\"]; /* Button (125 x 125) */
 
    document.write (
     '<ins class=\"adsbygoogle\" style=\"display:inline-block;width:' 
      + google_ad_size[0] + 'px;height:' 
      + google_ad_size[1] + 'px\" data-ad-client=\"' 
      + google_ad_client + '\" data-ad-slot=\"' 
      + google_ad_slot + '\"></ins>'
    );
  
    (adsbygoogle = window.adsbygoogle || []).push({});
 
</script>
 
<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\">
</script></div></div>";  
     
           
          
        } else {
            $output = "<div class='white-block g-ads-index' style='margin-top:8px;width: 100%;max-width:460px; height:170px;background-color:#fff;padding:4px'>
            <div style='margin:0 auto; width:300px; height: 255px' class='addsponsored'>
            <div id='div-gpt-ad-" . DFP_SLOT_2_NUMBER . "-" . $c . "'>
                <script type='text/javascript'>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-" . DFP_SLOT_2_NUMBER . "-" . $c . "'); });
               </script>
           </div></div>
          </div>";
        }
        return $output;
    }
	
	
	
	public function googleFeedBoxR3() {

        $pagenumber = preg_match('#page\/(\d+)#', $_SERVER['REQUEST_URI'], $mtch);
        if (empty($mtch)) {
            $c = 0;
        } else {
            $c = $mtch[1] - 1;
        }
 if ($c == 0) {

$output = "<div class='white-block g-ads-index addiv responsiveads' style='margin-top:8px;width: 100%;max-width:350px; background-color:#fff;padding:4px'>
                <div style='margin:0 auto; width:auto' id='google-ads-3' class='addsponsored'>
 
<script type=\"text/javascript\"> 
 
    /* Calculate the width of available ad space */
    ad = document.getElementById('google-ads-3');
 
    if (ad.getBoundingClientRect().width) {
        adWidth = ad.getBoundingClientRect().width; // for modern browsers 
    } else {
        adWidth = ad.offsetWidth; // for old IE 
    }
 
    /* Replace ca-pub-XXX with your AdSense Publisher ID */ 
    google_ad_client = \"ca-pub-5393530392305555\";
 
    /* Replace 1234567890 with the AdSense Ad Slot ID */ 
    google_ad_slot = \"".FEED_SLOT_R3_NUMBER."\";
  
    /* Do not change anything after this line */
    if ( adWidth >= 728 )
      google_ad_size = [\"336\", \"280\"];  /* Leaderboard 728x90 */
    else if ( adWidth >= 468 )
      google_ad_size = [\"336\", \"280\"];  /* Banner (468 x 60) */
    else if ( adWidth >= 336 )
      google_ad_size = [\"336\", \"280\"]; /* Large Rectangle (336 x 280) */
    else if ( adWidth >= 300 )
      google_ad_size = [\"300\", \"250\"]; /* Medium Rectangle (300 x 250) */
    else if ( adWidth >= 250 )
      google_ad_size = [\"250\", \"250\"]; /* Square (250 x 250) */
    else if ( adWidth >= 200 )
      google_ad_size = [\"200\", \"200\"]; /* Small Square (200 x 200) */
    else if ( adWidth >= 180 )
      google_ad_size = [\"180\", \"150\"]; /* Small Rectangle (180 x 150) */
    else
      google_ad_size = [\"125\", \"125\"]; /* Button (125 x 125) */
 
    document.write (
     '<ins class=\"adsbygoogle\" style=\"display:inline-block;width:' 
      + google_ad_size[0] + 'px;height:' 
      + google_ad_size[1] + 'px\" data-ad-client=\"' 
      + google_ad_client + '\" data-ad-slot=\"' 
      + google_ad_slot + '\"></ins>'
    );
  
    (adsbygoogle = window.adsbygoogle || []).push({});
 
</script>
 
<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\">
</script></div></div>";  
     
           
          
        } else {
            $output = "<div class='white-block g-ads-index' style='margin-top:8px;width: 100%;max-width:460px; height:170px;background-color:#fff;padding:4px'>
            <div style='margin:0 auto; width:300px; height: 255px' class='addsponsored'>
            <div id='div-gpt-ad-" . DFP_SLOT_3_NUMBER . "-" . $c . "'>
                <script type='text/javascript'>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-" . DFP_SLOT_3_NUMBER . "-" . $c . "'); });
               </script>
           </div></div>
          </div>";
        }
        return $output;
    }
	
	
	
	
	
	
	
	

    public function googleFeedBox2() {

        $pagenumber = preg_match('#page\/(\d+)#', $_SERVER['REQUEST_URI'], $mtch);
        if (empty($mtch)) {
            $c = 0;
        } else {
            $c = $mtch[1] - 1;
        }
        if ($c == 0) {

            $output = "<div class='white-block g-ads-index addiv' style='margin-top:8px; width: 100%;max-width:460px; height:170px;background-color:#fff;padding:4px'>
            <div style='margin:0 auto; width:300px; height: 255px' class='addsponsored'><script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>

<ins class='adsbygoogle'
     style='display:inline-block;width:300px;height:250px'
     data-ad-client='" . GOOGLE_AD_CLIENT . "'
     data-ad-slot='" . FEED_SLOT_2_NUMBER . "'></ins>
<script>
try {
(adsbygoogle = window.adsbygoogle || []).push({});
} catch (err) {}
</script>
</div></div>";
        } else {
            $output = "<div class='white-block g-ads-index' style='margin-top:8px;width: 100%;max-width:460px; height:170px;background-color:#fff;padding:4px'>
            <div style='margin:0 auto; width:300px'>
            <div id='div-gpt-ad-" . DFP_SLOT_2_NUMBER . "-" . $c . "'>
                <script type='text/javascript'>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-" . DFP_SLOT_2_NUMBER . "-" . $c . "'); });
               </script>
           </div></div>
          </div>";
        }
        return $output;
    }
	
	
	
	

    public function pushInFooter() {
        $output = "".PHP_EOL;
        for ($i = 0; $i < DFP_UNITS_NUMBER; $i++) {
            $output.="googletag.cmd.push(function() { googletag.display('div-gpt-ad-" . DFP_SLOT_NUMBER . "-" . $i . "'); });" . PHP_EOL;
            $output.="googletag.cmd.push(function() { googletag.display('div-gpt-ad-" . DFP_SLOT_2_NUMBER . "-" . $i . "'); });" . PHP_EOL;
			$output.="googletag.cmd.push(function() { googletag.display('div-gpt-ad-" . DFP_SLOT_3_NUMBER . "-" . $i . "'); });" . PHP_EOL;
        }
        $output.="try {
(adsbygoogle = window.adsbygoogle || []).push({});
} catch (err) {}";
        return $output;
    }

    public function singleHeaderUnit() {
        $output = '<div class="g-ads-move addiv" style="background-color:#fff; width: 320px;height: 50px;margin: 0 auto;margin-bottom: 5px;position:fixed;left: 50%;margin-left: -160px;top:50px">
<div class="ad relative" id="sharebox-wrapper"  >
<div id="google_ads_top" class="addsponsored">
<script type="text/javascript">
google_ad_client = "' . GOOGLE_AD_CLIENT . '";
/* WomanFreebies-mobile-header */
google_ad_slot = "4893612801";
google_ad_width = 320;
google_ad_height = 50;
//

</script><script type="text/javascript" src="//pagead2.googlesyndication.com/pagead/show_ads.js" >
</script>
</div>
</div>
</div>';
        return $output;
    }

    public function singleAfterPost() {

        $rand = mt_rand(1, 3);
        switch ($rand) {
            case 1:
                return $this->singleAfterPostFirst();
                break;
            case 2:
                return $this->singleAfterPostSecond();
				
                break;
            case 3:
                return $this->singleAfterPostThirdSmall();
                break;
            default:
                break;
        }
    }

    public function singleAfterPostFirst() {
        $output = '<div class="g-ads-move addiv" style="background-color:' . SINGLE_COLOR_FIRST_BG . ';height:106px; width:100%; position:fixed;bottom:0;margin-left: -8px;padding-left: 10px;">
            <center class="g-ads-move addsponsored" style="width:320px;height:106px;margin: 0 auto;"> 
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px;"
     data-ad-client="' . GOOGLE_AD_CLIENT . '"
     data-ad-slot="' . SINGLE_COLOR_FIRST_SLOT . '"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>
</div>';
        return $output;
    }

    public function singleAfterPostSecond() {
        $output = '<div class="g-ads-move addiv" style="background-color:' . SINGLE_COLOR_SECOND_BG . ';height:106px; width:100%; position:fixed;bottom:0;margin-left: -8px;padding-left: 10px;">
            <center class="g-ads-move addsponsored" style="width:320px;height:106px;margin: 0 auto;">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- WFus - Post Page - Mobile - Blue -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px;"
     data-ad-client="' . GOOGLE_AD_CLIENT . '"
     data-ad-slot="' . SINGLE_COLOR_SECOND_SLOT . '"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>
</div>';
        return $output;
    }

    public function singleAfterPostThird() {
        $output = '<div class="g-ads-move addiv" style="background-color:' . SINGLE_COLOR_THIRD_BG . ';height:106px; width:100%; position:fixed;bottom:0;margin-left: -8px;padding-left: 10px;">
            <center class="g-ads-move addsponsored" style="width:320px;height:106px;margin: 0 auto;">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- WFus - Post Page - Mobile - Yellow -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px;"
     data-ad-client="' . GOOGLE_AD_CLIENT . '"
     data-ad-slot="' . SINGLE_COLOR_THIRD_SLOT . '"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>
</div>';
        return $output;
    }
	
	
	    public function singleAfterPostThirdSmall() {
        $output = '<div class="g-ads-move addiv" style="background-color:' . SINGLE_COLOR_THIRD_BG_SMALL. ';height:50px; width:100%; position:fixed;bottom:0;margin-left: -8px;padding-left: 10px;">
            <center class="g-ads-move addsponsored" style="width:320px;height:50px;margin: 0 auto;">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:50px;"
     data-ad-client="' . GOOGLE_AD_CLIENT . '"
     data-ad-slot="' . SINGLE_COLOR_THIRD_SLOT_SMALL . '"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>
</div>';
        return $output;
    }

    public function singleHeaderSmall() {
        $output = '<div class="addsponsored g-ads-move addiv" style=" width: 320px;height: 53px;margin: 0 auto;margin-bottom: 5px;left: 50%;top:50px">
<div id="google_ads_top" class="">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- wfUS - Mobile Header - 2 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:50px"
     data-ad-client="' . GOOGLE_AD_CLIENT . '"
     data-ad-slot="'.SINGLE_COLOR_HEADER_SMALL.'"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
</div>';
        return $output;
    }

        public function googleSingleAfterPost() {
        $output = "<div class='g-ads-index addiv' style='margin-top:8px; width: 100%;max-width:460px; height:260px;background-color:#fff;padding:4px'>
            <div style='margin:0 auto; width:300px'><script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
<!-- WF - Blog - Mobile - 300x250 -->
<ins class='adsbygoogle'
     style='display:inline-block;width:300px;height:250px'
     data-ad-client=" . GOOGLE_AD_CLIENT . "
     data-ad-slot=" . SINGLE_AFTER_POST . "></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div></div>";

        return $output;
    }
	
	 public function googleSingleAfterPostR() {
       $output = "<div class='g-ads-index addiv responsiveads-single' style='margin-top:8px;width: 100%;max-width:350px; margin-bottom:130px;background-color:#fff;padding:4px'>
                <div style='margin:0 auto ; width:auto' id='google-ads-sinlge' class='addsponsored'> 
 
<script type=\"text/javascript\"> 
 
    /* Calculate the width of available ad space */
    ad = document.getElementById('google-ads-sinlge');
 
    if (ad.getBoundingClientRect().width) {
        adWidth = ad.getBoundingClientRect().width; // for modern browsers 
    } else {
        adWidth = ad.offsetWidth; // for old IE 
    }
 
   
    google_ad_client = \"ca-pub-5393530392305555\";
 
   
    google_ad_slot = \"".SINGLE_AFTER_POST_R."\";
  
    /* Do not change anything after this line */ 
    if ( adWidth >= 728 )
      google_ad_size = [\"336\", \"280\"];  /* Leaderboard 728x90 */
    else if ( adWidth >= 468 )
      google_ad_size = [\"336\", \"280\"];  /* Banner (468 x 60) */
    else if ( adWidth >= 336 )
      google_ad_size = [\"336\", \"280\"]; /* Large Rectangle (336 x 280) */
    else if ( adWidth >= 300 )
      google_ad_size = [\"300\", \"250\"]; /* Medium Rectangle (300 x 250) */
    else if ( adWidth >= 250 )
      google_ad_size = [\"250\", \"250\"]; /* Square (250 x 250) */
    else if ( adWidth >= 200 )
      google_ad_size = [\"200\", \"200\"]; /* Small Square (200 x 200) */
    else if ( adWidth >= 180 )
      google_ad_size = [\"180\", \"150\"]; /* Small Rectangle (180 x 150) */
    else
      google_ad_size = [\"125\", \"125\"]; /* Button (125 x 125) */
 
    document.write (
     '<ins class=\"adsbygoogle\" style=\"display:inline-block;width:' 
      + google_ad_size[0] + 'px;height:' 
      + google_ad_size[1] + 'px\" data-ad-client=\"' 
      + google_ad_client + '\" data-ad-slot=\"' 
      + google_ad_slot + '\"></ins>'
    );
   
    (adsbygoogle = window.adsbygoogle || []).push({});  
 
</script>
 
<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\">
</script></div></div>"; 

        return $output;
    }

}

?>