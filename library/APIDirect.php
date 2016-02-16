<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class APIDirect {

    protected $URL, $URlbase, $params, $key, $dparams;

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
            'api_key' => $this->key,
            'action' => 'get',
            'search' => NULL
        );

        $this->params = array_merge($default, $params);
        $this->URL = $this->buidURL();
        $this->dparams=  $this->buidParams();
//echo "<br/><br/><br/><br/><br/><br/>". print_r($this->dparams, TRUE);
    }

    public function getURLbase() {
        return $this->URlbase;
    }

    public function buidURL() {
        $category = '';
        $s = '';
        if (isset($this->params['post_id'])) {
            $country = $this->params['country'];
            $api_key = $this->params['api_key'];
            $action = $this->params['action'];
            $URL = $this->URlbase . '?api_key=' . $api_key . '&action=' . $action . '&project_id=' . PROJECT_ID . '&post_id=' . $this->params['post_id'];
        } else {
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
            $URL = $this->URlbase . '?api_key=' . $api_key . '&action=' . $action . '&project_id=' . PROJECT_ID . '&skip=' . $skip . '&limit=' . $limit . $category . $s;
        }

        //echo "<br/><br/><br/>".$URL;
        return $URL;
    }

    public function buidParams() {

        $params = array();
        if (isset($this->params['post_id'])) {

            $params['country'] = $this->params['country'];
            $params['post_id'] = $this->params['post_id'];
            $params['api_key'] = $this->params['api_key'];
            $params['action'] = $this->params['action'];
        } else {
            $params['country'] = $this->params['country'];
            $params['post_id'] = $this->params['post_id'];
            $params['api_key'] = $this->params['api_key'];
            $params['action'] = $this->params['action'];
            $params['limit'] = $this->params['limit'];
            $params['skip'] = $this->params['skip'];

            if (!empty($this->params['category'])) {
                $params['category'] = urlencode($this->params['category']);
            }
            if (!empty($this->params['search'])) {
                $params['search '] = urlencode($this->params['search']);
            }
        }

        return $params;
    }

    public function getJSONResponse() {
        $path=INCLUDE_DIRECT_URL;
        $cache_path='/var/www/vhosts/womenfreebies.net/httpdocs/apis';
	$dparams=$this->dparams;
        include_once  INCLUDE_DIRECT_URL."/include.php";
	$include= new IncludeHandeler($dparams);
        return $include->getDirectJSON();
       
		
    }
    //this is just for test purposes
    private function staticJSON(){
        return '{"post_type":"post","posts_per_page":"6","category__and":"null","meta_query":{"key":"android","value":"display","compare":"="},"offset":"10","ignore_sticky_posts":0,"query_GMT":"May 26 2014 15:04:15.","found_posts":"5276","max_num_pages":880,"post_count":"6","targeted_device":"android","meta_title":"Free Stuff, Samples, Coupons, and Sweepstakes | Woman Freebies","meta_description":"Browse through thousands of links to free stuff and free samples online. Receive the latest news on the best contests and sweepstakes on the web today!","post":[{"post_id":"133380","post_type":"post","post_share":null,"post_date":"2014-04-23 16:58:57","post_expired_date":null,"post_slug":"win-american-girl-prizes","next_post_id":"","prev_post_id":"","next_post_slug":"","prev_post_slug":"","next_post_permalink":"","prev_post_permalink":"","device":"android","post_title":"Win American Girl Prizes","post_is_expired":false,"post_image":{"570_300":"http:\/\/c454621.r21.cf2.rackcdn.com\/womanfreebies.com\/wp-content\/uploads\/2014\/04\/win-american-girl-prizes-570x300.jpg"},"post_images":{"full":[{"src":"http:\/\/c454621.r21.cf2.rackcdn.com\/womanfreebies.com\/wp-content\/uploads\/2014\/04\/win-american-girl-prizes-570x300.jpg","width":"570","height":"300"}]},"post_content":"Every month, the <strong>Anna Hart School of the Arts<\/strong> debuts <strong>new online activities to help you gain skills<\/strong> to create your own unique performances. They have classes on fashion design, performing arts, music & modern dance, hair & makeup and much more! <strong>Register for their virtual academy<\/strong> and you could also <strong>win exciting prizes like a trip to New York!<\/strong>\r\n\r\n<strong>How to Enter:<\/strong> Register with The Anna Hart School of the Arts for your chance to win! \r\n\r\n\r\n\r\n","post_excerpt":"Register to the <b>Anna Hart School of the Arts<\/b> and you could <b>win<\/b> exciting prizes like a <b>trip to New York!<\/b>","post_category":["Sweepstakes","Newsletter"],"post_category_id":["4","469"],"post_permalink":"\/sweepstakes\/win-american-girl-prizes\/","post_share_link":"http:\/\/womanfreebies.com\/sweepstakes\/win-american-girl-prizes\/","post_hyperlink":null,"post_hyperlink_text":null,"post_local_link_text":null,"post_meta_title":null,"post_meta_description":null,"post_offer_id":null,"post_file_id":null,"displaytouser":true},{"post_id":"133649","post_type":"post","post_share":null,"post_date":"2014-04-23 16:20:24","post_expired_date":null,"post_slug":"tums-chewy-delights","next_post_id":"","prev_post_id":"","next_post_slug":"","prev_post_slug":"","next_post_permalink":"","prev_post_permalink":"","device":"android","post_title":"Free Sample Of Tums Chewy Delights","post_is_expired":false,"post_image":{"570_300":"http:\/\/c454621.r21.cf2.rackcdn.com\/womanfreebies.com\/wp-content\/uploads\/2014\/04\/tums570x30004232014.jpg"},"post_images":{"full":[{"src":"http:\/\/c454621.r21.cf2.rackcdn.com\/womanfreebies.com\/wp-content\/uploads\/2014\/04\/tums570x30004232014.jpg","width":"570","height":"300"}]},"post_content":"<!--\r\nHO: 6260\r\n-->\r\n\r\n<strong>Sample Details:<\/strong>\r\n\r\nI love food, but it doesn\'t always love me back. What can I say the heart wants what it wants. Sometimes that leads to painful heartburn, but for that I always have <strong>Tums<\/strong>. It\'s the brand I trust the most to deal with my tummy issues fast, and they\'re giving out a <strong>free sample<\/strong>! Claim your sample of the tasty <strong>Tums Chewy Delights<\/strong> for tough heartburn relief that acts fast and tastes great.\r\n\r\n<strong>How To Get It:<\/strong>\r\n\r\nJust follow the instructions and enter your info to request this tasty sample.","post_excerpt":"Request a free sample of <b>Tums Chewy Delights<\/b> today and get heartburn relief that tastes great!","post_category":["Free Samples","Black-Friday","Pets"],"post_category_id":["3","54","388"],"post_permalink":"\/free-samples\/tums-chewy-delights\/","post_share_link":"http:\/\/womanfreebies.com\/free-samples\/tums-chewy-delights\/","post_hyperlink":null,"post_hyperlink_text":null,"post_local_link_text":null,"post_meta_title":null,"post_meta_description":null,"post_offer_id":null,"post_file_id":null,"displaytouser":false},{"post_id":"133412","post_type":"post","post_share":null,"post_date":"2014-04-23 14:07:43","post_expired_date":null,"post_slug":"clorox-smart-seek-bleach","next_post_id":"","prev_post_id":"","next_post_slug":"","prev_post_slug":"","next_post_permalink":"","prev_post_permalink":"","device":"android","post_title":"Save 50\u00a2 on ANY Clorox Smart Seek Bleach","post_is_expired":false,"post_image":{"570_300":"http:\/\/c454621.r21.cf2.rackcdn.com\/womanfreebies.com\/wp-content\/uploads\/2014\/04\/Clorox-Smart-570x300.jpg"},"post_images":{"full":[{"src":"http:\/\/c454621.r21.cf2.rackcdn.com\/womanfreebies.com\/wp-content\/uploads\/2014\/04\/Clorox-Smart-570x300.jpg","width":"570","height":"300"}]},"post_content":"<strong>Coupon Details:<\/strong> Get your whites even whiter thanks to <strong>Clorox Smart Seek Bleach<\/strong>. Whiten your mostly white and solid white garments with this new bleach that has enough power to remove stains and whiten, but yet is color safe for stripes and patterns on your clothes. Print this coupon and <strong>save 50 cents<\/strong> on your next purchase of ANY <strong>Clorox Smart Seek Bleach<\/strong>. Those stripes and patterned shirts will now be able to shine bright white again. \r\n\r\n<strong>How To Get These Coupons:<\/strong> Just Click on the Button \"Get Your Coupon\" and you will be taken directly to the coupon. From there clip your coupon and print it. It\'s time to start saving! Quantities are limited, so print yours while it\'s still available. ","post_excerpt":"Print this coupon and <strong>save 50 cents<\/strong> on your next purchase of ANY <strong>Clorox Smart Seek Bleach<\/strong>. Those stripes and patterned shirts will now be able to shine bright white again. ","post_category":["Coupons","i-Say"],"post_category_id":["8","481"],"post_permalink":"\/coupons\/clorox-smart-seek-bleach\/","post_share_link":"http:\/\/womanfreebies.com\/coupons\/clorox-smart-seek-bleach\/","post_hyperlink":null,"post_hyperlink_text":null,"post_local_link_text":null,"post_meta_title":null,"post_meta_description":null,"post_offer_id":null,"post_file_id":null,"displaytouser":false},{"post_id":"107432","post_type":"post","post_share":null,"post_date":"2014-04-23 12:15:47","post_expired_date":null,"post_slug":"win-a-pair-of-shoes","next_post_id":"","prev_post_id":"","next_post_slug":"","prev_post_slug":"","next_post_permalink":"","prev_post_permalink":"","device":"android","post_title":"Win A Pair of Shoes From JustFab","post_is_expired":false,"post_image":{"570_300":"http:\/\/c454621.r21.cf2.rackcdn.com\/womanfreebies.com\/wp-content\/uploads\/2013\/06\/Justfab570x300.jpg"},"post_images":{"full":[{"src":"http:\/\/c454621.r21.cf2.rackcdn.com\/womanfreebies.com\/wp-content\/uploads\/2013\/06\/Justfab570x300.jpg","width":"570","height":"300"}]},"post_content":"<!--\r\nHO: 6256\r\n-->\r\nI only need one word to describe this amazing contest: <strong>Shoes!<\/strong> If you are a shoe-lover like me then this is just the thing for you. <strong>Join JustFab<\/strong> today for a one-stop place to shop for all the latest styles that you are <em>sure to love<\/em>. Entering today will give you a chance to <strong>win a pair of shoes from JustFab!<\/strong> What better way to bring in summer than with great new shoes?\r\n\r\nThis giveaway ends on April 30th and the winner will be announced on May 1st, so get your name in today!","post_excerpt":"Join JustFab today and not only will you get amazing looking shoes at great prices, you\'ll be entered to <b>win a free pair of shoes!<\/b>","post_category":["Black-Friday","Entertainment"],"post_category_id":["54","470"],"post_permalink":"\/black-friday\/win-a-pair-of-shoes\/","post_share_link":"http:\/\/womanfreebies.com\/black-friday\/win-a-pair-of-shoes\/","post_hyperlink":null,"post_hyperlink_text":null,"post_local_link_text":null,"post_meta_title":null,"post_meta_description":null,"post_offer_id":null,"post_file_id":null,"displaytouser":false},{"post_id":"133432","post_type":"post","post_share":null,"post_date":"2014-04-23 12:02:08","post_expired_date":null,"post_slug":"win-up-to-20000-in-cash","next_post_id":"","prev_post_id":"","next_post_slug":"","prev_post_slug":"","next_post_permalink":"","prev_post_permalink":"","device":"android","post_title":"Win Up To $20,000 In Cash","post_is_expired":false,"post_image":{"570_300":"http:\/\/c454621.r21.cf2.rackcdn.com\/womanfreebies.com\/wp-content\/uploads\/2014\/04\/gactv-win-upto-20000-cash-570x300.jpg"},"post_images":{"full":[{"src":"http:\/\/c454621.r21.cf2.rackcdn.com\/womanfreebies.com\/wp-content\/uploads\/2014\/04\/gactv-win-upto-20000-cash-570x300.jpg","width":"570","height":"300"}]},"post_content":"Wouldn\'t you love to win free money? <strong>Enter this contest and you could walk away with cash!<\/strong> Enter daily for your chance to <strong>win one of the weekly $5,000 giveaways, and the Grand Prize of $20,000! <\/strong> Imagine all the things you could buy with $20,000 ...\r\n\r\n<strong>How to Enter:<\/strong> Just complete the entry form and that\'s it! \r\n","post_excerpt":"Enter this contest and you could <b>walk away with up to $20,000 in cash!<\/b> ","post_category":["Furniture Care"],"post_category_id":["904"],"post_permalink":"\/furniture-care\/win-up-to-20000-in-cash\/","post_share_link":"http:\/\/womanfreebies.com\/furniture-care\/win-up-to-20000-in-cash\/","post_hyperlink":null,"post_hyperlink_text":null,"post_local_link_text":null,"post_meta_title":null,"post_meta_description":null,"post_offer_id":null,"post_file_id":null,"displaytouser":true},{"post_id":"127149","post_type":"post","post_share":null,"post_date":"2014-04-23 10:01:09","post_expired_date":null,"post_slug":"cash-back-with-ebates","next_post_id":"","prev_post_id":"","next_post_slug":"","prev_post_slug":"","next_post_permalink":"","prev_post_permalink":"","device":"android","post_title":"Get Cash Back On All Your Purchases","post_is_expired":false,"post_image":{"570_300":"http:\/\/c454621.r21.cf2.rackcdn.com\/womanfreebies.com\/wp-content\/uploads\/2014\/01\/ebates570x30001242014.jpg"},"post_images":{"full":[{"src":"http:\/\/c454621.r21.cf2.rackcdn.com\/womanfreebies.com\/wp-content\/uploads\/2014\/01\/ebates570x30001242014.jpg","width":"570","height":"300"}]},"post_content":"<!--\r\nHO: 5540\r\n-->\r\nEvery shopping trip has to start somewhere, and I know where your next one should start. <strong>Ebates<\/strong>! That\'s because <strong>Ebates<\/strong> is an incredible site that lets you earn cash back on all your purchases from any of the 1,700 stores available. There are no points, nothing to redeem, you get a percentage of everything you spend when you start at <strong>Ebates<\/strong>. Those stores pay <strong>Ebates<\/strong> a commission for every sale and <strong>Ebates<\/strong> uses that to give you cash back. Everyone ends up happy! They have huge retailers as well like Amazon, Sears, JC Penney and many others. It\'s even <strong>free to join<\/strong>! ","post_excerpt":"You can earn money back on everything you spend. Just <b>join Ebates<\/b> and shop at any of the 1,700 stores and you\'ll be on your way.","post_category":["Black-Friday","Vacations"],"post_category_id":["54","461"],"post_permalink":"\/black-friday\/cash-back-with-ebates\/","post_share_link":"http:\/\/womanfreebies.com\/black-friday\/cash-back-with-ebates\/","post_hyperlink":null,"post_hyperlink_text":null,"post_local_link_text":null,"post_meta_title":null,"post_meta_description":null,"post_offer_id":null,"post_file_id":null,"displaytouser":false}]}';
    }

 

}

?>
