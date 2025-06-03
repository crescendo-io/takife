<?php
    $option_logo_footer = get_field('option_logo_footer', 'option');
    $option_logo_footer_array = get_custom_thumb($option_logo_footer, 'full');
?>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <a href="<?= get_site_url(); ?>">
                            <img src="<?= $option_logo_footer_array['url']; ?>" class="logo-footer" alt="<?= $option_logo_footer_array['alt']; ?>">
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <p>Accès Rapide</p>
                        <?= wp_nav_menu(array(
                            'menu'				=> "menu", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
                            'menu_class'		=> "",
                            'container_class'	=> "menu",// (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
                        )); ?>
                    </div>
                    <div class="col-sm-3">
                        <p>Liens utiles</p>
                        <?= wp_nav_menu(array(
                            'menu'				=> "footer", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
                            'menu_class'		=> "",
                            'container_class'	=> "menu",// (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
                        )); ?>
                    </div>
                    <div class="col-sm-3">
                        <p class="press-footer">
                            <strong>Contact presse</strong><br/>
                            Sarah Gerlicher Communications / Smart PR<br/>
                            <a href="mailto:sarahgerlicher@gmail.com">sarahgerlicher@gmail.com</a><br/>
                            06.78.29.26.25
                        </p>
                    </div>

                    <div class="col-sm-12 text-center">
                        <?php get_template_part('template-parts/general/bloc-social');?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 center">
                        <div class="copyright">
                            Site Web By <a href="https://crescendo-studio.io/" rel="noopener" target="_blank">Crescendo</a> ©<?= date("Y"); ?> Tous droits reservés
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <?php
        $cookieConsent = $_COOKIE["cookieyes-consent"];

        $searchConsent = strpos($cookieConsent, 'analytics:yes');

        if($searchConsent && get_field('option_ga_code', 'option')):
            echo get_field('option_ga_code', 'option');
        endif;
        ?>




        <?php if(get_field('option_structured_datas', 'option')): ?>
            <?= get_field('option_structured_datas', 'option'); ?>
        <?php endif; ?>

        <?php wp_footer(); ?>
    </body>
</html>

<script>
document.addEventListener("DOMContentLoaded", function() {

    $('.page-loader').fadeOut();

  const selectors = ".strate-hero h1, .strate-hero h2, .strate-hero p";
  document.querySelectorAll(selectors).forEach(element => {
    const text = element.textContent;
    element.textContent = "";
    // On découpe en mots, en gardant les espaces
    const words = text.split(/(\s+)/);
    words.forEach((word, i) => {
      const span = document.createElement("span");
      span.textContent = word;
      span.classList.add("word");
      element.appendChild(span);
      setTimeout(() => {
        span.classList.add("visible");
      }, 50 * i); // 100ms par mot
    });
  });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Sélectionne tous les textes à animer dans .container-text-only et .container-image-text
  const elements = document.querySelectorAll('.container-text-only h1, .container-text-only pre, .container-text-only h2, .container-text-only h3, .container-text-only h4, .container-text-only h5, .container-text-only p, .container-image-text h1, .container-image-text pre, .container-image-text h2, .container-image-text h3, .container-image-text h4, .container-image-text h5, .container-image-text p');

  // Crée l'observer
  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // On récupère tous les éléments frères à animer dans la même section
        const parent = entry.target.closest('.container-text-only, .container-image-text');
        const siblings = parent.querySelectorAll('h1, h2, h3, h4, h5, p, pre');
        siblings.forEach((el, i) => {
          setTimeout(() => {
            el.classList.add('text-appear');
          }, 100 * i);
        });
        // On arrête d'observer cette section
        siblings.forEach(el => obs.unobserve(el));
      }
    });
  }, { threshold: 0.2 }); // 0.2 = 20% visible

  // Observe chaque élément
  elements.forEach(el => observer.observe(el));
});
</script>

<script>
(function() {
  function showTransition() {
    const transition = document.getElementById('page-transition');
    if (transition) {
      transition.classList.add('active');
      transition.classList.remove('hide');
      console.log('Transition active !');
    }
  }


  document.addEventListener('DOMContentLoaded', function() {


    // Utilise event delegation pour TOUS les clics sur <a>
    document.body.addEventListener('click', function(e) {
      const link = e.target.closest('a');
      if (!link) return;
      const href = link.getAttribute('href');
      if (
        href &&
        !href.startsWith('#') &&
        !link.hasAttribute('download') &&
        !link.classList.contains('no-transition')
      ) {
        e.preventDefault();


        showTransition();
        setTimeout(() => {
          window.location = href;
        }, 700);
      }
    });
  });

  window.addEventListener('pageshow', hideTransition);
})();
</script>

<div id="page-transition"></div>
