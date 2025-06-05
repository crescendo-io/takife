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

})();
</script>

<div id="page-transition"></div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const sections = document.querySelectorAll('.container-image-full');

  sections.forEach(section => {
    const image = section.querySelector('.image-strate');
    if (!image) return;

    // Fonction pour calculer et appliquer le zoom
    function updateZoom() {
      const sectionRect = section.getBoundingClientRect();
      const viewportHeight = window.innerHeight;

      // Calcule la position de la section dans le viewport (0 quand le haut arrive, 1 quand le bas quitte)
      // On ajuste pour que le zoom se fasse quand la section est visible
      const scrollProgress = Math.max(0, Math.min(1, (viewportHeight - sectionRect.top) / (viewportHeight + sectionRect.height)));

      // Calcule l'échelle de zoom (par exemple, de 1.1 à 1.5)
      const initialScale = 1.1;
      const maxScale = 1.3; // Zoom maximum (ajuste si besoin)
      const scale = initialScale + (maxScale - initialScale) * scrollProgress;

      image.style.transform = `scale(${scale})`;
    }

    // Met à jour le zoom initialement
    updateZoom();

    // Ajoute l'écouteur d'événement scroll pour mettre à jour le zoom
    window.addEventListener('scroll', updateZoom);

    // Optionnel: Retire l'écouteur quand la section n'est plus dans le viewport
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) {
          // Si la section quitte le viewport (haut ou bas), on pourrait retirer l'écouteur
          // window.removeEventListener('scroll', updateZoom); // <-- Activer si tu veux optimiser
        } else {
          // Si la section entre (ou reste), assure-toi que l'écouteur est là
          // window.addEventListener('scroll', updateZoom); // <-- Activer si tu veux optimiser
          updateZoom(); // Met à jour la position au cas où
        }
      });
    }, { threshold: [0, 1] }); // Observer l'entrée et la sortie complète
    observer.observe(section);
  });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Définit la largeur maximale pour considérer comme mobile
  const mobileMaxWidth = 768; // Correspond à ta media query CSS

  // Vérifie si on n'est PAS en mobile
  if (window.innerWidth > mobileMaxWidth) {

    const parallaxSection = document.querySelector('.strate-hero');
    const parallaxImage = parallaxSection ? parallaxSection.querySelector('img') : null;

    if (!parallaxSection || !parallaxImage) {
      console.log("Section .strate-hero ou image non trouvée pour le parallax.");
      return; // Arrête le script si la section ou l'image n'existe pas
    }

    // Facteur de parallax (ajuste cette valeur : plus elle est élevée, plus l'image bouge)
    const parallaxFactor = 0.4;

    function updateParallax() {
      const sectionRect = parallaxSection.getBoundingClientRect();
      const viewportHeight = window.innerHeight;

      // Calcule la position du centre de la section par rapport au centre du viewport
      const sectionCenterRelativeToViewport = sectionRect.top + sectionRect.height / 2 - viewportHeight / 2;

      // Calcule le décalage vertical pour l'image
      const translateY = sectionCenterRelativeToViewport * -parallaxFactor;

      // Applique le décalage à l'image
      parallaxImage.style.transform = `translateY(${translateY}px)`;
    }

    // Met à jour le parallax initialement
    updateParallax();

    // Ajoute l'écouteur d'événement scroll pour mettre à jour le parallax
    // Cet écouteur sera ajouté et retiré par l'IntersectionObserver pour optimisation
    // window.addEventListener('scroll', updateParallax); // Cette ligne n'est plus nécessaire ici grâce à l'observer

    // Utilise IntersectionObserver pour n'appliquer le parallax que quand la section est visible
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // Commence à écouter le scroll quand la section entre dans le viewport
          window.addEventListener('scroll', updateParallax);
          updateParallax(); // Assure la bonne position au moment de l'entrée
        } else {
          // Arrête d'écouter le scroll quand la section quitte le viewport
          window.removeEventListener('scroll', updateParallax);
        }
      });
    }, { threshold: 0 }); // Déclenche quand 0% de la section est visible
    observer.observe(parallaxSection);

    // Optionnel: Gérer le redimensionnement de la fenêtre
    window.addEventListener('resize', () => {
        // Recharge la page si on passe de mobile à desktop ou vice-versa pour appliquer/désactiver le parallax
        // window.location.reload(); // Pas toujours souhaitable, mais simple. Une meilleure approche serait de nettoyer/initialiser les listeners ici.
         if (window.innerWidth <= mobileMaxWidth) {
             // Si on est repassé en mobile, on s'assure de nettoyer les listeners
             window.removeEventListener('scroll', updateParallax);
             observer.disconnect(); // Arrête l'observation
             // Optionnel: Remettre l'image à sa position par défaut si nécessaire
             if(parallaxImage) parallaxImage.style.transform = 'translateY(0px)';
         } else {
             // Si on est repassé en desktop, ré-initialiser l'observateur et l'écouteur scroll
             // Une simple réinitialisation comme le code ci-dessus est complexe. Le plus simple est souvent de recharger ou de faire un setup/teardown plus sophistiqué.
             // Pour l'instant, on se contente de désactiver en mobile.
         }
    });


  } else {
      // Si on est en mobile, on s'assure que l'image est à sa position par défaut
      const parallaxSection = document.querySelector('.strate-hero');
      const parallaxImage = parallaxSection ? parallaxSection.querySelector('img') : null;
       if(parallaxImage) parallaxImage.style.transform = 'translateY(0px)';
      console.log("Parallax désactivé en mobile.");
  }

});
</script>
