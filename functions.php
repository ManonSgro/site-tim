<?php
    /* Création des emplacements des menus */
    if (function_exists('register_nav_menus')) {
        register_nav_menus(
        array(
        'principal' => 'Menu principal',
        'secondaire' => 'Menu secondaire'
        )
        );
    }

    /* Création des emplacements pour les sidebars*/
    if (function_exists('register_sidebar')) {
        register_sidebar(
        array(
            'id' => 'gauche',
            'name' => 'Emplacement gauche',
            'description' => 'Emplacement à gauche des widgets',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3>',
            'after_title' => '</h3>'
        )
    );
        register_sidebar(
        array(
            'id' => 'droite',
            'name' => 'Emplacement droite',
            'description' => 'Emplacement à droite des widgets',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3>',
            'after_title' => '</h3>'
        )
    );
    }

/* Ajout des formats d'article */
add_theme_support( 'post-formats', array(
'aside', 'image', 'video', 'quote', 'link', 'gallery',
'status', 'audio', 'chat'
) );

/*Ajout d'un logo */
    ///

/* Split title */

function last_span_title($title) {
        $lines = explode(' ', $title);
        $output = false;
        $count = 0;

        foreach( $lines as $line ) {
            $count++;
            $output .= '<span class="span-'.$count.'">'.$line.'</span> ';
        }

        return $output;
}

/* Créer deux nouveaux types d'articles */

function create_diplome_post_type() {
  register_post_type( 'diplome',
    array(
      'labels' => array(
        'name' => __( 'Diplomés' ),
        'singular_name' => __( 'Diplomé' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'diplomes'),
    )
  );
  register_post_type( 'projet',
    array(
      'labels' => array(
        'name' => __( 'Projets' ),
        'singular_name' => __( 'Projet' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'projets'),
    )
  );
}
add_action( 'init', 'create_diplome_post_type' );

/* Première lecture des articles */
function mon_diplome_get_posts($query){
    if(is_home())
        $query->set('post_type', array('diplome'));
    return $query;
}
add_filter('pre_get_posts', 'mon_diplome_get_posts');

//Sessions php

add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myEndSession');

function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function myEndSession() {
    session_destroy ();
}

?>


