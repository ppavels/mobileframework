mobileframework
===============

This is first commit and push testing.

This repository does not include some files (see git ignore) 

1) in web root , please create .htaccess and there the code below:

#Don't allow any pages to be framed - Defends against CSRF
Header set X-Frame-Options SAMEORIGIN
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteRule     ^$     /public/     [L]
    RewriteRule     (.*)   /public/$1   [L]
</IfModule>

Notes: You might want to remove / on localhost e.g windows wamp server.

2) in public , please create .htaccess and there the code below:

#Don't allow any pages to be framed - Defends against CSRF
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
 
# Rewrite all other URLs to index.php/URL
RewriteRule ^(.*)$ /index.php?url=$1 [QSA]
</IfModule>

Notes: You might want to remove / on localhost e.g windows wamp server.

3) in config , please create config.php and place there the code below (example only):

<?php

/** Development Environment **/
// when Set to false, no error will be throw out, but saved in temp/log.txt file.
define ('DEVELOPMENT_ENVIRONMENT',FALSE);

/** Site Root **/

// Domain name of the site (no slash at the end!)

define('SITE_ROOT' , 'http://womanfreebies.com.local');

define ('DEFAULT_CATEGORY_BASE', "category");
define ('DEFAULT_CATEGORY_BASE_URL', SITE_ROOT.'/'.DEFAULT_CATEGORY_BASE);
define ('DEFAULT_CONTROLLER', "index");
define ('DEFAULT_ACTION', "index");

define ('DEFAULT_POST_CONTROLLER', "post");
define ('DEFAULT_POST_ACTION', "post");

define('MENU_SETTINGS',serialize (
array('category'=>
array(
array('title'=>'Sweepstakes',  'link'=>DEFAULT_CATEGORY_BASE_URL.'/sweepstakes/' ),
array('title'=>'Free Samples',  'link'=>DEFAULT_CATEGORY_BASE_URL.'/free-samples/' ),
array('title'=>'Coupons','link'=>DEFAULT_CATEGORY_BASE_URL.'/coupons/' ),
array('title'=>'Rewards',  'link'=>DEFAULT_CATEGORY_BASE_URL.'/rewards/' ),
array('title'=>'Videos',  'link'=>DEFAULT_CATEGORY_BASE_URL.'/videos/' ),

)
)));
define ('DEFAULT_POST_NUM', 6);  
define ('RELATED_POSTS_COUNT', 4);
define('COUNTRY','us');
define('DEFAULT_POST_IMAGE','http://c452411.r11.cf2.rackcdn.com/wf/loading-us.jpg');
define('FOOTER_SITENAME','womanfreebies.com');
define('FOOTER_URL','http://womanfreebies.com');
define('FAVICON','http://c454621.r21.cf2.rackcdn.com/womanfreebies.com/wp-content/themes/wf_us_9.3/images/icon.gif');
define('TWITTER_VIA','WomanFreebiesUS');

//Google Ads 

define('GOOGLE_AD_CLIENT',"");

define('DFP_UNITS_NUMBER',50);

define('DFP_SLOT_NAME','/00000/00000000000');
define('DFP_SLOT_NUMBER','0000000000');

define('DFP_SLOT_2_NAME','/0000000/00000-00000-00000');
define('DFP_SLOT_2_NUMBER','000000000');

//feed first load
define('FEED_SLOT_1_NUMBER','000000000');
define('FEED_SLOT_2_NUMBER','00000000');

define('SINGLE_COLOR_FIRST_SLOT','00000');
define('SINGLE_COLOR_FIRST_BG','#e895cc');

define('SINGLE_COLOR_SECOND_SLOT','00000000');
define('SINGLE_COLOR_SECOND_BG','#68cff2');

define('SINGLE_COLOR_THIRD_SLOT','0000000');
define('SINGLE_COLOR_THIRD_BG','#FFFF66');
define('SINGLE_AFTER_POST','00000000');

//Google Analytics
define('GOOGLE_ACCOUNT','UA-000000-00000');
define('DIRECT_CALL',FALSE);
define('TRAKING_ID','000');

if(DEVELOPMENT_ENVIRONMENT){
    if (!defined('BASE_API_URL')){
        define('BASE_API_URL', 'http://000000000');
    }
}
else{
    if (!defined('BASE_API_URL')){
define('BASE_API_URL', 'http://00000000000000000');  
    }
}

