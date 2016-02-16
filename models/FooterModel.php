<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FooterModel
 *
 * @author P
 */
class FooterModel {

    //put your code here
            private $calldata, $post, $isVideo;

    public function __construct($PostCall = NULL) {
        $this->calldata = $PostCall;
        isset($this->calldata['post'][0]) ? $this->post = $this->calldata['post'][0] : $this->post = FALSE;
        if ($PostCall['post'][0]['is_video_post']==1){
            $this->isVideo=TRUE;
        }else{
            $this->isVideo=FALSE;
        }
    }

    public function init() {
        $output = '';
        $checkVideo = (PROJECT_ID == 1 || PROJECT_ID == 6)? 1 : !$this->isVideo;
        $sendGA = (PROJECT_ID == 1 || PROJECT_ID == 6)?'var url = window.location.href;
                        if ($(".t402-elided").length > 0)
                            ga("send", "event", "Survey", "Load", url);':'';
        if(defined('G_SURVEY') && $checkVideo){
            $output.= '<!-- google consumer surveys --><script type="text/javascript">
(function(){ var ARTICLE_URL = window.location.href; var CONTENT_ID = \'everything\'; document.write( \'<scr\'+\'ipt \'+ \'src="//survey.g.doubleclick.net/survey?site='.G_SURVEY.'\'+ \'&url=\'+encodeURIComponent(ARTICLE_URL)+ (CONTENT_ID ? \'&cid=\'+encodeURIComponent(CONTENT_ID) : \'\')+ \'&random=\'+(new Date).getTime()+ \'" type="text/javascript">\'+\'\x3C/scr\'+\'ipt>\'); } )();

            document.addEventListener("DOMContentLoaded", doSurvey, false);

            function doSurvey(){
                (function($){
                    try { _402_Show(); '.$sendGA.' } catch(e) { console.log("survey error"); }
                })(jQuery);
            }
            </script>';
        }
        return $output;
    }

}