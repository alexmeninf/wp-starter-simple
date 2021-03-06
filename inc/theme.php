<?php

if (!defined('ABSPATH'))
  exit;

/*
* Make theme available for translation.
* Translations can be filed in the /languages/ directory.
*/
add_action('after_setup_theme', 'theme_setup_lang');

function theme_setup_lang()
{
  load_theme_textdomain('startertheme', get_template_directory() . '/languages');
}


add_action('after_setup_theme', function () {

  /**
   * Add HTML5 theme support.
   */
  add_theme_support(
    'html5',
    array(
      'search-form',
      'style',
      'script',
      'navigation-widgets',
    )
  );

  /**
   * Add theme support for selective refresh for widgets.
   */
  add_theme_support('customize-selective-refresh-widgets');

  /**
   * Supost Thumbnals
   */
  add_theme_support('post-thumbnails');

  /**
   * Register support to the menus
   */
  register_nav_menus(
    array(
      'primary' => esc_html__('Primary menu', 'startertheme'),
    )
  );

  /*
	 * Remove meta tag generator 
	 * Vulnerabilidade que mostra a versão do WP
	 */
  remove_action('wp_head', 'wp_generator');

  // remove SVG and global styles
  remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');

  // remove wp_footer actions which add's global inline styles
  remove_action('wp_footer', 'wp_enqueue_global_styles', 1);

  // remove render_block filters which adding unnecessary stuff
  remove_filter('render_block', 'wp_render_duotone_support');
  remove_filter('render_block', 'wp_restore_group_inner_container');
  remove_filter('render_block', 'wp_render_layout_support_flag');
  remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
});


/**
 * enable_preload_fonts
 *
 * @return void
 */
function enable_preload_fonts()
{

  if (THEME_ENABLE_PRELOAD_FONT === true) : ?>

    <link rel="preload" crossorigin="anonymous" href="<?= THEMEROOT ?>/assets/plugins/fontawesome/webfonts/fa-regular-400.woff2" as="font">
    <link rel="preload" crossorigin="anonymous" href="<?= THEMEROOT ?>/assets/plugins/fontawesome/webfonts/fa-duotone-900.woff2" as="font">
    <link rel="preload" crossorigin="anonymous" href="<?= THEMEROOT ?>/assets/plugins/fontawesome/webfonts/fa-light-300.woff2" as="font">
    <link rel="preload" crossorigin="anonymous" href="<?= THEMEROOT ?>/assets/plugins/fontawesome/webfonts/fa-brands-400.woff2" as="font">

  <?php
  endif;
}

add_action('wp_head', 'enable_preload_fonts', 2);



/**
 * Update Layout to Login Admin
 */
