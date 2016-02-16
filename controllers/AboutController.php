<?php

class AboutController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($query1=NULL, $query2=NULL) {
       
        
        $params=array(); 
       
        $about_page='about/index-'.COUNTRY;
     
        $content=new ContentController('about', $params);
        
        // Load header
        $header=new HeaderController('about', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        $this->assignBlock('about', $content->Render($about_page));
        
        //Load footer
        $footer = new FooterController('about'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }
    public function faq($query1=NULL, $query2=NULL) {
       
        
        $params=array(); 
       
        $about_page='about/faq-'.COUNTRY;
     
        $content=new ContentController('about', $params);
        
        // Load header
        $header=new HeaderController('about', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        
        $this->assignBlock('about', $content->Render($about_page));
        
        //Load footer
        $footer = new FooterController('easter-egg'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }


}