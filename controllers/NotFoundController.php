<?php

class NotFoundController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function notfound($query1=NULL, $query2=NULL) {
         
        
        $params=array('error'=>'1' );
       
        $content=new ContentController('404_page', $params);
        
        $header=new HeaderController('404_page');
        $this->assignBlock('header', $header->Render('header'));

        // Load content
     //   $content=new ContentController('404_page');
        $this->assignBlock('404_page', $content->Render('404_page'));
        
        //Load footer
        $footer = new FooterController('404_page'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }
    public function contentNotFound($query1=NULL, $query2=NULL) {
         
          $params=array('error'=>'1' );
       
        $content=new ContentController('404_page', $params);
        
        $header=new HeaderController('404_page');
        $this->assignBlock('header', $header->Render('header'));

        // Load content
     //   $content=new ContentController('404_page');
        $this->assignBlock('404_page', $content->Render('404_page'));
        
        //Load footer
        $footer = new FooterController('404_page'); 
        $this->Assign('footer', $footer->Render('footer'));
        exit();
        
    }

}