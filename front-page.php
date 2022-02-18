<?php

if ( ! defined( 'ABSPATH' ) ) 
  exit;

get_header(); ?>


<section class="<?php echo section_class() ?>" 
style="backgroun-color:#198c79;background-image:url(<?= THEMEROOT ?>/assets/img/wp-starter-theme-2022.jpg);background-size:cover;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 text-center pb-4" style="border-bottom: 1px solid #dedede52">
        <p class="fs-2">v<?= wp_get_theme()->get( 'Version' ); ?> - 2022</p>
        <h1 class="headline-1">Bem-vindo ao <br>WP Starter Simple Theme!</h1>
        <p class="fs-5 opacity-75">Desenvolvido por Menin</p>
      </div>
    </div>
  </div>
</section>


<?php
get_footer();
