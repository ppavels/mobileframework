<?php

/** Check if environment is development and display errors * */
function SetReporting() {
    if (DEVELOPMENT_ENVIRONMENT == true) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors', 'Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
    }
}

/** Check for Magic Quotes and remove them * */
function stripSlashesDeep($value) {
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}

function RemoveMagicQuotes() {
    if (get_magic_quotes_gpc()) {
        $_GET = stripSlashesDeep($_GET);
        $_POST = stripSlashesDeep($_POST);
        $_COOKIE = stripSlashesDeep($_COOKIE);
    }
}

/** Check register globals and remove them * */
function UnregisterGlobals() {

    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', /* '_GET', */ '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

function getRouter() {
    return $safe = array(
        'index',
        'page',
        'post',
        'category',
        'taxonomy',
        'expiring-soon',
        'ajax',
        'search',
        'about',
        'easter-egg-hunt',
        'every-woman-giveaway',
        'NotFoundController',
        'thanksgiving-giveaway',
    );
}

function getClass($controller) {
    $settings = routerSettings();
    if (isset($settings[$controller]['class'])) return $settings[$controller]['class'];
}

function getMethod($controller) {
    $settings = routerSettings();
    return $settings[$controller]['method'];
}

function checkAction($controller, $action) {
    $settings = routerSettings();
    if (array_key_exists('methods', $settings[$controller])) {
        if (in_array($action, $settings[$controller]['methods'])) {
            return TRUE;
        }
    }
}

function getMethods($controller, $action) {
    $settings = routerSettings();
    if (@array_key_exists('methods', $settings[$controller])) {
        if (in_array($action, $settings[$controller]['methods'])) {
            return $action;
        } else {
            return $settings[$controller]['methods'][0];
        }
    }
}

function routerSettings() {
    return $settings = array(
        'index' => array('class' => 'IndexController', 'methods' => array('index')),
        'page' => array('class' => 'IndexController', 'methods' => array('index')),
  //    'about' => array('class' => 'PageController', 'methods' => array('page')),
        'NotFoundController' => array('class' => 'NotFoundController', 'methods' => array('notfound')),
        'post' => array('class' => 'PostController', 'methods' => array('getPost')),
        'category' => array('class' => 'CategoryController', 'methods' => array('category')),
        'taxonomy' => array('class' => 'TaxonomyController', 'methods' => array('taxonomy')),
        'search' => array('class' => 'SearchController', 'methods' => array('search')),
        'ajax' => array('class' => 'AjaxController', 'methods' => array('index')),
        'about' => array('class' => 'AboutController', 'methods' => array('index', 'faq')),
        'expiring-soon' => array('class' => 'IndexController', 'methods' => array('expiring')),
        'easter-egg-hunt' => array('class' => 'EasterEggController', 'methods' => array('index', 'faq', 'official_rules')),
        'thanksgiving-giveaway' => array('class' => 'ThanksgivingController', 'methods' => array('index', 'faq', 'official_rules')),
        'every-woman-giveaway' => array('class' => 'MotherDayController', 'methods' => array('index', 'faq', 'official_rules')),
  //    'download-app' => array('class' => 'DownloadAppController', 'methods' => array('index'))
    );
}

function checkRouter($controller, $return = FALSE) {
    $safe = getRouter();


    if (!in_array($controller, $safe)) {
        $action='';
        if (!$return) {
			
			//not found page
		    if(DEVELOPMENT_ENVIRONMENT){
				throw new Exception('Class ' . $controller . ' Not Found');
				
			}
		   $controllerName = 'NotFoundController';
           $class = getClass($controllerName);
    
           $method = getMethods($controllerName, $action);

    //instantiate the appropriate class
    if (class_exists($class) && (int) method_exists($class, $method)) {
        $construct_params = array();
        if (isset($_GET['s'])) {
            $construct_params['s'] = $_GET['s'];
        }

        $controller = new $class($construct_params);
        $controller->$method();


        //call_user_func_array(array($controller,$action),$query1);
    }
            return FALSE;
        } else {
            return FALSE;
        }
    }
}

//Automatically includes files containing classes that are called
function __autoload($className) {

    //fetch file
    if (file_exists(ROOT . DS . 'controllers' . DS . $className . '.php')) {

        require_once( ROOT . DS . 'controllers' . DS . $className . '.php');
    } else if (file_exists(ROOT . DS . 'models' . DS . $className . '.php')) {
        require_once( ROOT . DS . 'models' . DS . $className . '.php');
    } else if (file_exists(ROOT . DS . 'library' . DS . $className . '.php')) {
        require_once( ROOT . DS . 'library' . DS . $className . '.php');
    } else {

        // Error: Controller Class not found
        die("Error: Class  " . $className . " not found.");
    }
}

/** Main Call Function * */
function CallHook() {

    global $url;
    $controllerName = 'NotFoundController';
    $action = '';
    if (!isset($url)) {

        if (isset($_GET['p']) && is_numeric($_GET['p'])) {
            //echo "POST SHOULD BE";
            $controllerName = DEFAULT_POST_CONTROLLER;
            $action = DEFAULT_POST_ACTION;
        } else {
            $controllerName = DEFAULT_CONTROLLER;
            $action = DEFAULT_ACTION;
        }
        if (isset($_GET['s'])) {
            $controllerName = 'search';
            $action = 'search';
        }
    } else {



        $counter = 1;
        $urlArray = array();
        $urlArray = explode("/", $url);
        
   //    echo "<pre>".print_r($urlArray, TRUE)."</pre>";
        $urlArray = array_filter($urlArray);

        $counter = count($urlArray); 
        
        $routers = getRouter();
        if ($counter == 1) {
            $controllerName = $urlArray[0];
        }

        if ($counter == 2) {
            //exit($urlArray[1]);


            if ($urlArray[0] == 'category') {

                $controllerName = $urlArray[0];
                //next page
                $query2 = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : '';
                //category slug
                $query1 = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : '1';

                if ($query1 != '' && $query2 != NULL) {

                    if ($query1 < 0 || $query1 > 1000) {
                        $query1 = NULL;
                        $query2 = NULL;
                    }
                } else {

                    //404 page
                } 
            } elseif ($urlArray[0] == 'video') {

                $controllerName = 'taxonomy';
                //next page
                $query2 = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : '';
                //taxonomy slug
                $tax = (isset($urlArray[0]) && $urlArray[0] != '') ? $urlArray[0] : '1';
                //subtaxonomy term
                $subtaxonomy = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : '1';
                $query1 = array($tax, $subtaxonomy);

                if ($query1 != '' && $query2 != NULL) {

                    if (count($query1) < 0 || count($query1) > 1000) {
                        $query1 = NULL;
                        $query2 = NULL;
                    }
                } else {

                    //404 page
                } 
            }
            else if ($urlArray[0] == 'send') {
                if ($urlArray[1] == 'ajax') {
                    $controllerName = 'ajax';
                    $action = 'index';
                }
            }
            //pagination starts
            else if ($urlArray[0] == 'page') {

                $controllerName = 'index';
                $query1 = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : DEFAULT_POST_ACTION;
                $query2 = (isset($urlArray[0]) && $urlArray[0] != '') ? $urlArray[0] : DEFAULT_POST_ACTION;

                if ($query2 == 'page' && $query1 != NULL) {
                    // echo "HERE";
                    if ($query1 < 0 || $query1 > 1000) {
                        $query1 = NULL;
                        $query2 = NULL;
                    }
                }

                $action = 'index';

                if (isset($_GET['s'])) {
                    $controllerName = 'search';
                    $action = 'search';
                }

                //pagination ends
            } else {

                //contests pages







                if (!in_array($urlArray[0], $routers)) {
                    $controllerName = 'post';
                    //$action = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[0].":__:".$urlArray[1] : DEFAULT_POST_ACTION;
                    $query1 = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : DEFAULT_POST_ACTION;
                    $query2 = (isset($urlArray[0]) && $urlArray[0] != '') ? $urlArray[0] : DEFAULT_POST_ACTION;
                    $action = 'getPost';
                } else {
                    $controllerName = $urlArray[0];
                    $action = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : DEFAULT_ACTION;
                }
            }
        } else if ($counter == 3) {
       /* this is for subcategories */     
        if ($urlArray[0] == 'category') {
            $controllerName = $urlArray[0];
            //next page
            $query2 = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : '';
            //category slug
            $query1 = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : '1';

            if ($query1 != '' && $query2 != NULL) {

                if ($query1 < 0 || $query1 > 1000) {
                    $query1 = NULL;
                    $query2 = NULL;
                }
            } else {

                //404 page
            }
        }elseif ($urlArray[0] == 'expiring-soon'){
            $controllerName = $urlArray[0];
            //next page
            $query2 = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : '';
            //category slug
            $query1 = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : '1';

            if ($query1 != '' && $query2 != NULL) {

                if ($query1 < 0 || $query1 > 1000) {
                    $query1 = NULL;
                    $query2 = NULL;
                }
            } else {

                //404 page
            }
        }else{
            foreach ($routers as $router) {
                if ($urlArray[0] != $router) {
                    $controllerName = 'post';
                    //$action = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[0].":__:".$urlArray[1] : DEFAULT_POST_ACTION;
                    $query1 = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : DEFAULT_POST_ACTION;
                    $query2 = (isset($urlArray[0]) && $urlArray[0] != '') ? $urlArray[0] : DEFAULT_POST_ACTION;
                    $action = 'getPost';
                } else {
                    // $controllerName = $urlArray[0];
                    //$action = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : DEFAULT_ACTION;
                }
            }
        }
        } else if ($counter == 4) {

            if ($urlArray[0] == 'category' && $urlArray[2] == 'page') {
                $controllerName = $urlArray[0];
                //next page
                $query2 = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : '';
                //category slug
                $query1 = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : '1';

                if ($query1 != '' && $query2 != NULL) {

                    if ($query1 < 0 || $query1 > 1000) {
                        $query1 = NULL;
                        $query2 = NULL;
                    }
                } else {

                    //404 page
                }
            }
            elseif ($urlArray[0] == 'video' && $urlArray[2] == 'page')  { 
                $controllerName = 'taxonomy';
                //next page
                $query2 = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : '';
                //taxonomy slug
                $tax = (isset($urlArray[0]) && $urlArray[0] != '') ? $urlArray[0] : '1';
                //subtaxonomy term
                $subtaxonomy = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : '1';
                $query1 = array($tax, $subtaxonomy);
                
                if ($query1 != '' && $query2 != NULL) {

                    if (count($query1) < 0 || count($query1) > 1000) {
                        $query1 = NULL;
                        $query2 = NULL;
                    }
                } else {

                    //404 page
                } 
            }else {

                //404 page
            }
        }else if ($counter == 5) {

            if ($urlArray[0] == 'category' && $urlArray[3] == 'page') {
                $controllerName = $urlArray[0];
                //next page
                $query2 = (isset($urlArray[4]) && $urlArray[4] != '') ? $urlArray[4] : '';
                //category slug
                $query1 = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : '1';

                if ($query1 != '' && $query2 != NULL) {

                    if ($query1 < 0 || $query1 > 1000) {
                        $query1 = NULL;
                        $query2 = NULL;
                    }
                } else {

                    //404 page
                }
            }
            elseif ($urlArray[0] == 'video' && $urlArray[2] == 'page')  { 
                $controllerName = 'taxonomy';
                //next page
                $query2 = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : '';
                //taxonomy slug
                $tax = (isset($urlArray[0]) && $urlArray[0] != '') ? $urlArray[0] : '1';
                //subtaxonomy term
                $subtaxonomy = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : '1';
                $query1 = array($tax, $subtaxonomy);
                
                if ($query1 != '' && $query2 != NULL) {

                    if (count($query1) < 0 || count($query1) > 1000) {
                        $query1 = NULL;
                        $query2 = NULL;
                    }
                } else {

                    //404 page
                } 
            }else {

                //404 page
            }
        } else {
            //404 page
        }
    }
    if (empty($query1)) {
        $query1 = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : null;
    }
    if (empty($query2)) {

        $query2 = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : null;
    }

    if (isset($_GET['s'])) {
        $controllerName = 'search';
        $action = 'search';
    }
    //modify controller name to fit naming convention
    //exit($controllerName);
    $controllerFound = checkRouter($controllerName);
    if (!$controllerFound) {
        if (!DEVELOPMENT_ENVIRONMENT) {
            
        }
    }

    $redirect=new Redirect();
    // $class = ucfirst($controllerName) . 'Controller';
    $class = getClass($controllerName);
    $action = str_replace("-", "_", $action);
    $method = getMethods($controllerName, $action);

    //instantiate the appropriate class
    if (class_exists($class) && (int) method_exists($class, $method)) {
        $construct_params = array();
        if (isset($_GET['s'])) {
            $construct_params['s'] = $_GET['s'];
        }

        $controller = new $class($construct_params);
        $controller->$method($query1, $query2);

        //call_user_func_array(array($controller,$action),$query1);
    } else {

        // Error: Controller Class not found
        die("1. File <b>'$controllerName.php'</b> containing class <b>'$class'</b> might be missing. <br>2. Method <b>'$action'</b> is missing in <b>'$controllerName.php'</b>");
    }
}

SetReporting();
RemoveMagicQuotes();
UnregisterGlobals();
CallHook();
