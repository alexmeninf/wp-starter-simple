<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) 
  exit;


/**
 * Definições do tema e funcionalidades 
 */

// Habilitar preload nas páginas
define('THEME_ENABLE_PRELOAD', false);

// Habilitar navbar superior nas páginas
define('THEME_ENABLE_NAVBAR', true);

// Gerar meta preload na requisição das fontes do tema
define('THEME_ENABLE_PRELOAD_FONT', false);

// Remover suporte e aba de comentários no painel do admin
define('WP_REMOVE_SUPPORT_COMMENTS', true);


/**
 * Require functions
 */
include 'inc/_framework/framework.php';
include 'inc/theme.php';


/**
 * CSS Files
 */
new_css('bootstrap', 'assets/plugins/bootstrap/css/bootstrap.css');
new_css('fontawesome-default', 'assets/plugins/fontawesome/css/all.min.css');
new_css('style-theme', 'style.css');
new_css('main-default', 'assets/css/main.css');

/**
 * Use CSS Default
 */
use_css('bootstrap');
use_css('fontawesome-default');
use_css('style-theme');
use_css('main-default');


/**
 * Scripts Files 
 */
new_js('jquery-default', 'assets/plugins/jquery/jquery.min.js', false);
new_js('popper', 'assets/plugins/bootstrap/js/popper.min.js');
new_js('bootstrap-default', 'assets/plugins/bootstrap/js/bootstrap.min.js');
new_js('lazyload-default', 'assets/plugins/lazyload.min.js');
new_js('main-default', 'assets/js/main.js');

/**
 * Use JS Default
 */
use_js('jquery-default');
// use_js('popper');
// use_js('bootstrap-default');
// use_js('lazyload-default');
// use_js('main-default');