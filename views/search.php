<?php /*  ?>
  <div style="width:100%; height:700px; background:#ffffff; color:#000; padding:50px">


  <pre><?php echo print_r($postdata->post_array, TRUE); ?></pre>

  <?php /echo $postdata->max_num_pages."<br/>";
  echo $postdata->found_posts."<br/>";
  echo $postdata->post_count."<br/>";

  ?>


  </div>

  <?php */ ?>

<section style="margin-top:55px;">

    <div id="container" class=" pad-12 "> 
        <?php $counter = 0; ?>
        <div class="cat_title" style='margin-bottom: 10px'> <h1 align="center">Search Result For '<?php echo $pagedata->searchResult; ?>'</h1></div>   

        <?php
        foreach ($postdata->post as $post) {
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
                <span class="date"><?php echo $post->date; ?>&nbsp;&nbsp;</span>
    <?php echo $post->inCategory; ?>

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



                <?php if ($postdata->nextPage || $postdata->prevPage) { ?>
            <div id="mainNav">
                <p>
            <?php if ($postdata->prevPage && $postdata->prevPage > 1) { ?>
                        <a id="prevPage" href="/page/<?php echo $postdata->prevPage; ?>">Previous Page</a> 
            <?php } if ($postdata->prevPage && $postdata->prevPage == 1) { ?>
                        <a id="prevPage"  href="<?php echo $pagedata->home; ?>">Previous Page</a>
    <?php } if ($postdata->nextPage) { ?>
                        <a id="nextPage" href="<?php echo $pagedata->home; ?>/page/<?php echo $postdata->nextPage; ?>">Next Page</a>
    <?php } ?>

                </p>
            </div>
<?php } ?>
<?php echo $metadata->js; ?>
<?php echo $pagedata->srollInit; ?>


<div id="toTop">^ Back to Top</div>
</section>
