<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
  exit;

?>

<div class="share-post">
  <ul>
    <li>
      <a class="btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>&redirect_uri=<?php the_permalink() ?>" target="_blank" rel="noopener" aria-label="Share button" title="<?php _e('Compartilhe no Facebook', 'startertheme') ?>">
        <i class="fab fa-facebook-f"></i>
      </a>
    </li>
    <li>
      <a class="btn-twitter" href="https://twitter.com/intent/tweet?text=<?php the_title() ?>%2E.%20Assista%20em%3A%20&tw_p=tweetbutton&url=<?php the_permalink() ?>" target="_blank" rel="noopener" aria-label="Share button" title="<?php _e('Compartilhe no Twitter', 'startertheme') ?>">
        <i class="fab fa-twitter"></i>
      </a>
    </li>
    <li>
      <a class="btn-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=&summary=<?php the_title() ?>&source=" target="_blank" rel="noopener" aria-label="Share button" title="<?php _e('Compartilhe no Linkedin', 'startertheme') ?>">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </li>
    <li>
      <a class="btn-whatsapp" href="https://api.whatsapp.com/send?phone=&text=<?php the_title() ?>.%20Assista%20em%3A%20<?php the_permalink() ?>" target="_blank" rel="noopener" aria-label="Share button" title="<?php _e('Compartilhe no WhatsApp', 'startertheme') ?>">
        <i class="fab fa-whatsapp"></i>
      </a>
    </li>
    <li>
      <a class="btn-telegram" href="https://telegram.me/share/url?url=<?php the_permalink() ?>&text=<?= the_title() ?>" target="_blank" rel="noopener" aria-label="Share button" title="<?php _e('Compartilhe no Telegram', 'startertheme') ?>">
        <i class="fab fa-telegram-plane"></i>
      </a>
    </li>
    <li>
      <div class="px-1 mx-2">
        <div class="divisor-share"></div>
      </div>
    </li>
    <li>
      <a class="share-default share-button" aria-label="Share button" title="<?php _e('Compartilhe nos apps', 'startertheme') ?>"><i class="fal fa-share-all"></i></a>
    </li>
  </ul>
</div>

<script>
  shareLinkNative = () => {
    const shareButton = document.querySelector(".share-button");

    if (shareButton === null) return;

    if (navigator.share) {
      shareButton.addEventListener("click", (event) => {
        const title = document.title;
        const url = document.querySelector("link[rel=canonical]")
          ? document.querySelector("link[rel=canonical]").href
          : document.location.href;

        navigator
          .share({
            title: title,
            url: url,
          })
          .then(() => {
            // console.log("Thanks for sharing!");
          })
          .catch(console.error);
      });
    } else {
      shareButton.classList.add("d-none");
    }
  };

  shareLinkNative();
</script>