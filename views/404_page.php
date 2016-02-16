<pre><?php //echo print_r($postdata, TRUE); ?></pre>
<section style="margin-top:55px;">

    <div id="container" class=" pad-12"> 
            <div class="white-block status-list pad-2 index page_404" style="margin-bottom: 0px; background: #fff; <?php //echo ($post->post_type=='list')? 'border-bottom:none':''?>">
                
  <h1 class="post_title" style="text-align: center;color:#000; margin-top: 5px; margin-bottom: 10px">Sorry, this offer is no longer available.<br/>
        But, maybe you'll enjoy these...</h1>
       <?php $counter = 0; ?>

        <?php foreach ($postdata->post as $post) {
          
            ?>
    <?php if ($counter == 0) {
       /* SINGLE POST STARTS */ ?>
                
                <div class="index-img-single ga_image" <?php //if ($custom == TRUE) echo 'style="display:none"' ?> > 
                    <div class="index-centered-img">
                        <a href="<?php echo $post->permalink; ?>" class="fl"><img src="<?php echo $post->image; ?>" alt="<?php echo $post->title; ?>" style="width: 100%;"/></a>
                    </div>
                    <div class="head content" style="margin: -5px 10px 15px 10px;">
                        <p><?php echo $post->title; ?></p>
                    </div>
                </div> 
<div style="height: 1px; background-color: black; text-align: center">
                    <span style="background-color: white; position: relative; top: -0.7em; color:#000;font-style: italic">&nbsp;
                        Or check out the top related offers&nbsp;
                    </span>
                </div>
                  
                
        <div class="related index">
                
                
                <table style="margin-top:100px"> 
                    <tr>         
<?php /* SINGLE POST ENDS */

    } else { ?>
     <td>
                                    <div class="related-img">
                                        <a  href="<?php echo $post->permalink; ?>">
<?php 
        $count = null; $image = $post->image;
        $image = preg_replace('/(.*\\/)(.*$)/', '$1normal/ldpi/$2', $image, -1, $count); ?>
                                            <img class="swipe-img" src="<?php echo $image; ?>" alt="<?php echo $post->title; ?>" style="width: 100%;">
                                            <p><?php echo $post->title; ?></p>
                                        </a>
                                    </div>    
                                </td>
                                
    <?php 
    if(($counter%2) == 0){echo '</tr><tr>';}
    } ?>

                    
 <?php /* RELATED POST STARTS */ ?>                   
            
                         
    <?php /* RELATED POST ENDS */ ?>                
                    <?php $counter++;
                } ?>
                                       </tr>

                </table>   
                <div style="height: 1px; background-color: black; text-align: center;margin-top: 15px;">
                    <span style="background-color: white; position: relative; top: -0.7em; color:#000;font-style: italic">&nbsp;
                        Not interested in the above offers? &nbsp;
                    </span>
                </div>
            </div>
        <div class='search'>
                 <form action="<?php echo SITE_ROOT; ?>" method='GET' style="text-align: center; margin-bottom: 10px" >
                     <input name='s'placeholder='Search for more offers' style="" id="input_s"/>
                    <input type="submit" value="" id="searchsubmit" class="srch-btn">
                </form>
        </div>
  </div>

    </div>

</section>