<?php
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HuntModel
 *
 * @author alekk
 */
class HuntModel {

    public function __construct() {
        ;
    }

    public function getSession() {
        $wwifirst = false;

        if (!empty($_COOKIE['wwiu']))
            $wwiuuid = $_COOKIE['wwiu'];
        else {
            $wwiuuid = $this->uuid();
            setcookie('wwiu', $wwiuuid, time() + 5184000, '/');  // expire in 60 days
            $wwifirst = true;
        }

        $_SESSION['envelope'] = $this->uuid();
        $session = json_encode($_SESSION['envelope']);

        return $session;
    }

    private function uuid() {

        return sprintf('%04x%04x%04x%03x4%04x%04x%04x%04x', mt_rand(0, 65535), mt_rand(0, 65535), // 32 bits for "time_low"
                        mt_rand(0, 65535), // 16 bits for "time_mid"
                        mt_rand(0, 4095), // 12 bits before the 0100 of (version) 4 for "time_hi_and_version"
                        bindec(substr_replace(sprintf('%016b', mt_rand(0, 65535)), '01', 6, 2)),
                        // 8 bits, the last two of which (positions 6 and 7) are 01, for "clk_seq_hi_res"
                        // (hence, the 2nd hex digit after the 3rd hyphen can only be 1, 5, 9 or d)
                        // 8 bits for "clk_seq_low"
                        mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535) // 48 bits for "node" 
        );
    }

}

?>
