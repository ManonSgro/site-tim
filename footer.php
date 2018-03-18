    </div> <!-- Fermeture de la boîte #main -->
     <!-- Fermeture de la boîte #background -->

</div><!-- Fermeture de la boîte #contenu -->

    <!-- Ouverture de #pied-de-page -->

<div class="section--white">
    <footer id="pied-de-page" >
        <div class="pied-de-page__header">
            <div class="pied-de-page__links">
                <div class="cegep">
                    <h3>Cégep</h3>
                    <p>
                        <br class="br">
                        Cégep de Sainte-Foy<br>
                        2410 chemin Sainte-Foy, Québec<br>
                        G1V 1T3<br>
                        <a class="pied-de-page__button--purple" href="https://www.google.ca/maps/dir/46.7868837,-71.2800122/C%C3%A9gep+de+Sainte-Foy,+2410+Ch+Ste-Foy,+Ville+de+Qu%C3%A9bec,+QC+G1V+1T3/@46.7860353,-71.2877607,16z/data=!3m1!4b1!4m10!4m9!1m1!4e1!1m5!1m1!1s0x4cb896dea093d777:0xf81581457f682cd6!2m2!1d-71.287032!2d46.786566!3e0" target="_blank">Voir sur Google Maps<i class="flaticon-external"></i></a>
                    </p>
                    <a href="http://www.cegep-ste-foy.qc.ca"><img alt="Cégep de Sainte-Foy" src="<?php echo get_bloginfo('template_directory').'/logo_cegep_officiel/index.png'?>" class="pied-de-page__image"></a>
                </div>


                <div class="social_media">

                    <h3>Suis-nous</h3>
                    <ul class="social_media__list">
                        <li class="social_media__icon"><a href="https://www.facebook.com/timcsf" class="social_media__link"><i class="flaticon-facebook-logo social_media__flaticon"></i><div class="sr-only">Facebook</div></a></li>
                        <li class="social_media__icon"><a href="https://twitter.com/timcsf" class="social_media__link"><i class="flaticon-twitter-logo-on-black-background social_media__flaticon"></i><div class="sr-only">Twitter</div></a></li>
                    </ul>
                </div>
                
                
            </div>

            <div class="hautDePage">
                <a href="#top" class="hautDePage__link"><i class="flaticon-left-arrow"></i>Haut de page</a>
            </div>
        </div>
        
        <div class="credits">
            <p><?php the_author(); ?> | &copy; Tous droits réservés</p>
        </div>
    </footer>
    
</div>

<!-- Fermeture de #pied-de-page -->

    <?php wp_footer(); ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/script.js"></script>

<script src="<?php echo get_bloginfo('template_directory').'/progressive-image.js-master/js/progressive-image.min.js' ?>"></script>
</body>

</html>