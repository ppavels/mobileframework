<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Post
 *
 * @author menu
 */
class Post {
    //put your code here
    private $postId;
    function __construct($postId=NULL) {
        $this->postId=$postId;
    }
    
     
    
    function __set($name, $value) {
        $this->$name= $value;
    }
}
