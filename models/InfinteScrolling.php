<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InfinteScrolling
 *
 * @author alekk
 */
class InfinteScrolling {
    //put your code here
    
    private $asyncPush;
    function __construct($asyncPush=array()) {
        $this->asyncPush=$asyncPush;
    }
    
    function scrollInit($container='#container', $navSelector='#mainNav', $nextSelector='#nextPage', $itemSelector='.white-block'){
        $output="<script type='text/javascript'>";
        $output.=" $(function(){
    
                    var container = $('".$container."');
                    container.infinitescroll({
                    navSelector  : '".$navSelector."',    
                    nextSelector : '".$nextSelector."',  
                    itemSelector : '".$itemSelector."', 
	            loading: {
                        finishedMsg: 'No more offers to load.',
                        animate: false,
                        speed: 1,
                        bufferPx:40,
                        errorCallback: function(){}
                    }
                },";

$share='.share';
$white_block = '.white-block';
$primary_shares = '.primary-shares';
$social_add = '.social-add';
$secondary_shares = '.secondary-shares';
$close_small = '.close-small';


    $output.="function( newElements ) {
		 
$('".$share."').click(function(){
  
  $(this).parents('".$white_block."').css('background','#fff');
  $(this).css('display','none');
  $(this).siblings('".$primary_shares."').css('display','inline-block');
  
});
  
   $('".$social_add."').click(function(){
  
  $(this).parent('".$primary_shares."').css('display','none');
  $(this).parent('".$primary_shares."').next('".$secondary_shares."').css('display','inline-block');
  
});

  $('".$close_small."').click(function(){
  
  $('".$secondary_shares."').css('display','none');
  $('".$share."').css('display','block');
  $('".$white_block."').css('background','#fff url(../../public/img/share-arrow.png) no-repeat left bottom');
  
});
                    var newElems = $( newElements ).css({ opacity: 0 });
                    newElems.imagesLoaded(function(){
                    newElems.animate({ opacity: 1 });";


                 foreach ($this->asyncPush as $asyncPush){
                     $output.=$asyncPush;
                 }

                $output.="            
                });
                 }
                );
               });
              </script>";
              return $output;
     }
}

?>
