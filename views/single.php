<section style="margin-top:55px;">

    <div id="container" class=" pad-12 "> 
        <?php echo $googleads->singleHeaderSmall;  ?>
        <?php
        $post_id=-1;
        foreach ($postdata->post as $post) {
            if ($post->shares == 0) {
                $style = 'display: none;';
            } else {
                $style = '';
            }
            $custom = FALSE;
            $post_id=$post->ID;
           
            $cat = explode('/',$post->category);

            if(defined('G_SURVEY') && defined('G_SURVEY_CAT')){
                if(is_string(G_SURVEY_CAT)){
                    $showSurvey = ($cat[1] == G_SURVEY_CAT) ? true : false;
                }else {
                    $showSurvey = G_SURVEY_CAT;
                }
            }else{
                $showSurvey = defined('G_SURVEY') ? true: false;
            }

            if ($post->image == DEFAULT_POST_IMAGE && strripos($post->content, 'div style='))
                $custom = TRUE;
            ?>
            <div class="white-block status-list pad-2 index" style="margin-bottom: 0px; background: #fff; <?php echo ($post->post_type=='list')? 'border-bottom:none':''?>">

                <?php if($showSurvey && (PROJECT_ID == 1 || PROJECT_ID == 6)){ ?>
                <div class="p402_premium">
                    <div class="p402_hide">
                        <?php } ?>
                <div class="head clickshares" id="title-<?=$post_id; ?>">
                    <h1 class="">

                            <a class='post_title ga_title hyperlink'  id="button-<?=$post_id; ?>" href="<?php echo $post->hyperlink; ?>"><?php echo $post->title; ?></a>

                    </h1>
                </div>

                <?php
                $Social = new SocialButtons($post);
                $Social->place_buttons();
                ?>
                        <?php if($showSurvey && PROJECT_ID != 1 && PROJECT_ID != 6){ ?>
                        <div class="p402_premium">
                            <div class="p402_hide">
                                <?php } ?>
                <div class="index-img-single ga_image clickshares" id="image-<?=$post_id; ?>" <?php if ($custom == TRUE) echo 'style="display:none"' ?> > 
                   <?php  if ($post->image != DEFAULT_POST_IMAGE) { ?>
                        <div class="index-centered-img">
                            <a href="<?php echo $post->hyperlink; ?>" class="hyperlink-img" target="_blank"><img class="swipe-img" src="<?php echo $post->image; ?>" alt="<?php echo $post->title; ?>" style="width: 100%;"/></a>
                        </div>
                <?php }?>
                </div>
                <div class="clear"></div>

            <?php if ($custom == TRUE) { ?>

                    <span class="date"><?php echo $post->date; ?></span> 
                    <div class="head">
                        <p><?php echo str_replace('width="1"', 'style="display:none"', $post->content); ?></p>
                    </div>
                <?php } else { ?>

                    <span class="date"><?php echo $post->date; ?></span>

                    <?php echo $post->inCategory; ?>
                    <span class="date expired"> 
                        <?php echo $post->post_expired_date; ?> 
                    </span>              

                   
                    <div class="head content clickshares" id="button-<?=$post_id; ?>">
                        <p><?php
                            if(defined('CONTENT_CDN_BUCKET')) {
                                echo str_replace('//'.$_SERVER['HTTP_HOST'] . '/wp-content/uploads', '//'.CONTENT_CDN_BUCKET . '/wp-content/uploads', $post->content);
                            }else {
                                echo $post->content;
                            }?></p>
                    </div>
                <?php } ?>

                <?php $Social->place_buttons('bottom');?>

                    <?php
                    if ($post->post_type == 'list') {
                        if ($post->list) {
                            ?>

                        <ul class="status-list pad-2 indexlist" style="margin-bottom: 10px;">
            <?php foreach ($post->list as $listItem) { ?>


                                <li style="list-style: none; ">          
                                    <div class="status-list pad-2 index indexlist" >
                                        <div class="index-img-single"> 
                                            <div class="index-centered-img list-img">
                                                <a target="_blank"  href="<?php echo $listItem['list_hyperlink']; ?>"><img src="<?php echo $listItem['list_image']; ?>" alt="<?php echo $listItem['list_title']; ?>" title="<?php echo $listItem['list_title']; ?>"/></a>
                                            </div>
                                        </div> 
                                        <div class="head">
                                            <a target="_blank" href="<?php echo $listItem['list_hyperlink']; ?>"><?php echo $listItem['list_title']; ?></a>

                                        </div>
                                        <div class="head">
                                            <p><?php echo $listItem['list_content']; ?></p>
                                        </div>
                                        
            <div class="clear"></div>
                                    </div>
                                </li>
            <?php } ?>
                        </ul>        
        <?php } ?>
    <?php } ?>

                        <?php if($showSurvey){ ?>
                    </div><!-- p402_hide-->
                </div><!-- p402_premium-->
            <?php } ?>





            </div>





     <div >
    <?php echo $googleads->googleSingleAfterPostR; ?>
    </div>              


            <div class="nav-div" style="display: none">
                <div style="max-width: 460px; margin: 0 auto;">
                    <div class="nav-next">
                    <?php if ($post->permalink_next) { ?>
                            <a href="<?php echo $post->permalink_next; ?>">Previous Post</a>
                        <?php } else { ?><a href="#">Previous Post</a><?php } ?>
                    </div>
                    <div id="nav-separator"></div>
    <?php if ($post->permalink_prev) { ?>
                        <div class="nav-prev">
                            <a href="<?php echo $post->permalink_prev; ?>">Next Post</a>
            <?php } else { ?><a href="#">Next Post</a><?php } ?>
                    </div>
                </div>
            </div>
<?php
}

if (property_exists($postdata, 'related') &&  (count((array)$postdata->related))!= 0) {
    $tr_count = 0;
    ?>

            <div class="related index">
                <h1 class="post_title">More Related Offers</h1>
                <table> 
                    <tr>
    <?php
    $counterX = 0;
    foreach ($postdata->related as $related) {
        
        if ($related->post_image != '') {
            
            ?>

                                <td>
                                    <div class="related-img">
                                        <a  href="<?php echo $related->post_permalink; ?>" id="<?php echo $related->post_id; ?>">
                                            <img src="<?php echo $related->post_image; ?>" alt="<?php echo $related->post_title; ?>" title="<?php echo $related->post_title; ?>" />
                                            <p><?php echo $related->post_title; ?></p>
                                        </a>
                                    </div>    
                                </td>

            <?php if (++$counterX % 2 === 0) { ?>
                                </tr><tr>
            <?php
            }
        }
    }
    ?>
                    </tr>
                </table>   
            </div>

<?php } ?>


<?php //$commercialads->ShowCommercialAds; ?>
                    
    
<input type="hidden" id="trackpost" value="<?php echo $post_id; ?>" />
    </div>

<?php echo $pagedata->swip; ?>

</section>
<?php //echo $googleads->SingleAfterPost; ?>