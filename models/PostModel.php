<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostModel
 *
 * @author menu
 */
class PostModel {

//put your code here
            private $post, $device, $site_url, $post_expired_date, $displaytouser;
            public $featured;

    function __construct() {
        $this->device = 'desktop';
        $this->post = array();
        $this->site_url = SITE_ROOT;
        $this->featured = 0;
    }

    public function getJSONcall($params, $decode = TRUE) {
        if (!DIRECT_CALL) {
            $apicall = new APICall($params);
        } else {
            $apicall = new APIDirect($params);
        }
        $posts = $apicall->getJSONResponse();
        
        if ($decode) {
            $postdata = json_decode($posts, TRUE);

            return $postdata;
        } else {
            return $posts;
        }
    }

    public function getPosts($postdata) {



        if (is_array($postdata) && count($postdata) > 0) {

            if (array_key_exists('error', $postdata)) {
                $error = (array) $postdata['error'];
                // 404 page
                if ($error['code'] == '404') {
                    $notfound = new NotFoundController();
                    $notfound->contentNotFound();
                }
            }
            $i = 0;
            if (array_key_exists('post', $postdata)) {
                foreach ($postdata['post'] as $item) {
                    if($this->featured == $item['post_id']){
                        continue;
                    }

// before this line needs to be tested on errors

                    if (is_array($item) && count($item) > 0) {

                        //echo count($postdata['post']);exit();
                        foreach ($item as $k => $v) {

                            $item["post_images"] = $item['post_image'];
                            if (isset($item['post_image']['large']['mdpi'])) {
                                $item["post_image"] = $item['post_image']['large']['mdpi'];
                            }
                            elseif (isset($item['post_image']['570_300'])) {
                                $item["post_image"] = $item['post_image']['570_300'];
                            }
                        }
                    }


                    $i++;
                    $this->post[] = $item;
                }
            }

            return $this->post;
        }
        exit("Something went wrong");
    }

    public function getPostObject($postArray) {


        $post = new stdClass();
		$ptn = "@/?$@";
        $rpltxt = "";

        $i = 0;

        foreach ($postArray as $item) {

            $post->{$i} = new stdClass();
            $post->{$i}->ID = $item['post_id'];
            $post->{$i}->post_type = $item['post_type'];
            $post->{$i}->shares = $item['post_share'];
            $post->{$i}->date = $item['post_date'];
            $post->{$i}->ID_next = $item['next_post_id'];
            $post->{$i}->ID_prev = $item['prev_post_id'];
            $post->{$i}->slug_next = html_entity_decode($item['next_post_slug']);
            $post->{$i}->slug_prev = html_entity_decode($item['prev_post_slug']);
            $post->{$i}->post_share_link = $this->replaceForHttps(preg_replace($ptn, $rpltxt, html_entity_decode($item['post_share_link'])));
            if ($item['next_post_permalink'] != '') {
                $post->{$i}->permalink_next = $this->site_url . html_entity_decode($item['next_post_permalink']);
            } else {
                $post->{$i}->permalink_next = '';
            }
            if (($item['prev_post_permalink'] != '') || (isset($item['post_is_expired']) && $item['post_is_expired'] == FALSE)) {
                $post->{$i}->permalink_prev = $this->site_url . html_entity_decode($item['prev_post_permalink']);
            } else {
                $post->{$i}->permalink_prev = '';
            }
            $post->{$i}->slug = html_entity_decode($item['post_slug']);
            if (isset($item['post_title'])) {
                $post->{$i}->title = $item['post_title'];
            } else {
                $post->{$i}->title = '';
            }

            //insert
            if (isset($item['post_image']) && !is_array($item['post_image']) && $item['post_image'] != '') {
                $post->{$i}->image = $this->replaceForStorage($item['post_image']);
            } else {
                $post->{$i}->image = DEFAULT_POST_IMAGE;
            }
            //end

            if (isset($item['list']) && is_array($item['list']) && count($item['list']) > 0) {
                $post->{$i}->list = $item['list'];
            } else {
                $post->{$i}->list = '';
            }
            $post->{$i}->category = $item['post_permalink'];
            $post->{$i}->inCategory = $this->inCategory($item['post_category']);

                $post->{$i}->permalink = $this->site_url . $item['post_permalink'];

                $post->{$i}->hyperlink = html_entity_decode($item['post_hyperlink']);
            
            if(isset($item['is_video_post'])){
                $post->{$i}->is_video_post = $item['is_video_post'];
                if(isset($item['video_link'])){
                $post->{$i}->video_link = $item['video_link'];
            }}

            if(isset($item['is_slider_post'])){
                $post->{$i}->is_slider_post = $item['is_slider_post'];
                if(isset($item['_wf_slider_group'])){
                    $post->{$i}->_wf_slider_group = $item['_wf_slider_group'];
                }
            }
            $post->{$i}->hyperlink_text = html_entity_decode($item['post_hyperlink_text']);
            $post->{$i}->local_text = html_entity_decode($item['post_local_link_text']);
            $this->post_expired_date = $item['post_expired_date'];

                $post->{$i}->post_expired_date = $this->show_expired_date();

            $this->displaytouser = $item['displaytouser'];
            $post->{$i}->content = $this->filterContent($item['post_content']);
            $post->{$i}->excerpt = $this->filterContent($item['post_excerpt']);
            $post->{$i}->meta_title = $this->getSingleMetaTitle($item['post_title'], $item['post_meta_title']);
            $post->{$i}->meta_description = html_entity_decode($item['post_meta_description']);
            $i++;
        }


        return $post;
    }

    public function replaceForHttps($string){
        return str_replace('http://', '//', $string);
    }


