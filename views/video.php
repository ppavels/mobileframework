<?php /* ?>
  <div style="width:100%; height:700px; background:#ffffff; color:#000; padding:50px">


  <pre><?php echo print_r($postdata, TRUE); ?></pre>

  <?php  echo $postdata->max_num_pages."<br/>";
  echo $postdata->found_posts."<br/>";
  echo print_r($postdata->post)."<br/>";

  ?>


  </div>

  <?php */ ?>

    <section style="margin-top:55px;">
        <div id="container" class=" pad-12 ">
            <?php echo $googleads->singleHeaderSmall; ?>
            <?php
            foreach ($postdata->post as $post) {
                $custom = FALSE;
                if ($post->image == DEFAULT_POST_IMAGE && strripos($post->content, 'div style='))
                    $custom = TRUE;

                $cat = explode('/',$post->category);
                if(defined('G_SURVEY') && defined('G_SURVEY_CAT')){
                    if(is_string(G_SURVEY_CAT)){
                        $showSurvey = (in_array(G_SURVEY_CAT,$cat)) ? true : false;
                    }else {
                        $showSurvey = G_SURVEY_CAT;
                    }
                }else{
                    $showSurvey = defined('G_SURVEY') ? true: false;
                }
                ?>
                <div class="white-block status-list pad-2 index swipe-img"
                     style="margin-bottom: 0px; background: #fff; <?php echo ($post->post_type == 'list') ? 'border-bottom:none' : '' ?>">
                    <?php if($showSurvey && (PROJECT_ID == 1 || PROJECT_ID == 6)){ ?>
                    <div class="p402_premium">
                        <div class="p402_hide">
                            <?php } ?>
                    <div class="head">
                        <h1><a class='post_title hyperlink' target="_blank" id="hyperlink"
                               href="<?php echo $post->hyperlink; ?>"><?php echo $post->title; ?></a></h1>
                    </div>

                    <?php
                    $Social = new SocialButtons($post);
                    $Social->place_buttons();
                    ?>
                            <?php if($showSurvey && PROJECT_ID != 1 && PROJECT_ID != 6){ ?>
                            <div class="p402_premium">
                                <div class="p402_hide">
                                    <?php } ?>

                    <div class="videowrapper">
                        <iframe class="swipe-img" width="300" height="169" src="<?php echo $post->video_link; ?>"
                                frameborder="0" allowfullscreen></iframe>

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

                        <?php $Social->facebook_share(); ?>

                        <div class="head content">
                            <p><?php
                                if(defined('CONTENT_CDN_BUCKET')) {
                                    $content = str_replace($_SERVER['HTTP_HOST'] . '/wp-content/uploads', CONTENT_CDN_BUCKET . '/wp-content/uploads', $post->content);
                                }else {
                                    $content = $post->content;
                                }

                                $findyoutube=new PostModel();
                                ?><div id="content-iframe"><?php
                                $findyoutube->findYoutube($content); ?>
                                </div>
                            </p>
                        </div>
                        <?php $Social->like_page('video'); ?>
                    <?php } ?>


                                    <?php if($showSurvey){ ?>
                                </div><!-- p402_hide-->
                            </div><!-- p402_premium-->
                        <?php } ?>
                </div>





                <div>
                    <?php echo $googleads->googleSingleAfterPostR; ?>
                </div>


                <?php // $commercialads->ShowCommercialAds; ?>

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

            if (property_exists($postdata, 'related') && (count((array)$postdata->related)) != 0) {
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
                                    <a href="<?php echo $related->post_permalink; ?>"
                                       id="<?php echo $related->post_id; ?>">
                                        <img src="<?php echo $related->post_image; ?>"
                                             alt="<?php echo $related->post_title; ?>"
                                             title="<?php echo $related->post_title; ?>"/>

                                        <p><?php echo $related->post_title; ?></p>
                                    </a>
                                </div>
                            </td>

                            <?php if (++$counterX % 2 === 0) { ?>
                        </tr>
                        <tr>
                            <?php
                            }
                            }
                            }
                            ?>
                        </tr>
                    </table>
                </div>

            <?php } ?>


        </div>

        <?php echo $pagedata->swip; ?>

    </section>
<?php //echo $googleads->SingleAfterPost; ?>