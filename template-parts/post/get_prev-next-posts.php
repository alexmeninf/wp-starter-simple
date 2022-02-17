<?php

// Exit if accessed directly
if ( ! defined('ABSPATH') )
  exit;


$previous = get_previous_post();
$next     = get_next_post();

if (get_previous_post() || get_next_post()) : ?>
  <div class="pagination-posts">
    <?php if ( get_previous_post() ) { ?>
      <a href="<?= get_the_permalink($previous) ?>" title="<?php _e('Ver postagem', 'startertheme') ?>: <?= get_the_title($previous) ?>" class="nav-previous">
        <i class="far fa-chevron-double-left"></i> 
        <span><?php _e('Anterior', 'startertheme') ?></span>
      </a>
    <?php } ?>

    <?php if ( get_next_post() ) { ?>
      <a href="<?= get_the_permalink($next) ?>" title="<?php _e('Ver postagem', 'startertheme') ?>: <?= get_the_title($next) ?>" class="nav-next">
        <span><?php _e('Próximo', 'startertheme') ?></span> 
        <i class="far fa-chevron-double-right"></i>
      </a>
    <?php } ?>
  </div>
 <?php endif; ?>