function wp_custom_logo_in_login()
{

  $css = '<style type="text/css">
    #login h1 a,
    .login h1 a {
      background-image: url(https://assets.comet.com.br/assets/default/blue-lizard-160x160.jpg);
      background-repeat: no-repeat;
      background-size: 120px;
      height: 120px;
      width: 120px;
    }

    body {background: #141414 !important}

    .login #backtoblog a,
    .login #nav a {color: #adadad !important}

    .login #login_error,
    .login .message,
    .login .success,
    .login form {
      border-radius: 10px
    }

    .wp-core-ui .button-primary {
      background: #000 !important;
      border-color: #000 !important;
      box-shadow: none !important;
      color: #fff !important;
      text-decoration: none !important;
      text-shadow: none !important;
      border-radius: 0 !important;
    }

    input[type=text]:focus,
    input[type=password]:focus {
      border-color: #ff0083 !important;
      box-shadow: none !important;
    }
  </style>';

  echo $css;
}

add_action('login_enqueue_scripts', 'wp_custom_logo_in_login');


/**
 * remove some styles
 */
function wc_remove_block_library_css()
{
  if (is_page_template() || is_front_page()) {
    wp_dequeue_style('wc-block-style');
    wp_dequeue_style('wp-block-library');
  }
}
add_action('wp_enqueue_scripts', 'wc_remove_block_library_css');


/*====================================
=            OPTIONS PAGE            =
====================================*/
if (function_exists('acf_add_options_page')) {

  acf_add_options_page(
    array(
      'page_title'  => __('Opções do site', 'startertheme'),
      'menu_title'  => __('Opções do site', 'startertheme'),
      'menu_slug'   => 'opcoes',
      'capability'  => 'edit_posts',
      'redirect'    => false
    )
  );
}


/**
 * Show the page name
 */
function the_title_page()
{
  $lang = get_bloginfo("language");

  if (is_404()) {
    echo __('Página não encontrada', 'startertheme');
  } elseif (is_tag()) {
    single_tag_title();
  } elseif (is_category()) {
    single_cat_title();
  } elseif (is_tax()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    echo $term->name;
  } elseif (is_day()) {
    $date = ($lang == 'pt-BR') ? get_the_time('j \d\e F \d\e Y') : get_the_time('F j, Y');
    echo __('Registros de ', 'startertheme') . $date;
  } elseif (is_month()) {
    $date = ($lang == 'pt-BR') ? get_the_time('F \d\e Y') : get_the_time('F, Y');
    echo __('Registros de ', 'startertheme') . $date;
  } elseif (is_year()) {
    echo __('Registros de ', 'startertheme') . get_the_time('Y');
  } elseif (is_author()) {
    echo __('Registros do autor', 'startertheme');
  } elseif (isset($_GET['p']) && !empty($_GET['p'])) {
    echo __('Registros do blog', 'startertheme');
  } elseif (is_search()) {
    echo __('Resultados da pesquisa', 'startertheme');
  } else {
    if (class_exists('WooCommerce')) {
      if (is_shop()) {
        echo __('Os melhores produtos para você', 'startertheme');
      } else {
        the_title();
      }
    } else {
      echo wp_trim_words(get_the_title(), 6, '...');
    }
  }
}


/**
 * Support Facebook comments
 */
function support_comments_facebook($url = '')
{
  if ($url == '') {
    $url = esc_url(get_permalink());
  } ?>

  <style>
    .fb_iframe_widget_fluid_desktop iframe {
      width: 100% !important;
    }

    .face-link {
      font-size: 14px
    }

    .face-link a {
      color: var(--bs-primary);
    }
  </style>

  <?php if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPad') || strstr($_SERVER['HTTP_USER_AGENT'], 'Mac')) : ?>
    <p class="ms-2 face-link">
      <i class="fab fa-facebook me-1"></i>
      <?php _e('Não consegue comentar?', 'startertheme') ?>
      <?php _e('<a href="https://facebook.com/home.php" target="_blank" rel="noreferrer noopener" title="Conecte ao facebook" class="text-decoration-none">Conecte à sua conta do Facebook</a> em outra página e volte.', 'startertheme') ?>
    </p>
  <?php endif; ?>

  <div class="comment-box">
    <div class="fb-comments" data-order-by="reverse_time" data-href="<?php echo $url ?>" data-width="100%" data-numposts="5"></div>
  </div>

  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v13.0" nonce="lkGf2c72"></script>

  <?php
}


/**
 * get_pagination
 *
 * @version 1.2
 * 
 * @param integer $current_page - Página atual selecionada na páginação
 * @param integer $pages_count - Conta total de páginas geradas
 * @param integer $maxLinks - Máximo de links na paginação antes/depois
 * @param string $param_name - Nome do paramentro atual para a url
 * 
 */
function get_pagination($current_page, $pages_count, $maxLinks = 2, $param_name = 'pg')
{
  wp_reset_query();

  $args = "?";
  $firstRun = true;

  if (!empty($_GET)) {

    $i = 0;

    foreach ($_GET as $key => $val) {
      // Remove duplicate parameter
      $check_pg = ($param_name != $key);

      if ($key != null) {
        if (!$firstRun && $check_pg) {
          $args .= $args == '?' ? '' : '&';
        } else {
          $firstRun = false;
        }

        if ($check_pg) {
          if (is_array($val)) {
            $count = count($val);
            foreach ($val as $valitem) {
              $args .= $key . "[]=" . $valitem;
              if (++$i !== $count) {
                $args .= '&';
              }
            }
          } else {
            $args .= $key . "=" . $val;
          }
        }
      }
    }
  }

  $symbol_concat = $args != '?' ? '&' : '';

  if (is_search()) {
    $args .= ! strstr($args, 's=') ? 's=' . get_search_query() : '';
    $url = get_bloginfo('url');
  } elseif (is_category()) {
    $url = get_category_link(get_queried_object()->term_id);
  } elseif (is_tax()) {
    $url = get_term_link(get_queried_object()->term_id);
  } elseif (is_tag()) {
    $url = get_tag_link(get_queried_object()->term_id);
  } elseif (is_day()) {
    $url = get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d'));
  } elseif (is_month()) {
    $url = get_month_link(get_the_time('Y'), get_the_time('m'));
  } elseif (is_year()) {
    $url = get_year_link(get_the_time('Y'));
  } elseif (is_author()) {
    $url = get_author_posts_url(get_queried_object()->term_id);
  } else {
    $url  = get_the_permalink(get_the_ID());
  }

  $url = esc_url($url) . $args . $symbol_concat;

  if ($pages_count > 0) : ?>

    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <?php
        // Check if the first page 
        $disable_link = ($current_page == 1) ? 'disabled' : '';

        echo '<li class="page-item">';
        echo '<a class="page-link" aria-label="Previous" title="' . __('Página anterior', 'startertheme') . '" ' . $disable_link . ' href="' . $url . $param_name . '=1"><span>&laquo;</span></a>';
        echo '</li>';

        // Previous pages
        for ($i = $current_page - $maxLinks; $i <= $current_page - 1; $i++) :
          if ($i >= 1) :
            echo '<li>';
            echo '<a class="page-link" href="' . $url . $param_name . '=' . $i . '">' . $i . '</a>';
            echo '</li>';
          endif;
        endfor;

        // Current page
        echo '<li class="page-item active"><a class="page-link" href="' . $url . $param_name . '=' . $current_page . '"> ' . $current_page . '</a></li>';

        // Next pages        
        $displaying_the_last = false;

        for ($i = $current_page + 1; $i <= $current_page + $maxLinks; $i++) :
          if ($i <= $pages_count) :
            echo '<li class="page-item">';
            echo '<a class="page-link" href="' . $url . $param_name . '=' . $i . '">' . $i . '</a>';
            echo '</li>';
          endif;

          // check if the last page is shown
          if ($i == $pages_count - 1 || $i == $pages_count) $displaying_the_last = true;
        endfor;

        // Show the last page
        if ($current_page != $pages_count && !$displaying_the_last) :
          echo '<li class="page-item"><a class="page-link" disabled>...</a></li>';
          echo '<li class="page-item">';
          echo '<a class="page-link" href="' . $url . $param_name . '=' . $pages_count . '">' . $pages_count . '</a>';
          echo '</li>';
        endif;

        // Check if the last page 
        $disable_link = ($current_page == $pages_count) ? 'disabled' : 'title="' . __('Próxima página', 'startertheme') . '"';

        echo '<li class="page-item">';
        echo '<a class="page-link" aria-label="Next" ' . $disable_link . ' href="' . (($current_page != $pages_count) ? ($url . $param_name . '=' . ($current_page + 1)) : '') . '"><span>&raquo;</span></a>';
        echo '</li>';
        ?>
      </ul>
    </nav>
  <?php endif;
}


/**
 * section_class
 *
 * @param  string $class Adicione classes na sessão principal
 * @param  boolean $enable_default Exiba as classes padrão para cada sessão
 * @param  boolean $full_screen Habilitar sessão com altura máxima do viewport
 * 
 * @return string
 */
function section_class($class = '', $enable_default = true, $full_screen = true)
{

  if ($enable_default) {
    $class .= ' ' . 'spacing';
  }

  if ($full_screen) {
    $class .= ' ' . 'min-vh-100 d-flex align-items-center';
  }

  $class = preg_replace('/\s{2,}/', ' ', $class);

  return $class;
}


/**
 * Exibe o preload no site ao antes de carregar por completo.
 * 
 * @return mixed
 */
function menin_theme_preload()
{

  if (THEME_ENABLE_PRELOAD === true) : ?>

    <div class="preload">
      <img src="<?= THEMEROOT ?>/assets/img/loading.svg" alt="<?php _e('Carregando...', 'startertheme') ?>" height="35" width="35">
    </div>

    <script>
      jQuery(function($) {
        $('body').css('overflow-y', 'hidden');
        window.addEventListener("load", function(event) {
          $('.preload').fadeOut();
          $('body').css('overflow-y', 'visible');
        });

        setTimeout(() => {
          $('.preload').fadeOut();
          $('body').css('overflow-y', 'visible');
        }, 2500);
      });
    </script>

<?php
  endif;
}

add_action('wp_body_open', 'menin_theme_preload', 10);


/**
 * Navbar com breadcrumb após o header
 * Location: header.php
 */
function callback_navbar_header()
{

  if (THEME_ENABLE_NAVBAR == true) {

    if (!(is_front_page() || is_home() || is_single() || get_field('hidden_nav_in_page') == true)) {
      get_template_part('template-parts/navbar');
    }
  }
}

add_action('wp_body_open', 'callback_navbar_header', 30);


/**
 * custom_breadcrumbs
 */
function custom_breadcrumbs()
{
  // Configuracoes
  $separator          = '';
  $breadcrums_id      = 'breadcrumbs';
  $breadcrums_class   = 'breadcrumb mb-0';
  $li_class           = 'breadcrumb-item';
  $home_title         = 'Início';

  // Se você tiver algum tipo de postagem personalizado com taxonomias personalizadas, coloque o nome da taxonomia abaixo (e.g. product_cat)
  $custom_taxonomy    = 'product_cat';

  // Obter as informações de consulta e publicação
  global $post, $wp_query;

  // Não exibir na página inicial
  if (!is_front_page()) {

    // Construa o breadcrumbs
    echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

    // Home page
    echo '<li class="' . $li_class . ' item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';

    if (!empty($separator))
      echo '<li class="' . $li_class . ' separator"> ' . $separator . ' </li>';

    if (is_archive() && !is_tax() && !is_category() && !is_tag()) {

      $archive_title = '';
      if (is_day()) {
        $format_date = (get_bloginfo('lang') == 'pt-BR') ? get_the_time('j/m/Y') : get_the_time('F j, Y');
        $archive_title = __('Registros de ', 'startertheme') . $format_date;
      } elseif (is_month()) {
        $archive_title = __('Registros de ', 'startertheme') . get_the_time('F, Y');
      } elseif (is_year()) {
        $archive_title = __('Registros de ', 'startertheme') . get_the_time('Y');
      }

      echo '<li class="' . $li_class . ' item-current item-archive"><span class="bread-current bread-archive">' . $archive_title . '</span></li>';
    } else if (is_archive() && is_tax() && !is_category() && !is_tag()) {

      // Se post é um tipo de postagem personalizado
      $post_type = get_post_type();

      // Se for um nome e link de exibição de tipo de postagem personalizado
      if ($post_type != 'post') {

        $post_type_object = get_post_type_object($post_type);
        $post_type_archive = get_post_type_archive_link($post_type);

        echo '<li class="' . $li_class . ' item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';

        if (!empty($separator))
          echo '<li class="' . $li_class . ' separator"> ' . $separator . ' </li>';
      }

      $custom_tax_name = get_queried_object()->name;
      echo '<li class="' . $li_class . ' item-current item-archive"><span class="bread-current bread-archive">' . $custom_tax_name . '</span></li>';
    } else if (is_single()) {

      $post_type = get_post_type();

      if ($post_type != 'post') {
        $post_type_object = get_post_type_object($post_type);
        $post_type_archive = get_post_type_archive_link($post_type);

        echo '<li class="' . $li_class . ' item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';

        if (!empty($separator))
          echo '<li class="' . $li_class . ' separator"> ' . $separator . ' </li>';
      }

      // Obter informações de categoria
      $category = get_the_category();

      if (!empty($category)) {
        // A última publicação da categoria está em
        $last_category = end($category);

        // Obter pai de qualquer categoria
        $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
        $cat_parents = explode(',', $get_cat_parents);

        // Loop através de categorias pai e armazenar em variável $ cat_display
        $cat_display = '';
        foreach ($cat_parents as $parents) {
          $cat_display .= '<li class="item-cat">' . $parents . '</li>';
        }
      }

      // Se for um tipo de publicação personalizado dentro de uma taxonomia personalizada
      $taxonomy_exists = taxonomy_exists($custom_taxonomy);

      if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
        $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
        $cat_id         = $taxonomy_terms[0]->term_id;
        $cat_nicename   = $taxonomy_terms[0]->slug;
        $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
        $cat_name       = $taxonomy_terms[0]->name;
      }

      // Verifique se o post está em uma categoria
      if (!empty($last_category)) {
        echo $cat_display;
        echo '<li class="' . $li_class . ' item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';

        // Em caso de publicação em uma taxonomia personalizada
      } else if (!empty($cat_id)) {
        echo '<li class="' . $li_class . ' item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';

        if (!empty($separator))
          echo '<li class="' . $li_class . ' separator"> ' . $separator . ' </li>';

        echo '<li class="' . $li_class . ' item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
      } else {
        echo '<li class="' . $li_class . ' item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
      }
    } else if (is_category()) {
      // Página Category
      echo '<li class="' . $li_class . ' item-current item-cat"><span class="bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
    } else if (is_page()) {
      // Página padrão
      if ($post->post_parent) {

        $anc = get_post_ancestors($post->ID);
        $anc = array_reverse($anc);

        if (!isset($parents)) $parents = null;
        foreach ($anc as $ancestor) {
          $parents .= '<li class="' . $li_class . ' item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';

          if (!empty($separator))
            $parents .= '<li class="' . $li_class . ' separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
        }

        echo $parents;

        // Página Atual
        echo '<li class="' . $li_class . ' item-current item-' . $post->ID . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></li>';
      } else {
        // Basta exibir a página atual se não os pais
        echo '<li class="' . $li_class . ' item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</span></li>';
      }
    } else if (is_tag()) {

      // Página de Tag
      // Obter informações de tag
      $term_id        = get_query_var('tag_id');
      $taxonomy       = 'post_tag';
      $args           = 'include=' . $term_id;
      $terms          = get_terms($taxonomy, $args);
      $get_term_id    = $terms[0]->term_id;
      $get_term_slug  = $terms[0]->slug;
      $get_term_name  = $terms[0]->name;

      // Exibir o nome da Tag
      echo '<li class="' . $li_class . ' item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><span class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</span></li>';
    } elseif (is_day()) {

      // Day archive
      // Year link
      echo '<li class="' . $li_class . ' item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';

      if (!empty($separator))
        echo '<li class="' . $li_class . ' separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';


      // Month link
      echo '<li class="' . $li_class . ' item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';

      if (!empty($separator))
        echo '<li class="' . $li_class . ' separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';


      // Day display
      echo '<li class="' . $li_class . ' item-current item-' . get_the_time('j') . '"><span class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</span></li>';
    } else if (is_month()) {
      // Arquivo               

      echo '<li class="' . $li_class . ' item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';

      if (!empty($separator))
        echo '<li class="' . $li_class . ' separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

      echo '<li class="' . $li_class . ' item-month item-month-' . get_the_time('m') . '"><span class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</span></li>';
    } else if (is_year()) {
      echo '<li class="' . $li_class . ' item-current item-current-' . get_the_time('Y') . '"><span class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</span></li>';
    } else if (is_author()) {
      // Autor
      // Get the author information
      global $author;
      $userdata = get_userdata($author);

      echo '<li class="' . $li_class . ' item-current item-current-' . $userdata->user_nicename . '"><span class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</span></li>';
    } else if (get_query_var('paged')) {
      echo '<li class="' . $li_class . ' item-current item-current-' . get_query_var('paged') . '"><span class="bread-current bread-current-' . get_query_var('paged') . '" title="' . __('Página', 'startertheme') . ' ' . get_query_var('paged') . '">' . __('Página', 'startertheme') . ' ' . get_query_var('paged') . '</span></li>';
    } else if (is_search()) {
      // Página Search
      echo '<li class="' . $li_class . ' item-current item-current-' . get_search_query() . '"><span class="bread-current bread-current-' . get_search_query() . '" title="' . __('Resultado da pesquisa por', 'startertheme') . ': ' . get_search_query() . '">' . __('Resultado da pesquisa por', 'startertheme') . ': ' . get_search_query() . '</span></li>';
    } elseif (is_404()) {
      // Pagina 404
      echo '<li class="' . $li_class . '">' . __('Página não encontrada', 'startertheme') . '</li>';
    }

    echo '</ul>';
  }
}


/**
 * Logo do site
 * 
 * @return mixed
 */
function callback_custom_logo_setup()
{
  $defaults = array(
    'height'               => 60,
    'width'                => 'auto',
    'flex-height'          => true,
    'flex-width'           => true,
    'header-text'          => array('site-title', 'site-description'),
    'unlink-homepage-logo' => true,
  );

  add_theme_support('custom-logo', $defaults);
}

add_action('after_setup_theme', 'callback_custom_logo_setup');

function theme_logo_callback()
{
  $custom_logo_id = get_theme_mod('custom_logo');
  $logo           = wp_get_attachment_image_src($custom_logo_id, 'full');

  if (has_custom_logo()) {
    echo '<img src="' . esc_url($logo[0]) . '" alt="Logo ' . get_bloginfo('name') . '">';
  }
}

add_filter('logo_tema', 'theme_logo_callback', 10);


/**
 * Obter página anterior do histórico de navegação
 * back_page_of_history
 *
 * @return string
 */
function back_page_of_history()
{
  $previous = "javascript:history.go(-1)";

  if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
  } else {
    $previous = get_home_url('/');
  }

  return $previous;
}


/**
 * Data de publicação e modificação do post
 */
function published_modified_date() {
	$date        = get_the_date( 'U' );
	$updated     = get_the_modified_date( 'U' );
  $date_format = get_bloginfo('language') == 'pt-BR' ? 'd/m/y, \à\s H:i' : 'm/d/y, \a\t H:i:s';
  $utf_format  = 'Y-m-d\TH:i:s\Z';

  $output = '<i class="fal fa-calendar-alt me-2"></i>';
  $output .= '<time itemprop="datePublished" putdate datetime="'.get_the_date($utf_format).'" class="entry-date"><span>'. __('Publicado em', 'startertheme') .'</span> ' . get_the_date( $date_format ) . '</time>';

	if ( $updated > ( $date + 86400 ) ) {
    $output .= '<span class="mx-2 fw-bold">·</span>';
    $output .= '<time itemprop="dateModified" datetime="'.get_the_modified_date($utf_format).'" class="entry-date-modified"><span>'. __('Atualizado em', 'startertheme') .'</span> ' . get_the_modified_date( $date_format ) . '</time>';
  }
  
	return $output;
}
add_shortcode( 'published_modified_date', 'published_modified_date' );
