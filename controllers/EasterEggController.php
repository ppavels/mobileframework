<?php

class EasterEggController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($query1=NULL, $query2=NULL) {
       
        
        $params=array(); 
       
        $easter_page='contests/easter-egg/index-'.COUNTRY;
     
        $content=new ContentController('easter-egg', $params);
        
        // Load header
        $header=new HeaderController('easter-egg', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        
        $this->assignBlock('easter-egg', $content->Render($easter_page));
        
        //Load footer
        $footer = new FooterController('easter-egg'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }
    public function faq($query1=NULL, $query2=NULL) {
       
        
        $params=array(); 
       
        $easter_page='contests/easter-egg/faq-'.COUNTRY;
     
        $content=new ContentController('easter-egg', $params);
        
        // Load header
        $header=new HeaderController('easter-egg', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        
        $this->assignBlock('easter-egg', $content->Render($easter_page));
        
        //Load footer
        $footer = new FooterController('easter-egg'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }

        public function official_rules($query1=NULL, $query2=NULL) {
       
        
        $params=array(); 
       
        $easter_page='contests/easter-egg/rules-'.COUNTRY;
     
        $content=new ContentController('easter-egg', $params);
        
        // Load header
        $header=new HeaderController('easter-egg', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        
        $this->assignBlock('easter-egg', $content->Render($easter_page));
        
        //Load footer
        $footer = new FooterController('easter-egg'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }

}