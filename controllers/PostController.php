<?php

class PostController extends Controller{
    public $post, $model;
    public function __construct($query1=NULL, $query2=NULL) {
		
		parent::__construct();
                 
	}
	  
	
        
        public function getPost($post_slug, $category){ 
	    $params=array('post_id'=>$post_slug);
            $this->loadPost($params);        
   	    }
        
        private function loadPost($params){
        $content=new ContentController('post', $params);
        
      //  echo "<pre>".print_r($content->PostCall, TRUE)."</pre>";
            	// Load header
        $header=new HeaderController('post', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        if ($content->PostCall['post'][0]['post_slug']=='promoted'){
            $this->assignBlock('promoted', $content->Render('promoted'));
        }elseif ($content->PostCall['post'][0]['is_video_post']==1){
            $this->assignBlock('video', $content->Render('video'));
        }elseif (isset($content->PostCall['post'][0]['is_slider_post']) && $content->PostCall['post'][0]['is_slider_post'] != 0 ){
            $this ->assignBlock('slider', $content->Render('slider'));   
        }else{
            $this->assignBlock('single', $content->Render('single'));
        }
        //Load footer
        $footer = new FooterController('post', $content->PostCall);
        $this->Assign('footer', $footer->Render('footer'));
        }

}