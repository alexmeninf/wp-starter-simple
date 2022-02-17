<?php

// Exit if accessed directly
if ( ! defined('ABSPATH') )
  exit;
?>


<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="d-block shadow rounded-3 mb-4 hover-overlay overflow-hidden text-dark">
    <?php if ( has_post_thumbnail() ) : ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_post_thumbnail('medium', ['class' => 'img-fluid', 'alt' => 'Feature image']); ?>
      </a>
    <?php endif; ?>
    
    <div class="p-4">
      <span class="border-start border-3 border-primary ps-2 d-block" style="font-size:14px"><?= get_post_type_object(get_post_type())->labels->singular_name ?></span>
      <h4 class="mb-0 fs-5"><?php the_title() ?></h4>
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">Ver mais <i class="fal fa-chevron-double-right align-middle"></i></a>
    </div>

    <div class="mask" style="background-color: #ebebeb8c;"></div>
  </div>
</div>
