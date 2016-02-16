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
class ContentController extends View {

    // Content

    public $PostModel, $PostCall, $PostArray, $PostObject;

    public function __construct($page, $params = array()) {


        parent::__construct();
        $this->assignValue(SITE_ROOT, 'pagedata', 'home');
        $menu = new MenuNav(unserialize(MENU_SETTINGS));
        switch ($page) {


            case 'index':

                $this->PostModel = new PostModel();

                if(isset($_GET['f']) && is_numeric($_GET['f'])) {
                    $fpostcall = $this->PostModel->getJSONcall(array ('post_id' => $_GET['f']));
                    if (!array_key_exists('error', $fpostcall)) {
                        $fpost_array = $this->PostModel->getPosts($fpostcall);
                        $this->PostModel->featured = $_GET['f'];
                    }
                }

                $this->PostCall = $this->PostModel->getJSONcall($params);

                $this->PostArray = $this->PostModel->getPosts($this->PostCall);

                $this->PostObject = $this->PostModel->getPostObject($this->PostArray);

                if (isset($this->PostCall['query_args'])) {
                    $this->assignValue($this->PostCall['query_args'], 'postdata', 'query_args');
                }
                $this->assignValue($this->PostCall['max_num_pages'], 'postdata', 'max_num_pages');
                $this->assignValue($this->PostCall['query_GMT'], 'postdata', 'query_GMT');
                $this->assignValue($this->PostCall['found_posts'], 'postdata', 'found_posts');
                $this->assignValue($this->PostCall['post_count'], 'postdata', 'post_count');
                $this->assignValue($this->PostCall['targeted_device'], 'postdata', 'targeted_device');
                $this->assignValue($this->PostArray, 'postdata', 'post_array');
                $pagination = new Pagination();

                $nextLink = $pagination->nextLink($params, $this->PostCall['max_num_pages']);
                $previousLink = $pagination->previousLink($params);

                $this->assignValue($nextLink, 'postdata', 'nextPage');
                $this->assignValue($previousLink, 'postdata', 'prevPage');
                $this->assignValue($this->PostObject, 'postdata', 'post');

                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->singleHeaderUnit(), 'googleads', 'SingleHeader');
                $asynPush[] = $googleAds->pushInFooter();
                $this->assignValue($googleAds->googleFeedBoxR(), 'googleads', 'Feed');
                $this->assignValue($googleAds->googleFeedBoxR2(), 'googleads', 'Feed2');
                $this->assignValue($googleAds->googleFeedBoxR3(), 'googleads', 'Feed3');
                $scroll = new InfinteScrolling($asynPush);

                $this->assignValue($scroll->scrollInit(), 'pagedata', 'srollInit');
                break;
            case 'expiring':
                $this->PostModel = new PostModel();

                $this->PostCall = $this->PostModel->getJSONcall($params);
                $this->PostArray = $this->PostModel->getPosts($this->PostCall);

                $this->PostObject = $this->PostModel->getPostObject($this->PostArray);

                if (isset($this->PostCall['query_args'])) {
                    $this->assignValue($this->PostCall['query_args'], 'postdata', 'query_args');
                }
                $this->assignValue($this->PostCall['max_num_pages'], 'postdata', 'max_num_pages');
                $this->assignValue($this->PostCall['query_GMT'], 'postdata', 'query_GMT');
                $this->assignValue($this->PostCall['found_posts'], 'postdata', 'found_posts');
                $this->assignValue($this->PostCall['post_count'], 'postdata', 'post_count');
                $this->assignValue($this->PostCall['targeted_device'], 'postdata', 'targeted_device');
                $this->assignValue($this->PostArray, 'postdata', 'post_array');
                $pagination = new Pagination();

                $nextLink = $pagination->nextLink($params, $this->PostCall['max_num_pages']);
                $previousLink = $pagination->previousLink($params);

                $this->assignValue($nextLink, 'postdata', 'nextPage');
                $this->assignValue($previousLink, 'postdata', 'prevPage');
                $this->assignValue($this->PostObject, 'postdata', 'post');

                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->singleHeaderUnit(), 'googleads', 'SingleHeader');
                $asynPush[] = $googleAds->pushInFooter();
                $this->assignValue($googleAds->googleFeedBoxR(), 'googleads', 'Feed');
                $this->assignValue($googleAds->googleFeedBoxR2(), 'googleads', 'Feed2');
                $this->assignValue($googleAds->googleFeedBoxR3(), 'googleads', 'Feed3');
                $scroll = new InfinteScrolling($asynPush);

