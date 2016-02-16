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

            if ($post->image == DEFAULT_POST_IMAGE && strripos($post->content, 'div style='))
                $custom = TRUE;
            ?>
            <div class="white-block status-list pad-2 index" style="margin-bottom: 0px; background: #fff; <?php echo ($post->post_type=='list')? 'border-bottom:none':''?>">
                <div class="head clickshares" id="title-<?=$post_id; ?>">
                    <h1 class="">
                        <a class='post_title ga_title hyperlink' target="_blank" id="button-<?=$post_id; ?>" href="<?php echo $post->hyperlink; ?>"><?php echo $post->title; ?></a>
                    </h1>
                </div>

                <?php
                $Social = new SocialButtons($post);
                $Social->place_buttons();
                ?>

                <div class="index-img-single ga_image clickshares" id="image-<?=$post_id; ?>" <?php if ($custom == TRUE) echo 'style="display:none"' ?> >
                    <?php
                    $slider = $post->_wf_slider_group;
                    $is_slider = false;
                    $slideType = ($post->is_slider_post == 1)?'slide':'list';
                    $slide_content = '';
                    $buttons = '';
                    $key = (isset($_GET['slide']))?(int)$_GET['slide']:1;

                    if($slideType == 'slide' && isset($slider[$key-1])){
                        $is_slider = true;
                        $sid = "slider";
                        $slide_content = '<div class="slide' . $key . '"><div class="slide_container">' . $slider[$key-1] . '</div></div>';

                        $buttons = (isset($slider[$key]))?'<a href="?slide='.($key+1).'" class="control_next">></a>':'';
                        $buttons .= ($key != 1)?'<a href="?slide='.($key-1).'" class="control_prev"><</a>':'';

                    }elseif($slideType == 'list'){
                        $sid = "list";
                        $slide_content = '<ol>';
                        foreach ($slider as $key => $slide) {
                            if (trim($slide) != '') {
                                $is_slider = true;
                                $slide_content .= '<li class="slide' . ($key + 1) . '"><div class="slide_container">' . $slide . '</div></li>';
                            }
                        }
                        $slide_content .= '</ol>';
                    }

                    if ($is_slider) {
                        ?>
                        <div id="<?php echo $sid; ?>">
                            <?php echo $buttons;?>
                            <?php echo $slide_content; ?>
                        </div>
                    <?php } else { ?>
                        <div class="newpost_image ga_image">
                            <a id="image-<?php the_ID(); ?>" target="_blank" href="<?php echo $hyperlink; ?>"><img
                                    src="<?php echo $imgsrc; ?>" alt="<?php the_title(); ?>"
                                    title="<?php if (get_post_meta($post->ID, "hyperlink text", true) != "") {
                                        echo get_post_meta($post->ID, "hyperlink text", true);
                                    } else {
                                        the_title();
                                    } ?>"/></a>
                        </div>
                    <?php }//if ($is_slider) ?>

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
                                echo str_replace($_SERVER['HTTP_HOST'] . '/wp-content/uploads', CONTENT_CDN_BUCKET . '/wp-content/uploads', $post->content);
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


    
<input type="hidden" id="trackpost" value="<?php echo $post_id; ?>" />
    </div>

<?php echo $pagedata->swip; ?>

</section>
<?php //echo $googleads->SingleAfterPost; ?>