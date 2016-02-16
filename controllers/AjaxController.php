<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AjaxController
 *
 * @author alekk
 */
class AjaxController extends Controller {

    private $timeout, $baseurl, $social_network, $url;
    private $apistats_url;
    private $apistats_key;

    public function __construct() {
        parent::__construct();
        
        $detect = new MobileDetector();
        if ($detect->isiOS()) {
// code to run for the iPhone platform

            $key = '1qA34-810';
        } else if ($detect->isAndroidOS()) {
// code to run for the Google Android platform

            $key = '1qA34-800';
        } else if ($detect->isMobile()) {
// any mobile platform
            $key = '1Qa34-83';
        } else {
// any mobile platform
            $key = '1Qa34-83';
        }
      $this->api_url = BASE_API_URL.'?api_key='.$key. '&project_id=' . PROJECT_ID .'&action=tracking&url=';   
        $this->timeout = 10;
        //Statistics API for all sites (mongodb based):
        $this->apistats_url='http://apistats.adjump.com';
        $this->apistats_key = "api:key-2iionxhsy9aq5rpk06i08qvdcwdg5119";
    }

    public function index($query1 = NULL, $query2 = NULL) {
        if ( !empty($_GET) ) {
        $params = (object)$_GET;
        if (!isset($params->uid)) $params->uid='';
        $params->project_id=PROJECT_ID;
        $params->platform = 'mobile';
        switch ($params->action) {

            case 'sharesave':
                if ($params->shareurl) {
                    $url = $this->filterURL($params->shareurl);
                    // fb_update_object($url);
                }
                if (isset($params->sn)) {
                    $social_network = $params->sn;
                }

                $params->social_network=strtolower($social_network);
                $params->url=$url;

                $this->saveShares($params);

                break;

            case 'clicksave':
                
                $this->saveClicks($params);
                
                break;
            case 'viewsave':
                
                $this->saveViews($params);
                
                break;

            default :
                break;
        }


       // echo sendShare($api_url, $url, $social_network);

    }
    }

    private function sendShare() {
        $url = $this->api_url . $this->url . '&social_network=' . $this->social_network . '&save_tracks=1';
       
        $response = $this->file_get_contents_curl($url);
        $obj = json_decode($response);
        return $response;
    }

      /**
      * New MongoDB Share functionality
      */
     public function saveShares($params){


         $url=str_replace('mobile.', '', $params->url);
         $data = [
        'url' => $url,
        'uid' => $params->uid,
        'save_tracks' => 1,
        'social_network' => $this->social_network

         ];
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $this->apistats_url.'/shares');
         curl_setopt($ch, CURLOPT_USERPWD,   $this->apistats_key );
         curl_setopt($ch, CURLOPT_USERAGENT, isset ($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'N/A');
         curl_setopt($ch, CURLOPT_FAILONERROR, 1);
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
         curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
         $cont = curl_exec($ch);
         if (curl_error($ch)) {
             die(curl_error($ch));
         }
         echo $cont;

     }

     public function saveClicks($params){

         $data = [
             'platform' => $params->platform,
             'project_id' =>$params->project_id,
             'post_id' => $params->pid,
             'uid' => $params->uid,
             'post_url' => $params->posturl,
             'type' => $params->place,


         ];

         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $this->apistats_url.'/clicks');
         curl_setopt($ch, CURLOPT_USERPWD,   $this->apistats_key );
         curl_setopt($ch, CURLOPT_USERAGENT, isset ($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'N/A');
         curl_setopt($ch, CURLOPT_FAILONERROR, 1);
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
         curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
         $cont = curl_exec($ch);
         if (curl_error($ch)) {
             die(curl_error($ch));
         }
         echo $cont;

     }

     public function saveViews($params){

         $data = [
             'platform' => $params->platform,
             'project_id' =>$params->project_id,
             'post_id' => $params->pid,
             'uid' => $params->uid,
             'post_url' => $params->posturl,

         ];
         
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $this->apistats_url.'/views');
         curl_setopt($ch, CURLOPT_USERPWD,   $this->apistats_key );
         curl_setopt($ch, CURLOPT_USERAGENT, isset ($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'N/A');
         curl_setopt($ch, CURLOPT_FAILONERROR, 1);
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
         curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
         $cont = curl_exec($ch);
         if (curl_error($ch)) {
             die(curl_error($ch));
         }
         echo $cont;

     }
    
    private function file_get_contents_curl($url) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        $cont = curl_exec($ch);
        if (curl_error($ch)) {
            die(curl_error($ch));
        }
        return $cont;
    }

    private function filterURL($url) {

        if (preg_match('@\?u=(.*)[\?|\&]@', $url, $mtch)) {

            return $mtch[1];
        } else if (preg_match('@\?url=(.*)[\?|\&]@', $url, $mtch)) {

            return $mtch[1];
        } else if (preg_match('@\?url=(.*)@', $url, $mtch)) {

            return $mtch[1];
        } else if (preg_match('@\?u=(.*)@', $url, $mtch)) {

            return $mtch[1];
        }
    }

}

?>
