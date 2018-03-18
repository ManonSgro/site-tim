<?php
    /*Front Page gabarit */
    //Appel au gabarit de l'entête
    get_header();
?>

<!--Contenu de la page d'accueil-->
<?php
    if('posts'==get_option('show_on_front')){
        include(get_home_template());
    }else{
        include(get_page_template('content','accueil'));
    }
?>

<?php
    get_footer();
?>