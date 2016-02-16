<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Redirect
 *
 * @author ppavels
 */
class Redirect {
    
    public function __construct() {

        if (defined('REDIRECT_TO_APP_PAGE') && REDIRECT_TO_APP_PAGE) {
            if (PROJECT_ID == 1 || PROJECT_ID == 6) {
                $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
                $actual_link = "//" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                if (stripos($ua, 'android') !== false) { // && stripos($ua,'mobile') !== false) {
                    if (!isset($_COOKIE['red_pg_shown'])) {
                        if (!isset($_COOKIE['red_pg_shown_times']) || !isset($_COOKIE['red_pg_shown_times']) < 10) {
                            if (!isset($_COOKIE['red_pg_skip']) && !isset($_COOKIE['red_pg_android'])) {
                                header('Location: //' . $_SERVER['HTTP_HOST'] . '/app/download-app.php?' . $actual_link);
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }
}