                $this->assignValue($scroll->scrollInit(), 'pagedata', 'srollInit');
                break;
            case 'post':
                $this->PostModel = new PostModel();
                $this->PostCall = $this->PostModel->getJSONcall($params);
                $this->PostArray = $this->PostModel->getPosts($this->PostCall);
                if (array_key_exists('related', $this->PostCall) && $this->PostCall['related'] != NULL) {
                    $this->RelatedArray = $this->PostModel->getRelatedArray($this->PostCall['related']);
                    $this->RelatedObject = $this->PostModel->getRelatedObject($this->RelatedArray);
                    $this->assignValue($this->RelatedObject, 'postdata', 'related');
                }
                $this->PostObject = $this->PostModel->getPostObject($this->PostArray);
                $this->assignValue($params, 'postdata', 'params');
                $this->assignValue('', 'postdata', 'query_args');
//              $this->assignValue($this->PostCall['max_num_pages'], 'postdata', 'max_num_pages');
                $this->assignValue($this->PostCall['query_GMT'], 'postdata', 'query_GMT');
//              $this->assignValue($this->PostCall['found_posts'], 'postdata', 'found_posts');
//              $this->assignValue($this->PostCall['post_count'], 'postdata', 'post_count');
                $this->assignValue($this->PostObject, 'postdata', 'post');
                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->singleHeaderUnit(), 'googleads', 'SingleHeader');
                $this->assignValue($googleAds->singleAfterPost(), 'googleads', 'SingleAfterPost');
                $this->assignValue($googleAds->googleSingleAfterPostR(), 'googleads', 'googleSingleAfterPostR');
                $this->assignValue($menu->swiper(), 'pagedata', 'swip');
                $this->assignValue($googleAds->singleHeaderSmall(), 'googleads', 'singleHeaderSmall');
