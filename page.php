<?php

// Exit if accessed directly
if ( ! defined('ABSPATH') )
  exit;
  

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();?>


<section class="<?php echo section_class() ?>">
  <div class="container">
    <div class="row justify-content-center">
      
      <div class="col-12">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</section>


<?php endwhile; endif; ?>
<?php get_footer(); ?>
