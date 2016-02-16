<?php

class SearchController extends Controller {
   private $searchTerm;

    public function __construct($parameters=array()) {
        parent::__construct();
        
        $this->searchTerm=$parameters['s'];
         
    }

    public function search($query1=NULL, $query2=NULL) {
        
        $params=array();
        
        if($query2=='page'){
        $pagination=new Pagination();
        $skip=$pagination->getSkip($query1);
        if(empty($skip)){
          $query1=1;  
        }
        
        $params=array('current_page'=>$query1,'skip'=>$skip, 'limit'=>  (int)DEFAULT_POST_NUM, 'search'=>$this->searchTerm);
       
        
        }else{
        
         $params=array('search'=>$this->searchTerm);
        }
      
        
        //$api=new APICall($params);
        //$url=$api->buidURL();
        //echo $url;
        
        // Load header
        $header=new HeaderController('search');
        $this->assignBlock('header', $header->Render('header'));

        // Load content
        $content=new ContentController('search', $params);
        $this->assignBlock('search', $content->Render('search'));
        
        //Load footer
        $footer = new FooterController('search'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }

}