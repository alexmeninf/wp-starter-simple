<?php

// Exit if accessed directly
if ( ! defined('ABSPATH') )
  exit;


$post_tags = get_the_tags();

if ( $post_tags ) { 
  $numItems = count($post_tags);
  $i = 0;
?>

<div class="max-w-screen-md mx-auto d-flex flex-wrap">
  <div class="single-tags">
    <span class="mb-2 d-inline-block"><i class="fal fa-tags"></i> <?php _e('Tags', 'startertheme') ?>:</span>
    <ul>
      <?php 
      foreach ( $post_tags as $tag ) {
        echo '<li><h6 class="ceo-tag"><a class="mb-2 me-2 border rounded-pill" href="'.get_tag_link($tag->term_id).'">'.$tag->name . '</a></h6></li>';
        
        if(++$i !== $numItems) {
          echo ' ';
        }
      } ?>
    </ul>
  </div>
</div>

<?php } ?>