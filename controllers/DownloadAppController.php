<?php

class DownloadAppController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($query1=NULL, $query2=NULL) {
       
        
        $params=array(); 
       
        $download_app='download-app';
     
        $content=new ContentController('download-app', $params);
        
        // Load header
        $header=new HeaderController('download-app', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        $this->assignBlock('download-app', $content->Render($download_app));
        
        //Load footer
        $footer = new FooterController('download-app'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }


}