<?php

class MotherDayController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($query1=NULL, $query2=NULL) {
       
        
        $params=array(); 
       
        $mother_page='contests/every-woman-giveaway/index-'.COUNTRY;
     
        $content=new ContentController('every-woman-giveaway', $params);
        
        // Load header
        $header=new HeaderController('every-woman-giveaway', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        
        $this->assignBlock('every-woman-giveaway', $content->Render($mother_page));
        
        //Load footer
        $footer = new FooterController('every-woman-giveaway'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }
    public function faq($query1=NULL, $query2=NULL) {
       
        
        $params=array(); 
       
        $easter_page='contests/every-woman-giveaway/faq-'.COUNTRY;
     
        $content=new ContentController('every-woman-giveaway', $params);
        
        // Load header
        $header=new HeaderController('every-woman-giveaway', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        
        $this->assignBlock('every-woman-giveaway', $content->Render($easter_page));
        
        //Load footer
        $footer = new FooterController('every-woman-giveaway'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }

        public function official_rules($query1=NULL, $query2=NULL) {
       
        
        $params=array(); 
       
        $easter_page='contests/every-woman-giveaway/rules-'.COUNTRY;
     
        $content=new ContentController('every-woman-giveaway', $params);
        
        // Load header
        $header=new HeaderController('every-woman-giveaway', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        
        $this->assignBlock('every-woman-giveaway', $content->Render($easter_page));
        
        //Load footer
        $footer = new FooterController('every-woman-giveaway'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }

}