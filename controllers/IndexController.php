<?php

class IndexController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($query1=NULL, $query2=NULL) {

        $params=array();
       
        if($query2=='page'){
        $pagination=new Pagination();
        $skip=$pagination->getSkip($query1);
        if(empty($skip)){
          $query1=1;  
        }
        
        $params=array('current_page'=>$query1,'skip'=>$skip, 'limit'=>  (int)DEFAULT_POST_NUM
        );
        
        }
     
         $content=new ContentController('index', $params);
        
        // Load header
        $header=new HeaderController('index', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content
       
        $this->assignBlock('index', $content->Render('index'));
        
        //Load footer
        $footer = new FooterController('index'); 
        $this->Assign('footer', $footer->Render('footer'));
        
        
    }

    public function expiring($query1=NULL, $query2=NULL) {

        $params = array();
        if ($query2 == 'page') {
            $pagination = new Pagination();
            $skip = $pagination->getSkip($query1);
            if (empty($skip)) {
                $query1 = 1;
            }

            $params = array('current_page' => $query1, 'skip' => $skip, 'limit' => (int)DEFAULT_POST_NUM
            );

        }
        $params['expiring'] = true;
        $content = new ContentController('expiring', $params);

        // Load header
        $header = new HeaderController('expiring', $content->PostCall);
        $this->assignBlock('header', $header->Render('header'));

        // Load content

        $this->assignBlock('expiring', $content->Render('expiring'));

        //Load footer
        $footer = new FooterController('expiring');
        $this->Assign('footer', $footer->Render('footer'));


    }

}