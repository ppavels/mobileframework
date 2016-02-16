<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajax
 *
 * @author alekk
 */
class ajax {

    private $timeout, $base_url, $social_network, $url;

    function __construct() {

        $this->timeout = 10;
       //echo print_r($_GET);
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'sharesave':
                    if (isset($_GET['url'])) {
                         $this->url = $this->filterURL($_GET['url']);
                    }

                    break;

                default :
                    break;
            }
        }
    }

    private function sendShare() {
        
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

    private function get_file_contents_curl() {
        
    }

}

new ajax();
?>
