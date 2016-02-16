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
class HeaderController extends View {

    // HEADER
    private $this_post_id;
    public function __construct($page, $PostCall = NULL, $params=array()) {

       // echo "<pre>".print_r($params, TRUE)."</pre>"; exit;
	   if(is_array($PostCall)&&array_key_exists('post', $PostCall)){
		if(count($PostCall['post']==1)){
	    $this->this_post_id=$PostCall['post'][0]['post_id'];
		}
		else{
			$this->this_post_id=-1;
		}
	    }



        parent::__construct();
        
        $this->setFavIcon(FAVICON);

        //CSS adding
        //$this->setCSSFile('//fonts.googleapis.com/css?family=Fauna+One|Londrina+Outline', TRUE);
        //$this->setCSSFile('//fonts.googleapis.com/css?family=Open+Sans', TRUE);
        //$this->setCSSFile('public' . DS . 'css' . DS . 'style.css');


        $this->assignValue(SITE_ROOT, 'pagedata', 'home');
        if($this->this_post_id!=-1){
            $this->assignValue($this->this_post_id, 'pagedata', 'post_id');
        }
        else{
            $this->assignValue('', 'pagedata', 'post_id');
        }
		$this->assignValue('', 'pagedata', 'easterinit');
		$this->assignValue('', 'pagedata', 'signup_popup');
//
		$this->assignValue('', 'pagedata', 'whiteheader');
        $this->assignValue('', 'pagedata', 'headersingle');
        $this->assignValue('', 'pagedata', 'logosingle');
        $menu = new MenuNav(unserialize(MENU_SETTINGS));
        $this->assignValue($menu->getMenu(), 'pagedata', 'menu');
        $this->assignValue('', 'googleads', 'Init');

        $this->setMetaTag('description', $PostCall['meta_description']);
        $this->setMetaTitle($PostCall['meta_title']);
        $this->assignValue($PostCall['meta_title'], 'pagedata', 'title');

        $header = new HeaderModel($PostCall);
        $init = $header->init();
        
        
        
        $this->assignValue($header->googleAnalytics(), 'pagedata', 'google_analytics');
        $this->assignValue($init, 'pagedata', 'init');

        
        switch ($page) {
           case 'index':
           case 'expiring':
                //$this->setMetaTag('keywords', '');

                $social = new SocialButtons();
                $this->assignValue($social->like_header(), 'pagedata', 'whiteheader');
                $this->assignValue($PostCall, 'pagedata', 'obj');
                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->googleHeadeInit(), 'googleads', 'Init');
                break;
            case 'post':
                
                $this->assignValue($header->getwhiteheader(), 'pagedata', 'whiteheader');
                $this->assignValue($header->headerclass(), 'pagedata', 'headersingle');
                $this->assignValue($header->logoclass(), 'pagedata', 'logosingle');
				
                break;
            case 'category':

                if (isset($params['category'])) {
                    $this->assignValue($params['category'], 'pagedata', 'category');
                    $social = new SocialButtons($params['category']);
                } else {
                    $this->assignValue('UNDEFINED', 'pagedata', 'category');
                    $social = new SocialButtons();
                }

                $this->assignValue($social->like_header(), 'pagedata', 'whiteheader');
                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->googleHeadeInit(), 'googleads', 'Init');
                $this->assignValue($params, 'pagedata', 'category_id');
                break;
                
            case 'taxonomy':


                if (isset($params['taxonomy'])) {
                    $this->assignValue($params['taxonomy'], 'pagedata', 'taxonomy');
                } else {
                    $this->assignValue('UNDEFINED', 'pagedata', 'taxonomy');
                }
                $social = new SocialButtons();
                $this->assignValue($social->like_header(), 'pagedata', 'whiteheader');
                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->googleHeadeInit(), 'googleads', 'Init');
                break;
            case '404_page':
                $this->setMetaTag('description', '404 Page Not Found');

                $this->setMetaTitle('404 Page Not Found');
                $this->assignValue("404 Page Not Found", 'pagedata', 'title');
                $social = new SocialButtons();
                $this->assignValue($social->like_header(), 'pagedata', 'whiteheader');

                break;

            case 'search':


                $googleAds = new GoogleAds();
                $this->assignValue($googleAds->googleHeadeInit(), 'googleads', 'Init');
                $social = new SocialButtons();
                $this->assignValue($social->like_header(), 'pagedata', 'whiteheader');
                break;
            case 'easter-egg':
                $this->setMetaTag('description', 'Join us ladies on a virtual hunt for big prizes!');

                $this->setMetaTitle('Easter Egg Hunt');
                $this->assignValue("Easter Egg Hunt", 'pagedata', 'title');
               
                $this->assignValue('', 'googleads', 'Init'); 
                
                $this->setCSSFile('public' . DS . 'css' . DS . 'easter-egg.css');
                break;
            
            case 'thanksgiving':

                $this->setMetaTag('description', 'The 2014 Gobble Gobble Giveaway');

                $this->setMetaTitle('The 2014 Gobble Gobble Giveaway');
                $this->assignValue("The 2014 Gobble Gobble Giveaway", 'pagedata', 'title');
               
                $this->assignValue('', 'googleads', 'Init'); 
                
                $this->setCSSFile('public' . DS . 'css' . DS . 'thanksgiving.css');
                break;
            
            case 'every-woman-giveaway':

                $this->setMetaTag('description', 'Join us ladies on a virtual hunt for big prizes!');

                $this->setMetaTitle('Mother\'s day');
                $this->assignValue("Mother's day", 'pagedata', 'title');
               
                $this->assignValue('', 'googleads', 'Init'); 
                
                $this->setCSSFile('public' . DS . 'css' . DS . 'every-woman-giveaway.css');
                break;
                  
            case 'about':

                $this->setMetaTag('description', '');

                $this->setMetaTitle('About The WomanFreebies.com Team');
                $this->assignValue("About The WomanFreebies.com Team", 'pagedata', 'title');
               
                $this->assignValue('', 'googleads', 'Init'); 
                
                $this->setCSSFile('public' . DS . 'css' . DS . 'about.css');
                break;
                  
            case 'download-app':      
                
                $this->setCSSFile('public' . DS . 'css' . DS . 'download-app.css');
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

?>
