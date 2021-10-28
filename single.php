<?php

if ( ! defined( 'ABSPATH' ) ) 
  exit;


get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>


<section class="<?php echo section_class('post-single') ?>">
  <div class="container">
    <div class="row">
      <main class="col-12">
        <?php the_content(); ?>
      </main> <!-- /.col-lg-8 -->
    </div> <!-- /.row -->
  </div> <!-- /.container -->
</section> <!-- /.post-single -->


<?php
endwhile; endif; ?>
<?php get_footer(); ?>
