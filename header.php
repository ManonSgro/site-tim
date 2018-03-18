<!DOCTYPE html>
<html <?php language_attributes(); ?> >
    <head>
        
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        
        <title>
            <?php bloginfo('name'); ?> &mdash; <?php bloginfo('description'); ?>
        </title>
        
        <script src='https://www.google.com/recaptcha/api.js'></script>
        
        <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory').'/progressive-image.js-master/css/progressive-image.min.css' ?>">

        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory').'/flaticon/font/flaticon.css' ?>">
        <?php wp_head(); ?>
    </head>
    
<body <?php body_class(); ?>>
    
    <!-- Ouverture de la boîte #main -->
    <div id="main">
        
    <!-- Ouverture de la boîte #background -->
        <div id="background"></div>
    
    <!-- Ouverture de la boîte #en-tête -->
    
    <div id="en-tete">        
            
        <!-- Menu "principal" actif -->
        <?php if ( has_nav_menu( 'principal' ) ) : ?>
            <nav id="principal" class="navigation">
                <!-- Logo -->
                <div class='menu__logo'><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img alt="Accueil" src="<?php the_field('image') ?>"></a></div>
                <div class="menu__links">
                <!--<div class="menu__menu-hamburger" onclick="menu()">
                    <span class="menu__menu-hamburger-line"></span>
                    <span class="menu__menu-hamburger-line"></span>
                    <span class="menu__menu-hamburger-line"></span>
                </div>-->
                    <?php wp_nav_menu( array('theme_location'=>'principal')); ?>
                </div>
                
            </nav>
        <?php endif; ?>
        
        
        
        <!-- Menu "secondaire" actif -->
        <?php if ( has_nav_menu( 'secondaire' ) ) : ?>
            <nav id="secondaire">
                <?php wp_nav_menu( array('theme_location'=>'secondaire')); ?>
            </nav>
        <?php endif; ?>
    </div>
