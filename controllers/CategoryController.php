<?php

class CategoryController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function category($query1=NULL, $query2=NULL) {
        
        $params=array('category'=>$query1);
        
        if(is_numeric($query2)){
        $pagination=new Pagination();
        $skip=$pagination->getSkip($query2);
        if(empty($skip)){
          $query2=1;  
        }
        
        $params=array('category'=>$query1, 'current_page'=>$query2,'skip'=>$skip, 'limit'=>  (int)DEFAULT_POST_NUM
        );
        
        }
        
         $content=new ContentController('category', $params);
        
        // Load header
        
        $header=new HeaderController('category', $content->PostCall, $params);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        
        $this->assignBlock('category', $content->Render('category'));
        
        //Load footer
        $footer = new FooterController('category'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }

}