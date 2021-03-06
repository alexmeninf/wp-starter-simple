<?php 

// Exit if accessed directly
if ( ! defined('ABSPATH') )
  exit;


$categories = get_the_category();
$separator  = ' ';
$output     = '';

if ( ! empty( $categories ) ) {
  foreach( $categories as $category ) {
    $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'Visualizar todos os posts em %s', 'startertheme' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
  } ?>
  <div class="categories-post">
    <?php echo trim( $output, $separator ); ?>
  </div>
<?php
}
?>