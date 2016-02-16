<?php

class TaxonomyController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function taxonomy($query1=NULL, $query2=NULL) {
        
        $params=array('taxonomy'=>$query1[0], 'subtaxonomy'=>$query1[1]);
        
        if(is_numeric($query2)){
        $pagination=new Pagination();
        $skip=$pagination->getSkip($query2);
        if(empty($skip)){
          $query2=1;  
        }
        
        $params=array('taxonomy'=>$query1[0], 'subtaxonomy'=>$query1[1], 'current_page'=>$query2,'skip'=>$skip, 'limit'=>  (int)DEFAULT_POST_NUM
        );
        
        }
        
         $content=new ContentController('taxonomy', $params);
        
        // Load header
        
        $header=new HeaderController('taxonomy', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        
        $this->assignBlock('taxonomy', $content->Render('taxonomy'));
        
        //Load footer
        $footer = new FooterController('taxonomy'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }

}