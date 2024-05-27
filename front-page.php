<?php
/*
Template Name: Page Landing
*/
get_header();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $nom = sanitize_text_field($_POST["nom"]);
    $prenom = sanitize_text_field($_POST["prenom"]);
    $email = sanitize_email($_POST["email"]);
    $telephone = sanitize_text_field($_POST["telephone"]);
    $sujet = sanitize_text_field($_POST["sujet"]);
    $consentement = isset($_POST["consentement"]) ? sanitize_text_field($_POST["consentement"]) : '';

    $website_field = $_POST["website"];
    if (!empty($website_field)) {
        echo '<p>Votre formulaire a été détecté comme du spam. Veuillez réessayer.</p>';
        die;
    }

    // Vérifiez le consentement
    if (empty($consentement)) {
        echo '<p>Veuillez donner votre consentement en cochant la case.</p>';
    } else {
        // Créez un tableau avec toutes les données du formulaire
        $contact_content = "Nom: $nom\nPrénom: $prenom\nEmail: $email\nTéléphone: $telephone\nSujet: $sujet\nConsentement: Oui";

        // Créez un tableau avec les données du formulaire pour les champs personnalisés (si nécessaire)
        $contact_data = array(
            'post_title'   => $nom . ' ' . $prenom,
            'post_content' => $contact_content,
            'post_status'  => 'draft',
            'post_type'    => 'contact',
            'meta_input'   => array(
                'nom'         => $nom,
                'prenom'      => $prenom,
                'email'       => $email,
                'telephone'   => $telephone,
                'sujet'       => $sujet, // Ajoutez le sujet comme champ personnalisé si nécessaire
                'consentement' => $consentement,
            ),
        );

        // Insérez le nouveau post dans la base de données
        $post_id = wp_insert_post($contact_data);

        if ($post_id) {
            $returnMesage =  '<p>Votre demande de contact a été enregistrée avec succès.</p>';
        } else {
            $returnMesage =  '<p>Une erreur s\'est produite. Veuillez réessayer.</p>';
        }
    }
}



if( have_rows('page') ):
    while ( have_rows('page') ) : the_row();
        get_template_part('template-parts/strates/' . get_row_layout());
    endwhile;
endif;

?>




<?php get_footer(); ?>

