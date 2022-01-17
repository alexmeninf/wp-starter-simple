<?php

// Exit if accessed directly
if ( ! defined('ABSPATH') )
  exit;
?>

<footer class="footer-site">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 text-center text-lg-start">
        <p class="policy-links mb-3 mb-lg-0">
          <a href="<?php echo get_privacy_policy_url() ?>">Política de privacidade</a>
          <a href="<?php echo get_permalink('termos-de-uso') ?>">Termos de Uso</a>
        </p>
        <p>&copy; <?= date('Y') . ' ' . get_bloginfo('name') ?>. <?php _e('Todos os direitos reservados.', 'bluelizard') ?></p>
      </div>

      <div class="col-lg-6 text-center text-lg-end">
        <p class="developer js-dev-footer"><?php _e('Desenvolvido por', 'bluelizard') ?> <a href="https://inovany.com.br" target="_blank" rel="noopener" title="iNova">
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
