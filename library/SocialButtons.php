<?php

/**
 * Outputs
 */
class SocialButtons {
    private $post, $post_share_link, $shares, $imagefolder, $like_url, $title, $image;
    public $use_like = 0;

    public function __construct($post=0) {
        if (defined('VIRAL_VIDEO')){
            $this->like_url = VIRAL_VIDEO;
        }else{
            $this->like_url = defined('FB_LIKE_URL') ? FB_LIKE_URL : 0;
        }

        if(is_string($post)) {
            //category
            $this->get_like_cat($post);
        }elseif($post) {
            //single page
            $this->post = $post;
            if (is_array($post)) {
                $this->post_share_link = $post['post_share_link'];
                $this->shares = 0;
                $this->title = $post['post_title'];
                if(isset($post['post_image']['large']['mdpi']) && $post['post_image']['large']['mdpi'] != '') {
                    $this->image = $post['post_image']['large']['mdpi'];
                }else {
                    $this->image = 'http://storage.googleapis.com/assets-libs/images/us/loading-us.jpg';
                }
            } else {
                $this->post_share_link = $post->post_share_link;
                $this->shares = $post->shares;
                $this->image = $this->post->image;
                $this->title = $this->post->title;
            }
        }

        $this->imagefolder = IMAGE_FOLDER;
    }

    function get_like_cat($cat=false){
        if(PROJECT_ID != 1) return;

        if($cat == 'sweepstakes' || strstr($this->post_share_link,'sweepstakes')){
            $this->like_url = 'https://www.facebook.com/Sweepstakes.Contests?sk=app_485285721506283';
        }elseif($cat == 'free-samples' || strstr($this->post_share_link,'free-samples')){
            $this->like_url = 'https://www.facebook.com/pages/Free-Samples/129355923896262?sk=app_390619870974470';
        }elseif($cat == 'coupons' || strstr($this->post_share_link,'coupons')){
            $this->like_url = 'https://www.facebook.com/pages/Coupons/141563452658890?sk=app_403806799704506';
        }elseif($cat == 'rewards' || strstr($this->post_share_link,'rewards')){
            $this->like_url = 'https://www.facebook.com/pages/Rewards/483927624992279?sk=app_353100728131270';
        }elseif($cat == 'videos' || strstr($this->post_share_link,'videos')) {
            $this->like_url = 'https://www.facebook.com/ViralVideosUS';
        }else{
            $this->like_url = defined('FB_LIKE_URL') ? FB_LIKE_URL : 0;
        }
    }

    function like_header(){
            return '<div class="scroll_header"><div class="header-shares"><a href="' . SITE_ROOT . '" class="logo_small ' . COUNTRY . '"></a><div class="share-box">'.$this->like_button().'</div></div></div>';
    }

    function like_button(){
        if ($this->like_url) {
            return '<div class="fb-like" data-href="' . $this->like_url . '" data-layout="button" data-action="like" data-show-faces="false" data-share="false" style="margin: 9px 10px 9px 0; vertical-align: top; display: inline-block;"></div>';
        }
    }

    function sharecount(){
        if ($this->shares == 0) {
            echo '<b class="empty">Share me</b>';
        } else {
            echo '<b>' . $this->shares . '</b>
                        <span class="caption">SHARES</span>';
        }
    }

    function place_buttons($pos='top',$link=0,$img=0,$title=0){
        $link = !$link?$this->post_share_link:$link;
        $img = !$img?$this->image:$img;
        $title = !$title?$this->title:$title;
        $position = 'share'.$pos.'_m';
        $delim = preg_match('/iPhone/',$_SERVER['HTTP_USER_AGENT']) ? '&' : '?';
        ?>
        <div class="share-box">
            <?php if($this->use_like){
                $this->get_like_cat();
                echo $this->like_button();
            } ?>
            <a class="share-button facebook popup ga_index" rel="facebook" href="//www.facebook.com/sharer.php?u=<?php echo $link; ?>?socialshare=fb<?php echo $position; ?>">Facebook</a>

            <a class="share-button pinterest popup ga_index" rel="pinterest" href="//www.pinterest.com/pin/create/unknown/?url=<?php echo $link; ?>?socialshare=pinterest<?php echo $position; ?>&media=<?php echo $img; ?>&description=<?php echo $title; ?>">Pinterest</a>

            <a class="share-button mail ga_index" rel="email" href="mailto:?subject=<?php echo $title; ?>&body=Please check this: <?php echo $link; ?>?socialshare=email<?php echo $position; ?>">Email</a>

            <a class="share-button sms ga_index" rel="sms" href="sms:<?php echo $delim . 'body=' . $title . ' ' . $link; ?>?socialshare=sms<?php echo $position; ?>">Message</a>

            <div class="share-count">
                <?php $this->sharecount(); ?>
            </div>
        </div>
        <?php
    }


