<?php
/*Template Name: 404*/
?>

<?php get_header(); ?> <!-- Appel au template de l'en-tête -->


<div id="contenu">
    <div id="page_404" class="section--white">
        <h1 class="title">Erreur <span class="title--highlight">404</span></h1>
        <p class="texte">La page demandée est introuvable...</p>
        <h2>Plan du site</h2>
        <ul>
            <li><a class="texte__link" href="<?php echo esc_url( home_url( '/' ) ); ?>">Page d'accueil</a></li>
            <li><a class="texte__link" href="<?php echo esc_url( home_url( '/' ) ); ?>projets/133/">Nos projets</a></li>
            <li><a class="texte__link" href="<?php echo esc_url( home_url( '/' ) ); ?>nous-joindre">Nous joindre</a></li>
        </ul>
        </div>

<?php get_footer(); ?> <!-- Appel au template du pied de page -->