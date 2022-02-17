<?php

if (!defined('ABSPATH'))
  exit;

get_header();

if (have_posts()) : while (have_posts()) : the_post(); ?>


  <div class="spacing post-single">
    <header class="container">
      <div class="max-w-screen-md mx-auto">

        <?php if (is_user_logged_in() && current_user_can('edit_posts')) : ?>
          <a href="<?php echo get_edit_post_link(); ?>" class="btn-theme btn-small mb-3" target="_blank"><i class="fal fa-edit"></i> Editar post</a>
        <?php endif; ?>

        <?php get_template_part('template-parts/post/get_categories'); ?>

        <h1 class="title-post" title="<?php the_title() ?>">
          <?php the_title() ?>
        </h1>

        <?php if (has_excerpt()) : ?>
          <span class="excerpt-post">
            <?php the_excerpt(); ?>
          </span>
        <?php endif; ?>

        <div class="divider-border"></div>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mt-3">
          <div class="blog-postmeta d-flex align-items-center text-start">
            <!-- Imagem do Autor -->
            <a class="avatar-post d-flex align-items-center text-decoration-none" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
              <div class="avatar-circle align-items-center justify-content-center d-inline-flex position-relative">
                <img src="<?= get_avatar_url($id, 150) ?>" alt="<?= get_the_author_meta('display_name') ?>">
                <span class="avatar__name"><?= get_the_author_meta('display_name')[0] ?></span>
              </div>
            </a>
            <div class="ms-2">
              <!-- Nome do autor -->
              <div class="d-flex align-items-center">
                <a class="author-name" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?= get_the_author_meta('display_name') ?></a>
              </div>
              <!-- Data de publicação -->
              <div class="mt-1 text-xs">
                <?php echo do_shortcode('[published_modified_date]'); ?>
              </div>
            </div>
          </div>

          <div class="mt-4">
            <div class="d-flex flex-row align-items-center">
              <?php get_template_part('template-parts/post/get_share-post'); ?>
            </div>
          </div>
        </div>
      </div>
    </header>

    <?php if (has_post_thumbnail()) : ?>
      <div class="container single-image">
        <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'object-cover w-full h-full rounded-xl', 'alt' => 'single image']); ?>
      </div>
    <?php elseif (get_field('imagem_destaque')) : ?>
      <div class="container single-image">
        <img data-src="<?= esc_url(get_field('imagem_destaque')['url']) ?>" alt="single image" class="lazyload object-cover w-full h-full rounded-xl">
      </div>
    <?php endif; ?>

    <main class="container">

      <!-- Conteúdo -->
      <article id="single-entry-content" class="content-single max-w-screen-md mx-auto">
        <?php the_content(); ?>
      </article>

      <!-- Tags -->
      <?php get_template_part('template-parts/post/get_tags'); ?>

      <div class="max-w-screen-md mx-auto">
        <div class="author-post d-flex">
          <a class="avatar-post d-flex align-items-center text-decoration-none" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
            <div class="avatar-circle align-items-center justify-content-center d-inline-flex position-relative">
              <img src="<?= get_avatar_url($id, 150) ?>" alt="<?= get_the_author_meta('display_name') ?>">
              <span class="avatar__name"><?= get_the_author_meta('display_name')[0] ?></span>
            </div>
          </a>
          <div class="flex flex-col ms-3">
            <span class="published-by text-xs">
              <?php echo __('Publicado por', 'startertheme'); ?>
            </span>
            <p class="author-name">
              <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?= get_the_author_meta('display_name') ?></a>
            </p>
            <span class="author-description">
              <?php the_author_meta('description') ?>
              <a class="ml-2" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php _e('Leia mais', 'startertheme') ?></a>
            </span>
          </div>
        </div>
      </div>

      <div class="max-w-screen-md mx-auto">
        <?php get_template_part('template-parts/post/get_prev-next-posts'); ?>
      </div>

      <!-- comentarios -->
      <div id="comments" class="comments max-w-screen-md mx-auto">
        <h3><?php _e('Deixe seu comentário', 'startertheme') ?></h3>
        <?php support_comments_facebook() ?>
      </div>
    </main>
  </div>


<?php endwhile; endif; ?>
<?php get_footer(); ?>