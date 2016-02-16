<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HeaderController
 *
 * @author menu
 */
class FooterController extends View {

    // Footer

    public function __construct($page, $PostCall = NULL, $params = array()) {


        parent::__construct();

     //   $this->setJavascriptFile('public' . DS . 'js' . DS . 'jquery-1.9.0.min.js');
     //   $this->setJavascriptFile('public' . DS . 'js' . DS . 'modernizr-2.6.1.min.js');
     //   $this->setJavascriptFile('public' . DS . 'js' . DS . 'main.js');
     //   $this->setJavascriptFile('public' . DS . 'js' . DS . 'ga_tracking.js');
     //   $this->setJavascriptFile('public' . DS . 'js' . DS . 'jquery.touchSwipe.js');
     //   $this->setJavascriptFile('public' . DS . 'js' . DS . 'jquery-ui.js');
     //   $this->setJavascriptFile('public' . DS . 'js' . DS . 'jquery.cookie.js');
        switch ($page) {
            case 'index':
     //           $this->setJavascriptFile('public' . DS . 'js' . DS . 'imagesloaded.js');
     //           $this->setJavascriptFile('public' . DS . 'js' . DS . 'jquery.infinitescroll.js');

                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->singleHeaderUnit(), 'googleads', 'SingleHeader');
                $asynPush[] = $googleAds->pushInFooter();
                $this->assignValue($googleAds->googleFeedBoxR(), 'googleads', 'Feed');
                $this->assignValue($googleAds->googleFeedBoxR2(), 'googleads', 'Feed2');
                $this->assignValue($googleAds->googleFeedBoxR3(), 'googleads', 'Feed3');
                $scroll = new InfinteScrolling($asynPush);

                $this->assignValue($scroll->scrollInit(), 'pagedata', 'srollInit');
               // $this->assignValue("Womanfreebies.com", 'pagedata', 'sitename');
                break;
            case 'expiring':
     //           $this->setJavascriptFile('public' . DS . 'js' . DS . 'imagesloaded.js');
     //           $this->setJavascriptFile('public' . DS . 'js' . DS . 'jquery.infinitescroll.js');

                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->singleHeaderUnit(), 'googleads', 'SingleHeader');
                $asynPush[] = $googleAds->pushInFooter();
                $this->assignValue($googleAds->googleFeedBoxR(), 'googleads', 'Feed');
                $this->assignValue($googleAds->googleFeedBoxR2(), 'googleads', 'Feed2');
                $this->assignValue($googleAds->googleFeedBoxR3(), 'googleads', 'Feed3');
                $scroll = new InfinteScrolling($asynPush);

                $this->assignValue($scroll->scrollInit(), 'pagedata', 'srollInit');
               // $this->assignValue("Womanfreebies.com", 'pagedata', 'sitename');
                break;
            case 'search':
     //           $this->setJavascriptFile('public' . DS . 'js' . DS . 'imagesloaded.js');
     //           $this->setJavascriptFile('public' . DS . 'js' . DS . 'jquery.infinitescroll.js');
                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->singleHeaderUnit(), 'googleads', 'SingleHeader');
                $asynPush[] = $googleAds->pushInFooter();
                $this->assignValue($googleAds->googleFeedBoxR(), 'googleads', 'Feed');
                $this->assignValue($googleAds->googleFeedBoxR2(), 'googleads', 'Feed2');
                $this->assignValue($googleAds->googleFeedBoxR3(), 'googleads', 'Feed3');
                $scroll = new InfinteScrolling($asynPush);

                $this->assignValue($scroll->scrollInit(), 'pagedata', 'srollInit');
               // $this->assignValue("Womanfreebies.com", 'pagedata', 'sitename');
                break;

            case 'post':
                $footer = new FooterModel($PostCall);
                $init = $footer->init();
                $this->assignValue($init, 'pagedata', 'footerinit');

                break;
            case 'category':
     //           $this->setJavascriptFile('public' . DS . 'js' . DS . 'imagesloaded.js');
     //           $this->setJavascriptFile('public' . DS . 'js' . DS . 'jquery.infinitescroll.js');
                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->singleHeaderUnit(), 'googleads', 'SingleHeader');
                $asynPush[] = $googleAds->pushInFooter();
                $this->assignValue($googleAds->googleFeedBoxR(), 'googleads', 'Feed');
                $this->assignValue($googleAds->googleFeedBoxR2(), 'googleads', 'Feed2');
                $this->assignValue($googleAds->googleFeedBoxR3(), 'googleads', 'Feed3');
                $scroll = new InfinteScrolling($asynPush);

                $this->assignValue($scroll->scrollInit(), 'pagedata', 'srollInit');
               // $this->assignValue("Womanfreebies.com", 'pagedata', 'sitename');
                break;
            case 'taxonomy':
     //         $this->setJavascriptFile('public' . DS . 'js' . DS . 'imagesloaded.js');
     //           $this->setJavascriptFile('public' . DS . 'js' . DS . 'jquery.infinitescroll.js');
                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->singleHeaderUnit(), 'googleads', 'SingleHeader');
                $asynPush[] = $googleAds->pushInFooter();
                $this->assignValue($googleAds->googleFeedBoxR(), 'googleads', 'Feed');
                $this->assignValue($googleAds->googleFeedBoxR2(), 'googleads', 'Feed2');
                $this->assignValue($googleAds->googleFeedBoxR3(), 'googleads', 'Feed3');
                $scroll = new InfinteScrolling($asynPush);

                $this->assignValue($scroll->scrollInit(), 'pagedata', 'srollInit');
               // $this->assignValue("Womanfreebies.com", 'pagedata', 'sitename');
                break;
            case '404_page':
               // $this->assignValue("Womanfreebies.com", 'pagedata', 'sitename');
                break;



            default:
                break;
        }
        //CSS adding
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

    function __get($name) {
        return $this->$name;
    }

}
?>

