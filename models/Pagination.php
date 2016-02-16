<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagination
 *
 * @author menu
 */
class Pagination {
    //put your code here
    
    public function __construct() {
        ;
    }
    
    public function getSkip($page_num=0) {
        if(empty($page_num)){
            $skip=0;
        }
        else {
            $skip=((int)$page_num-1)*(int)DEFAULT_POST_NUM;
        }
        return $skip;
        
        //echo DEFAULT_POST_NUM;
        
    }

    
    public function previousLink($params){
        
        if(isset($params['current_page'])){
          $cpage =$params['current_page']; 
        }
        else{
           $cpage = 1; 
        }
        $previous_page=$cpage - 1;
        
        if($previous_page>0){
         return (int)$previous_page;
        }
         
    }
    
    public function nextLink($params, $total_pages){
        
        if(isset($params['current_page'])){
          $cpage =$params['current_page']; 
        }
        else{
           $cpage = 1; 
        }
        $next_page=$cpage + 1;
        
        if($next_page<=$total_pages){
         return (int)$next_page;
        }
         
    }
    
    public function pagesList($itemscount, $itemsperpage, $cpage) {
        $itemscount = 123; // total posts number
        $itemsperpage = (int)DEFAULT_POST_NUM; // posts on page
        
        if (isset($_REQUEST['page'])) {
            $cpage = $_REQUEST['page'];
        } else {
            $cpage = 1;
        }   // 1st page on default
        
        $pagedisprange = 3; // number of pages shown before and after current page
        $pagescount = ceil($itemscount / $itemsperpage); // number of pages
        $stpage = $cpage - $pagedisprange; // defines the initial page number
        if ($stpage < 1) {
            $stpage = 1;
        } // eto ponyatno
        $endpage = $cpage + $pagedisprange; // output till..
        if ($endpage > $pagescount) {
            $endpage = $pagescount;
        } 
        if ($cpage > 1) {
            // first
            echo '<a href="?page=1"><<</a> ';
            // prev
            echo '<a href="?page=' . ($cpage - 1) . '"><</a> ';
        }
        if ($stpage > 1)
            echo '... '; 
        for ($i = $stpage; $i <= $endpage; $i++) {
            if ($i == $cpage) {
                echo '<strong>' . $i . '</strong> ';
            } else {
                echo '<a href="?page=' . $i . '">' . $i . '</a> ';
            }
        }
        if ($endpage < $pagescount)
            echo '... '; 
        if ($cpage < $pagescount) {
            // next
            echo '<a href="?page=' . ($cpage + 1) . '">></a> ';
            // last
            echo '<a href="?page=' . $pagescount . '">>></a> ';
        }
    }
    
    
    
    
    
}