    public function replaceForStorage($string){
        return str_replace('http://cdn.womanfreebies.com', '//storage.googleapis.com/cdn.womanfreebies.com', $string);
    }

    public function getRelatedObject($rel) {
            $related = new stdClass();
            $i=0;
            if ( count($rel) > 0){
            foreach ($rel as $item) {
            $related->{$i} = new stdClass();
            if(isset($item['post_id'])){
            $related->{$i}->post_id = $item['post_id'];
            }else{
               $related->{$i}->post_id ='';
            }
            if(isset($item['post_slug'])){
            $related->{$i}->post_slug = $item['post_slug'];
            }
            else{
              $related->{$i}->post_slug ='';  
            }
            if(isset($item['post_image'])&&$item['post_image']!='http://c452411.r11.cf2.rackcdn.com/wf/loading-us.jpg'){
            $related->{$i}->post_image = $this->replaceForStorage($item['post_image']);
            }
            else{
             $related->{$i}->post_image = DEFAULT_POST_IMAGE;  
            }
            if(isset($item['post_title'])){
            $related->{$i}->post_title = $item['post_title'];
            }
            else{
              $related->{$i}->post_title =''; 
            }
            if(isset($item['post_permalink'])){
            $related->{$i}->post_permalink = $this->replaceForHttps($item['post_permalink']);
            }
            else{
             $related->{$i}->post_permalink = '';   
            }
            $i++;
      
    } }
        
        return $related;
      
    }

    public function getImage() {
        
    }

    public function filterContent($content) {
        $content = str_replace('\r\n', '<br/>', $content);
        return $content;
    }

    public function getSingleMetaTitle($post_title, $post_metatitle) {
        if ($post_metatitle) {
            return $post_metatitle;
        } else {
            return strip_tags($post_title);
        }
    }

    public function getRelatedArray($related_arr) {
        $related = array();
        if (count($related_arr) <= 1) {
            return NULL;
        } else {
                if(count($related_arr) < RELATED_POSTS_COUNT){
                    $count = count($related_arr);
                } else {
                    $count = RELATED_POSTS_COUNT;
                }
            foreach(array_rand($related_arr, $count) as $key){
	    $related[] = $related_arr[$key];
            }

          return $related;

           //echo "<pre>".print_r($related, TRUE)."</pre>"; exit();
        }
    }

    function show_expired_date() {

        if ($this->post_expired_date) {
            $display_exp = 'Valid Until ';
            $expired_date = $this->post_expired_date;
            $expired_date = $this->change_date_format($expired_date, "F j");
        } else {
            $display_exp = '';
            $expired_date = '';
        }

        return $display_exp . " " . $expired_date;
    }

    public function change_date_format($date, $format = null) {

        if ($format == null) {
            $format = "M j";
        }
        $old_date_timestamp = strtotime($date);

        $newDateString = date($format, $old_date_timestamp);
        return $newDateString;
    }

    public function inCategory($post_category) {

        if (is_array($post_category) && count($post_category) > 0) {
            $menu = unserialize(MENU_SETTINGS);

            foreach ($post_category as $catname) {
                if (is_array($menu) && count($menu) > 0) {
//
                    foreach ($menu['category'] as $menuitme) {

                        if ($catname == $menuitme['title']) {
                            return '<a href="' . $menuitme["link"] . '">
      <span class="date"><b>' . $menuitme["title"] . '</b></span>
      </a>';
                        }
                    }
                }
            }
        }
    }

    public function getSinglePostParameters($post_id) {

        return $params = array('device' => $this->device, 'post_id' => $post_id);
    }

    public function gePostParameters($device, $post_id) {

        return $params = array('device' => 'desktop', 'post_id' => $post_id);
    }

    private function parse(array $arr, stdClass $parent = null) {
        if ($parent === null) {
            $parent = $this;
        }

        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $parent->$key = $this->parse($val, new stdClass);
            } else {
                $parent->$key = $val;
            }
        }

        return $parent;
    }
    public function findYoutube($content){

        $temp_content = ' Using only a finger, an iPad Air and the app Procreate, artist Kyle Lambert has painted an amazing photorealistic portrait of actor Morgan Freeman. Freeman has received Academy Award nominations for his performances in Street Smart, Driving Miss Daisy, The Shawshank Redemption and Invictus, and won the Best Supporting Actor Oscar in 2005 for Million Dollar Baby. We\'re happy to hear that we\'ll see him in the upcoming movie Ted 2!<br /><br />Here are some funny "true" facts about Morgan Freeman:<br /><br />https://www.youtube.com/watch?v=Ch5MEJk5ZCQ&feature=youtu.be<br />https://www.youtube.com/watch?v=Ch5MEJk5ZCA123s&feature=youtu.be<br />https://www.youtube.com/watch?v=1234&feature=youtu.be<br />https://www.youtube.com/watch?v=C12456&feature=youtu.be';

        preg_match_all('/<br\s?\/?>(http[s]?:\/\/(www.)?youtube.(be|com)(.*?)\?[v][=]\w+)/i',$content, $matches, PREG_PATTERN_ORDER );
        if(!empty($matches[0])&&count($matches>0)){
         //    echo "<pre>".print_r($matches[0], TRUE)."</pre>"; exit;
            foreach ($matches[0] as $k=>$v){

                $pos = strrpos($content, $v);
                if ($pos>0) {
                    $content = substr($content, 0, $pos);
                }
                $mtc= explode("=", $v);

                $content .= '<div class="videowrapper">
                        <iframe class="swipe-img" width="300" height="169" src="https://www.youtube.com/embed/'.$mtc[1].'?feature=oembed"
                                frameborder="0" allowfullscreen></iframe></div>';


            }
        }
        echo  ($content);
    }

}
