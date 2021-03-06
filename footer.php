<?php

// Exit if accessed directly
if ( ! defined('ABSPATH') )
  exit;
?>

<footer class="footer-site">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 text-center text-lg-start">
        <?php do_action('footer_before_links'); ?>
        <p class="policy-links mb-3 mb-lg-0">
          <a href="<?php echo get_privacy_policy_url() ?>">Política de privacidade</a>
          <a href="<?php echo get_permalink(get_page_by_path('termos-de-uso')) ?>">Termos de Uso</a>
        </p>
        <p>&copy; <?= date('Y') . ' ' . get_bloginfo('name') ?>. <?php _e('Todos os direitos reservados.', 'startertheme') ?></p>
      </div>

      <div class="col-lg-6 text-center text-lg-end">
        <?php do_action('footer_before_developer'); ?>
        <p class="developer js-dev-footer"><?php _e('Desenvolvido por', 'startertheme') ?> <a href="https://inovany.com.br" target="_blank" rel="noopener" title="iNova">
            <img src="https://assets.comet.com.br/assets/default/logo-inova-dark.png" alt="Inova">
          </a>
          <a href="https://bluelizard.com.br" target="_blank" rel="noopener" title="Blue Lizard">
            <img src="https://assets.comet.com.br/assets/default/logo-bluelizard-default.png" alt="Blue Lizard">
          </a>
        </p>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