    function place_buttons_old($single=true){
        ?>
        <div class="share-box<?php echo $single ? ' single':''; ?>">
            <?php
            if(!$single){
                echo '<div class="share">';
                $this->sharecount();
                echo '</div>';
            }
            ?>
            <div class="primary-shares"<?php echo $single ? ' style="display:inline-block"':''; ?>>
                <div class="total-shares">
                <?php $this->sharecount(); ?>
                </div>

                <a class="social-share facebook popup ga_index" rel="facebook"
                   href="//www.facebook.com/sharer.php?u=<?php echo $this->post_share_link; ?>?socialshare=fbsharetop_m">
                    <img src="<?php echo $this->imagefolder; ?>img_trans.gif" alt="" width="20"
                         height="20"/>
                        <span class="stext">Facebook</span>
                </a>
                <a class="social-share mail ga_index" rel="email"
                   href="mailto:?subject=<?php echo $this->post->title; ?>&body=Please check this: <?php echo $this->post_share_link; ?>?socialshare=emailsharetop_m">
                    <img src="<?php echo $this->imagefolder; ?>img_trans.gif" alt="" width="20"
                         height="20"/>
                    <span class="stext">Email</span>
                </a>
                <a class="social-share pinterest popup ga_index" rel="pinterest"
                   href="//www.pinterest.com/pin/create/unknown/?url=<?php echo $this->post_share_link; ?>?socialshare=pinterestsharetop_m&media=<?php echo $this->post->image; ?>&description=<?php echo $this->post->title; ?>">
                    <img src="<?php echo $this->imagefolder; ?>img_trans.gif" alt="" width="20"
                         height="20"/>
                    <span class="stext">Pinterest</span>
                </a>
                <a class="social-share sms popup ga_index" rel="sms"
                   href="sms:body=<?php echo $this->post->title . ' ' . $this->post_share_link; ?>?socialshare=smssharetop_m">
                    <img src="<?php echo $this->imagefolder; ?>img_trans.gif" alt="" width="20"
                         height="20"/>
                    <span class="stext">SMS</span>
                </a>
            </div>
        </div>
        <?php
    }

    function facebook_share(){
        ?>
        <a class="social-share facebook popup ga_index fullwide" rel="facebook"
           href="//www.facebook.com/sharer.php?u=<?php echo $this->post_share_link; ?>?socialshare=fbsharebottom_m">
            <img src="<?php echo $this->imagefolder; ?>img_trans.gif" alt="" width="20"
                 height="20"/>
            <span>Share this on Facebook</span>
        </a>
        <?php
    }

    function like_page($page='Post') {
        if ($this->like_url) {
            ?>
            <div class="like_page">
                <p class="likethumb">Did You Like This <?php echo ucwords($page); ?>? Tap Below</p>

                <div class="fb-like" data-href="<?php echo $this->like_url; ?>" data-layout="standard" data-width="300"
                     data-action="like" data-show-faces="true" data-share="false">
                </div>
            </div>
            <?php if ($page='video' && PROJECT_ID==1){ ?>
                <div  style="margin-left:10px!important">
                <script src="https://apis.google.com/js/platform.js"></script>

                    <script>
                     function onYtEvent(payload) {
                         if (payload.eventType == 'subscribe') {
                             // Add code to handle subscribe event.
                         } else if (payload.eventType == 'unsubscribe') {
                             // Add code to handle unsubscribe event.
                         }
                         if (window.console) { // for debugging only
                             window.console.log('YT event: ', payload);
                         }
                     }
                    </script>

                    <div class="g-ytsubscribe" data-channel="Womanfreebies"
                    data-layout="full" data-count="default"
                    data-onytevent="onYtEvent"></div>
                </div>
         <?php } ?>
        <?php
        }
    }

}
