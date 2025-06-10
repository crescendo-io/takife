<?php

add_action( 'wp_enqueue_scripts', 'wpm_enqueue_styles' );
function wpm_enqueue_styles(){
    //wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/styles/theme.css' );
    wp_enqueue_style('theme', get_stylesheet_directory_uri() . '/styles/theme.css', array(), filemtime(get_template_directory() . '/styles/theme.css'));
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap', false );
}


function wpm_custom_post_type() {

    // On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
    $labels = array(
        'name'                => _x( 'Demande de contact', ''),
    );

    // On peut définir ici d'autres options pour notre custom post type

    $args = array(
        'label'               => __( 'Contact'),
        'description'         => __( 'Contact'),
        'labels'              => $labels,

        'show_in_rest' => false,
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => false,
        'publicly_queryable'  => false,
        'with_front'          => false,
        'query_var'           => false,
        'exclude_from_search' => true,

        //'rewrite'			  => array( 'slug' => 'contact'),

    );

    // On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
    register_post_type( 'contact', $args );

}

add_action( 'init', 'wpm_custom_post_type', 0 );


add_filter( 'gettext', 'custom_translate_checkout_fields', 20, 3 );
function custom_translate_checkout_fields( $translated_text, $text, $domain ) {
    $translations = array(
        'First name' => 'Prénom',
        'Last name' => 'Nom',
        'Street address' => 'Adresse',
        'Add apartment, suite, unit, etc.' => 'Complément d’adresse',
        'Town / City' => 'Ville',
        'State / County' => 'Région / Département',
        'Postcode / ZIP' => 'Code postal',
        'Country / Region' => 'Pays',
    );

    if ( isset( $translations[ $text ] ) ) {
        $translated_text = $translations[ $text ];
    }

    return $translated_text;
}
