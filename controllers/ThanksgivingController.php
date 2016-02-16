<?php

class ThanksgivingController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($query1=NULL, $query2=NULL) {
       
        
        $params=array(); 
       
        $easter_page='contests/thanksgiving/index-'.COUNTRY;
     
        $content=new ContentController('thanksgiving', $params);
        
        // Load header
        $header=new HeaderController('thanksgiving', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        
        $this->assignBlock('thanksgiving', $content->Render($easter_page));
        
        //Load footer
        $footer = new FooterController('thanksgiving'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }
    public function faq($query1=NULL, $query2=NULL) {
       
        
        $params=array(); 
       
        $easter_page='contests/thanksgiving/faq-'.COUNTRY;
     
        $content=new ContentController('thanksgiving', $params);
        
        // Load header
        $header=new HeaderController('thanksgiving', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        
        $this->assignBlock('thanksgiving', $content->Render($easter_page));
        
        //Load footer
        $footer = new FooterController('thanksgiving'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }

        public function official_rules($query1=NULL, $query2=NULL) {
       
        
        $params=array(); 
       
        $easter_page='contests/thanksgiving/rules-'.COUNTRY;
     
        $content=new ContentController('thanksgiving', $params);
        
        // Load header
        $header=new HeaderController('thanksgiving', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        
        $this->assignBlock('thanksgiving', $content->Render($easter_page));
        
        //Load footer
        $footer = new FooterController('thanksgiving'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }

}