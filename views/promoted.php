<section style="margin-top:55px;">

    <div id="container" class=" pad-12 "> 
        <?php
        $post_id=-1;
        foreach ($postdata->post as $post) {
            $post_id = $post->ID;
        }
            ?>
            <div class="white-block status-list pad-2 index" style="margin-bottom: 0px; background: #fff; min-height: 150px;"></div>

<?php

if (property_exists($postdata, 'related') &&  (count((array)$postdata->related))!= 0) {
    $tr_count = 0;
    ?>

            <div class="related index" style="margin-top: 0 !important;">
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