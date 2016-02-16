<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class APICall {

    protected $URL, $URlbase, $params, $key;

    function __construct($params = array()) {



      $detect = new MobileDetector();




        if ($detect->isiOS()) {
// code to run for the iPhone platform
          $this->key = '1qA34-810';
        } else if ($detect->isAndroidOS()) {
// code to run for the Google Android platform
           $this->key = '1qA34-800';
        } else if ($detect->isMobile()) {
// any mobile platform
           $this->key = '1Qa34-83';
        } else {
// any mobile platform
            $this->key = '1Qa34-83';
        } 

       //   $this->key = '1Qa34-83';


            $this->URlbase = BASE_API_URL;
            $default = array(

            'device' => 'desktop',
            'category' => NULL,
            'post_id' => NULL,
            'limit' => (int) DEFAULT_POST_NUM,
            'skip' => 0,
            'start_date' => NULL,
            'end_date' => NULL,
            'country' => COUNTRY,
            'error' => NULL,
            'api_key' => $this->key,
            'action' => 'get',
            'search' => NULL
        );

        $this->params = array_merge($default, $params);

        $this->URL = $this->buidURL();
//echo "<br/><br/><br/><br/><br/><br/>". print_r($this->URL, TRUE);
    }

    public function getURLbase() {
        return $this->URlbase;
    }

    public function buidURL() {
        $category = '';
        $s = '';
        $exp = '&expiring=0';
        if (isset($this->params['post_id'])) {
            $country = $this->params['country'];
            $api_key = $this->params['api_key'];
            $action = $this->params['action'];
            $URL = $this->URlbase . '?api_key=' . $api_key . '&action=' . $action . '&project_id=' . PROJECT_ID . '&post_id=' . $this->params['post_id'];
        }else if (isset($this->params['error'])) {
            $country = $this->params['country'];
            $api_key = $this->params['api_key'];
            $action = $this->params['action'];
            $URL = $this->URlbase . '?api_key=' . $api_key . '&action=' . $action . '&project_id=' . PROJECT_ID . '&error=' . $this->params['error'];
        }else if (isset($this->params['taxonomy'])) {
            $limit = $this->params['limit'];
            $skip = $this->params['skip'];
            $country = $this->params['country'];
            $api_key = $this->params['api_key'];
            $action = $this->params['action'];
            $taxonomy = $this->params['taxonomy'];
            $subtaxonomy = $this->params['subtaxonomy'];
            $URL = $this->URlbase . '?api_key=' . $api_key . '&action=' . $action . '&project_id=' . PROJECT_ID . '&taxonomy=' . $this->params['taxonomy']. '&subtaxonomy=' . $this->params['subtaxonomy']. '&skip=' . $skip . '&limit=' . $limit;
        }
        else {
            $limit = $this->params['limit'];
            $skip = $this->params['skip'];
            $country = $this->params['country'];
            $api_key = $this->params['api_key'];
            $action = $this->params['action'];
            $category_slug = $this->params['category'];
            $search = $this->params['search'];
            if (!empty($category_slug)) {
                $category = '&category=' . urlencode($category_slug);
            }
            if (!empty($search)) {
                $s = '&search=' . urlencode($search);
            }
            if (!empty($this->params['expiring'])) {
                $exp = '&expiring=1';
            }
            $URL = $this->URlbase . '?api_key=' . $api_key . '&action=' . $action . '&project_id=' . PROJECT_ID . '&skip=' . $skip . '&limit=' . $limit . $category . $s . $exp;
        }

       // echo "<br/><br/><br/>".$URL;
        return $URL;
    }

    public function getJSONResponse() {

        if (isset($params['limit'])) {
            $limit = $params['limit'];
        }
        if (isset($params['skip'])) {
            $skip = $params['skip'];
        }
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_URL, $this->URL);


        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function getPost() {

        $param_query = http_build_query($this->params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:key-2iionxhsy9aq5rpk06i08qvdcwdg5119');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_URL, $this->URL . '/api/1/?limit=' . $this->params['limit'] . '&skip=' . $this->params['skip']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_query);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

}

?>