//                $commercialads = new CommercialAds();
//                $this->assignValue($commercialads->ShowCommercialAds($this->PostObject), 'commercialads', 'ShowCommercialAds');
                break;

            case 'category':
                //$this->setJavascriptFile('public' . DS . 'js' . DS . 'imagesloaded.js');
                //$this->setJavascriptFile('public' . DS . 'js' . DS . 'jquery.infinitescroll.js');
                $this->assignValue(DEFAULT_CATEGORY_BASE_URL, 'postdata', 'categorybase');
                $this->assignValue(unserialize(MENU_SETTINGS), 'postdata', 'menu');

                $this->PostModel = new PostModel();

                if(isset($_GET['f']) && is_numeric($_GET['f'])) {
                    $fpostcall = $this->PostModel->getJSONcall(array ('post_id' => $_GET['f']));
                    if (!array_key_exists('error', $fpostcall)) {
                        $fpost_array = $this->PostModel->getPosts($fpostcall);
                        $this->PostModel->featured = $_GET['f'];
                    }
                }

                $this->PostCall = $this->PostModel->getJSONcall($params);

                $this->PostArray = $this->PostModel->getPosts($this->PostCall);
                $this->PostObject = $this->PostModel->getPostObject($this->PostArray);

                if (isset($params['category'])) {
                    $this->assignValue($params['category'], 'postdata', 'category');
                }
                if(isset($this->PostCall['targeted_category_name'])) {
                    $this->assignValue($this->PostCall['targeted_category_name'], 'postdata', 'category_name');
                }else{
                    $this->assignValue('', 'postdata', 'category_name');
                }
                if(isset($this->PostCall['targeted_category'])) {
                    $this->assignValue($this->PostCall['targeted_category'], 'postdata', 'category_slug');
                }else{
                    $this->assignValue('', 'postdata', 'category_slug');
                }

                //$this->assignValue($this->PostCall['query_args'], 'postdata', 'query_args');
                $this->assignValue($this->PostCall['max_num_pages'], 'postdata', 'max_num_pages');
                $this->assignValue($this->PostCall['query_GMT'], 'postdata', 'query_GMT');
                $this->assignValue($this->PostCall['found_posts'], 'postdata', 'found_posts');
                $this->assignValue($this->PostCall['post_count'], 'postdata', 'post_count');
                $this->assignValue($this->PostCall['targeted_device'], 'postdata', 'targeted_device');

                $pagination = new Pagination();

                $nextLink = $pagination->nextLink($params, $this->PostCall['max_num_pages']);
                $previousLink = $pagination->previousLink($params);

                $this->assignValue($nextLink, 'postdata', 'nextPage');
                $this->assignValue($previousLink, 'postdata', 'prevPage');
                $this->assignValue($this->PostObject, 'postdata', 'post');
                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->singleHeaderUnit(), 'googleads', 'SingleHeader');
                $asynPush[] = $googleAds->pushInFooter();

                $this->assignValue($googleAds->googleFeedBoxR(), 'googleads', 'Feed');
                $this->assignValue($googleAds->googleFeedBoxR2(), 'googleads', 'Feed2');
                $this->assignValue($googleAds->googleFeedBoxR3(), 'googleads', 'Feed3');
                $scroll = new InfinteScrolling($asynPush);
                $this->assignValue($scroll->scrollInit(), 'pagedata', 'srollInit');

                break;

            case 'taxonomy':
                //$this->setJavascriptFile('public' . DS . 'js' . DS . 'imagesloaded.js');
                //$this->setJavascriptFile('public' . DS . 'js' . DS . 'jquery.infinitescroll.js');
                $this->assignValue(unserialize(MENU_SETTINGS), 'postdata', 'menu');

                $this->PostModel = new PostModel();

                if(isset($_GET['f']) && is_numeric($_GET['f'])) {
                    $fpostcall = $this->PostModel->getJSONcall(array ('post_id' => $_GET['f']));
                    if (!array_key_exists('error', $fpostcall)) {
                        $fpost_array = $this->PostModel->getPosts($fpostcall);
                        $this->PostModel->featured = $_GET['f'];
                    }
                }

                $this->PostCall = $this->PostModel->getJSONcall($params);

                $this->PostArray = $this->PostModel->getPosts($this->PostCall);
                $this->PostObject = $this->PostModel->getPostObject($this->PostArray);

                if (isset($params['taxonomy'])) {
                    $this->assignValue($params['taxonomy'], 'postdata', 'taxonomy');
                }
                if (isset($this->PostCall['taxonomy_data'])) {
                    $this->assignValue($this->PostCall['taxonomy_data'], 'postdata', 'taxonomy_data');
                }

                //$this->assignValue($this->PostCall['query_args'], 'postdata', 'query_args');
                $this->assignValue($this->PostCall['max_num_pages'], 'postdata', 'max_num_pages');
                $this->assignValue($this->PostCall['query_GMT'], 'postdata', 'query_GMT');
                $this->assignValue($this->PostCall['found_posts'], 'postdata', 'found_posts');
                $this->assignValue($this->PostCall['post_count'], 'postdata', 'post_count');
                $this->assignValue($this->PostCall['targeted_device'], 'postdata', 'targeted_device');

                $pagination = new Pagination();

                $nextLink = $pagination->nextLink($params, $this->PostCall['max_num_pages']);
                $previousLink = $pagination->previousLink($params);

                $this->assignValue($nextLink, 'postdata', 'nextPage');
                $this->assignValue($previousLink, 'postdata', 'prevPage');
                $this->assignValue($this->PostObject, 'postdata', 'post');
                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->singleHeaderUnit(), 'googleads', 'SingleHeader');
                $asynPush[] = $googleAds->pushInFooter();

                $this->assignValue($googleAds->googleFeedBoxR(), 'googleads', 'Feed');
                $this->assignValue($googleAds->googleFeedBoxR2(), 'googleads', 'Feed2');
                $this->assignValue($googleAds->googleFeedBoxR3(), 'googleads', 'Feed3');
                $scroll = new InfinteScrolling($asynPush);
                $this->assignValue($scroll->scrollInit(), 'pagedata', 'srollInit');

                break;

            case 'search':
                $addsearch = "";
              //  $this->setJavascriptFile('public' . DS . 'js' . DS . 'imagesloaded.js');
               // $this->setJavascriptFile('public' . DS . 'js' . DS . 'jquery.infinitescroll.js');
                $this->PostModel = new PostModel();
                $this->PostCall = $this->PostModel->getJSONcall($params);
                if (isset($params['search'])) {
                    $addsearch = "/?s=" . $params['search'];
                    $this->assignValue($params['search'], 'pagedata', 'searchResult');
                }

                $this->PostArray = $this->PostModel->getPosts($this->PostCall);
                $this->PostObject = $this->PostModel->getPostObject($this->PostArray);

                if (isset($this->PostCall['query_args'])) {
                    $this->assignValue($this->PostCall['query_args'], 'postdata', 'query_args');
                }
                $this->assignValue($this->PostCall['max_num_pages'], 'postdata', 'max_num_pages');
                $this->assignValue($this->PostCall['query_GMT'], 'postdata', 'query_GMT');
                $this->assignValue($this->PostCall['found_posts'], 'postdata', 'found_posts');
                $this->assignValue($this->PostCall['post_count'], 'postdata', 'post_count');
                $this->assignValue($this->PostCall['targeted_device'], 'postdata', 'targeted_device');
                $this->assignValue($this->PostArray, 'postdata', 'post_array');
                $pagination = new Pagination();

                $nextLink = $pagination->nextLink($params, $this->PostCall['max_num_pages']);
                $previousLink = $pagination->previousLink($params);

                $this->assignValue($nextLink . $addsearch, 'postdata', 'nextPage');
                $this->assignValue($previousLink . $addsearch, 'postdata', 'prevPage');
                $this->assignValue($this->PostObject, 'postdata', 'post');

                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->singleHeaderUnit(), 'googleads', 'SingleHeader');
                $asynPush[] = $googleAds->pushInFooter();
                $this->assignValue($googleAds->googleFeedBoxR(), 'googleads', 'Feed');
                $this->assignValue($googleAds->googleFeedBoxR2(), 'googleads', 'Feed2');
                $this->assignValue($googleAds->googleFeedBoxR3(), 'googleads', 'Feed3');
                $scroll = new InfinteScrolling($asynPush);

                $this->assignValue($scroll->scrollInit(), 'pagedata', 'srollInit');
                break;

            case '404_page':
                $this->PostModel = new PostModel();

                $this->PostCall = $this->PostModel->getJSONcall($params);

                $this->PostArray = $this->PostModel->getPosts($this->PostCall);
                shuffle($this->PostArray);

                $this->PostObject = $this->PostModel->getPostObject(array_slice($this->PostArray, 0, 5));

                $this->assignValue($this->PostObject, 'postdata', 'post');
                break;

            case 'easter-egg':

                break;

            case 'about':

                break;




            default:
                break;
        }
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

    function __get($name) {
        return $this->$name;
    }

}
