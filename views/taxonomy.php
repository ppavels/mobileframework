<?php /* ?>
  <div style="width:100%; height:700px; background:#ffffff; color:#000; padding:50px">


  <pre><?php echo print_r($postdata, TRUE); ?></pre>

  <?php echo $postdata->category_name."<br/>";
  echo $postdata->found_posts."<br/>";
  echo $postdata->post_count."<br/>";

  ?>

 <pre><?php  echo print_r($postdata, TRUE); ?></pre>
  </div>

  <?php */ ?>
 
<section style="margin-top:55px;">

    <div id="container" class=" pad-12 "> 
        <?php /* echo $googleads->SingleHeader; */ ?>
        <?php /* ?><div class="cat_title" style='margin-bottom: 10px'> <h1 align="center"><?php echo $postdata->category_name ?></h1></div><?php */ ?>
        <?php $counter = 0; ?>

        <?php foreach ($postdata->post as $post) {
            if ($post->shares == 0) {
                $style = 'display: none;';
            } else {
                $style = '';
            }
            ?>
             <?php if($counter==1) { echo $googleads->Feed; } ?>
             <?php if($counter==4) { echo $googleads->Feed2; } ?>
             <?php if($counter==7) { echo $googleads->Feed3; } ?>
            <div class="white-block status-list pad-2 index" style="margin-bottom: 12px;">
                <div class="index-img-single"> 
                    <div class="index-centered-img">
                        <a href="<?php echo $post->permalink; ?>" class="fl"><img src="<?php echo $post->image; ?>" alt="<?php echo $post->title; ?>" style="width: 100%;"/></a>
                    </div>
                </div> 
                <div class="clear"></div>
                <span class="date"><?php echo $post->date; ?></span>
                <span class="date expired"> 
                   <?php echo $post->post_expired_date; ?> 
               </span>
                <div class="head">
                    <a class='post_title' href="<?php echo $post->permalink; ?>"><?php echo $post->title; ?></a>

                </div>


                <?php
                $Social = new SocialButtons($post);
                $Social->place_buttons('bottom');
                ?>

                <div class="clear"></div>

            </div>





                    <?php $counter++;
                } ?>
                <?php if (isset($postdata->taxonomy_data) && ($postdata->nextPage || $postdata->prevPage)) { ?>
            <div id="mainNav">
                <p>
    <?php if ($postdata->prevPage && $postdata->prevPage > 1) { ?>
                        <a id="prevPage" href="<?php echo SITE_ROOT.'/'.$postdata->taxonomy_data[0]['taxonomy']; ?>/<?php echo $postdata->taxonomy_data[0]['terms']; ?>/page/<?php echo $postdata->prevPage; ?>/">Previous Page</a> 
            <?php } ?>
    <?php if ($postdata->prevPage && $postdata->prevPage == 1) { ?>
                        <a id="prevPage" href="<?php echo SITE_ROOT.'/'.$postdata->taxonomy_data[0]['taxonomy']; ?>/<?php echo $postdata->taxonomy_data[0]['terms'];; ?>/">Previous Page</a> 
    <?php } ?>
    <?php if ($postdata->nextPage) { ?>
                        <a id="nextPage" href="<?php echo SITE_ROOT.'/'.$postdata->taxonomy_data[0]['taxonomy']; ?>/<?php echo $postdata->taxonomy_data[0]['terms'];; ?>/page/<?php echo $postdata->nextPage; ?>/">Next Page</a>
            <?php } ?>

                </p>
            </div>
<?php } ?>






<?php echo $metadata->js; ?>
<?php echo $pagedata->srollInit; ?>
    </div> 
<div id="toTop">^ Back to Top</div>
</section>