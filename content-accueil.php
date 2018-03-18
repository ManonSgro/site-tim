<?php
/*Template Name: Accueil*/
?>

<header id="top" class="header section--trapezoid-right">
            <div class="header__titles">
            <h1 class="header__title--bold">
                <?php
                    echo last_span_title(get_field('titre'));
                ?>
            </h1>
            <h2 class="header__title--light">
                <?php the_field('sous-titre') ?> 
            </h2>
                
            <!-- Not customizable ??? -->
            <div>    
                <a class="header__button--purple" href="#decouvrir">Découvrir</a>
                <a class="header__button--white" href="#inscriptions">S'inscrire au programme</a>
            </div>
            </div>
            
    <?php

    //Connexion. Pourrait être dans le fichier de configuration et appelé en include...

    $strDsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
    $pdoConnexion = new PDO($strDsn, DB_USER,DB_PASSWORD);
    $pdoConnexion -> exec("SET CHARACTER SET utf8");
    

    //Établissement et exécution de la requête réparée à la base de données
        $strRequete = "SELECT nom_diplome,prenom_diplome FROM tim_diplome ORDER BY RAND() LIMIT 1";
    $pdosResultat = $pdoConnexion->prepare($strRequete);
    $pdosResultat->execute();

    //Récupération du code d'erreur, s'il y a lieu
    $intCodeErreur = $pdosResultat->errorCode();

    //Récupère l'enregistrement du dilpomé
    $arrProjet = $pdosResultat->fetch();

    //Affiche les infos du projet

    ?>
            <div class="header__image">
                <img src="<?php echo get_bloginfo('template_directory') ?>/../../uploads/2018/03/fond.jpg" alt="<?php echo strtolower($arrProjet["prenom_diplome"]." ".$arrProjet["nom_diplome"]); ?>">
            </div>
            
        </header>
    
    <!-- Ouverture du conteneur #contenu -->
    <div id="contenu">

<div class="section--purple  section--trapezoid-left">
    <h1 class="title">Nos <span class="title--highlight">projets</span></h1>
    
    
    <div class="galerie__projets">
            
    <!-- Sélection aléatoire et affichage de quatre projets -->
    
    <?php

    //Connexion. Pourrait être dans le fichier de configuration et appelé en include...

    $strDsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
    $pdoConnexion = new PDO($strDsn, DB_USER,DB_PASSWORD);
    $pdoConnexion -> exec("SET CHARACTER SET utf8");

    //Récupération de l'identifiant du diplomé(ACF)
    $id_projet = get_field('id_projet');

        if($_SESSION["slugs"]==null){
        //Établissement et exécution de la requête réparée à la base de données
        $strRequete = "SELECT * FROM tim__projet_diplome ORDER BY RAND() LIMIT 10";
        $pdosResultat = $pdoConnexion->prepare($strRequete);
        $pdosResultat->bindparam(":id_projet", $id_projet);
        $pdosResultat->execute() or die("error");

        //Récupération du code d'erreur, s'il y a lieu
        $intCodeErreur = $pdosResultat ->errorCode();
        $slugs = array();
        $titres_projets = array();
        $ids_projets = array();
        $cats_projets = array();
        while($projet = $arrProjet = $pdosResultat->fetch(PDO::FETCH_ASSOC)){
            array_push($slugs,$projet['slug']);
            array_push($titres_projets,$projet['titre_projet']);
            array_push($ids_projets,$projet['id_projet']);
            array_push($cats_projets,$projet['cat_projet']);
        }
        
        $_SESSION["slugs"]= $slugs;
        $_SESSION["titres_projets"]= $titres_projets;
        $_SESSION["ids_projets"]= $ids_projets;
        $_SESSION["cats_projets"]= $cats_projets;
    }
    

    //Récupère l'enregistrement du dilpomé
    for($i=0;$i<4;$i++){
        echo '<a class="galerie__project__link" href="'.get_home_url().'/projets/'.$_SESSION["slugs"][$i].'/"><div class="galerie__project"><div class="galerie__project__image"><img src="'. get_bloginfo('template_directory').'/../../uploads/00_Images_projets/prj'.$_SESSION["ids_projets"][$i].'_01.jpg" alt="Projet '.$_SESSION["titres_projets"][$i].'"></div><h2 class="galerie__project__title">'.$_SESSION["titres_projets"][$i].'</h2><h3 class="galerie__project__subtitle">'.$_SESSION["cats_projets"][$i].'</h3></div></a>';
        };
    ?>
            
        
    </div>
    
    <a class="button--white" href="<?php echo get_home_url(); ?>/projets/133">Voir les projets</a>
    
</div>

<div class="section--white--padding section--trapezoid-right" id="decouvrir">
    <h1 class="title title--highlight ghost-title">Découvrir</h1>
    <h1 class="title title--left">Etudiant <span class="title--highlight">d'un jour</span></h1>
    <p class="texte texte--left">
        Tu veux en apprendre plus sur le programme ? Tu veux assister à un ou plusieurs cours ?<span class="texte--bold"> Viens passer une journée avec nous</span>, en Techniques d'intégration multimédia !
        <br class="br">
        Contacte <a class="texte__link" href="index.php/nous-joindre?contact=etudiant_dun_jour">Benoît Frigon</a> pour en savoir plus.
    </p>
    <a class="button--purple" href="index.php/nous-joindre?contact=etudiant_dun_jour">Visiter la TIM</a>
    
    <h1 class="title title--right">Fais-tu <span class="title--highlight">le bon choix ?</span></h1>
    <form class="form">
        <nav class="form__nav">
            <ul>
                <li class="form__nav__item"><input id="link__Q1" class="form__nav__item--question" type="radio" name="link__Q" value="Q1" checked><label for="link__Q1">1</label></li>
                <li class="form__nav__item"><input id="link__Q2" class="form__nav__item--question" type="radio" name="link__Q" value="Q2"><label for="link__Q2">2</label></li>
                <li class="form__nav__item"><input id="link__Q3" class="form__nav__item--question" type="radio" name="link__Q" value="Q3"><label for="link__Q3">3</label></li>
                <li class="form__nav__item"><input id="link__Q4" class="form__nav__item--question" type="radio" name="link__Q" value="Q4"><label for="link__Q4">4</label></li>
                <li class="form__nav__item"><input id="link__Q5" class="form__nav__item--question" type="radio" name="link__Q" value="Q5"><label for="link__Q5">5</label></li>
                <li class="form__nav__item"><button id="#refreshQuiz" class="form__button--rounded" type="button"><i class="flaticon-refresh"></i><span class="sr-only">Recommencer</span></button></li>
            </ul>
        </nav>
        <h2 class="form__title">Question <span class="replaceQuestion">1</span> :</h2>
        <p class="form__texte texte--left replaceQuestion">Lors de ma formation en Techniques d’intégration multimédia, j’espère travailler à créer et assembler différents médias : images, vidéo, son, etc.</p>
        <input id="reponse1" class="form__input" type="radio" name="Q1" value="Oui"><label for="reponse1">Oui</label>
        <input id="reponse2" class="form__input" type="radio" name="Q1" value="Non"><label for="reponse2">Non</label>
        
        <p class="form__texte texte--left text-to-reveal" id="replaceReponse"></p>
        
        <div class="form__button">
            <button id="nav_prev" class="form__button--square" type="button" data-to="Q1">Précédente</button>
            <button id="nav_next" class="form__button--square" type="button" data-to="Q2">Suivante</button>
        </div>
    </form>
    
    

    
</div>

<div class="section--white--padding section--trapezoid-left">
    <h1 class="title title--highlight ghost-title">Découvrir</h1>
    <h1 class="title title--left">La <span class="title--highlight">TIM</span> c'est</h1>
    <p class="texte texte--left">
        une formation <span class="texte--bold">polyvalente</span> pour intervenir dans toutes les étapes de production d’une application <span class="texte--bold">multimédia</span>.
    </p>
    <div class="galerie">
        <p class="galerie__stats">
            
            <svg width="170px" height="170px" viewBox="0 0 170 170" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 44.1 (41455) - http://www.bohemiancoding.com/sketch -->
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g transform="translate(-217.000000, -2885.000000)">
            <circle stroke="#5D119F" stroke-width="9" fill="#FFFFFF" cx="302" cy="2970" r="80"></circle>
            <path d="M303.957296,2918.56621 C302.824878,2917.81126 301.440811,2917.81126 300.308393,2918.56621 L250.481986,2952.91623 C249.601217,2953.54535 249.09792,2954.42612 249.09792,2955.55854 C249.09792,2955.93601 249.09792,2956.06184 249.09792,2956.18766 L249.09792,2982.98823 C244.945719,2984.74977 242.932531,2989.53109 244.568246,2993.80912 C246.203962,2998.08714 251.111108,2999.9745 255.389133,2998.33879 C259.667157,2996.70307 261.554521,2991.79593 259.918806,2987.5179 C259.038036,2985.50471 257.528145,2983.869 255.389133,2982.98823 L255.389133,2961.22063 L267.971558,2969.02174 L267.971558,2971.4124 C267.971558,2971.78987 268.097383,2972.29317 268.223207,2972.67064 C267.845734,2974.68383 267.468261,2976.69702 267.468261,2978.7102 L266.335843,3008.65638 C259.541333,3015.57671 255.766605,3024.88771 255.766605,3034.57618 L255.766605,3037.72178 C255.766605,3039.48332 257.150672,3040.86739 258.912212,3040.86739 C278.035858,3046.98444 292.27497,3050.04297 301.629548,3050.04297 C310.984126,3050.04297 325.139355,3046.98444 344.095235,3040.86739 C345.856775,3040.86739 347.240841,3039.48332 347.240841,3037.72178 L347.240841,3034.57618 C347.240841,3024.88771 343.466114,3015.57671 336.671604,3008.53055 L335.66501,2978.7102 C335.539185,2976.69702 335.287537,2974.68383 334.910064,2972.67064 C335.161713,2972.29317 335.161713,2971.78987 335.161713,2971.28657 L335.161713,2968.01514 L352.52546,2957.06843 C354.035351,2956.18766 354.412824,2954.17447 353.532054,2952.66458 C353.40623,2952.53876 353.154582,2952.28711 352.777109,2952.03546 L303.957296,2918.56621 Z M250.230338,2990.66351 C250.230338,2989.53109 251.111108,2988.65032 252.243526,2988.65032 C253.375944,2988.65032 254.256714,2989.53109 254.256714,2990.66351 C254.256714,2991.79593 253.375944,2992.6767 252.243526,2992.6767 C251.111108,2992.6767 250.230338,2991.79593 250.230338,2990.66351 Z M274.262771,2957.69755 C292.003992,2951.90964 311.255103,2951.90964 328.996324,2957.69755 L328.996324,2967.13437 C323.837529,2965.62448 318.55291,2964.49206 313.268292,2963.73712 C313.016643,2963.73712 312.890819,2963.61129 312.63917,2963.61129 C299.805096,2962.1014 286.719373,2963.23382 274.262771,2967.00855 L274.262771,2957.69755 Z M313.771589,3001.73604 C313.771589,3008.40473 308.361145,3013.81517 301.69246,3013.81517 C295.023774,3013.81517 289.613331,3008.40473 289.613331,3001.73604 L289.613331,3000.22615 C297.036962,3004.88165 306.347957,3004.88165 313.771589,3000.22615 L313.771589,3001.73604 Z M318.049613,2981.85581 C318.049613,2990.91516 310.751806,2998.21296 301.69246,2998.21296 C292.633113,2998.21296 285.335306,2990.91516 285.335306,2981.85581 C285.335306,2981.72999 285.335306,2981.72999 285.335306,2981.60416 L284.832009,2976.82284 C284.832009,2976.82284 284.832009,2976.69702 284.957833,2976.69702 L292.381465,2974.43218 L292.633113,2974.30636 C295.401247,2973.17394 297.791908,2971.4124 299.93092,2969.27339 C303.579824,2969.14756 307.102903,2969.39921 310.751806,2969.65086 C312.63917,2972.41899 316.16225,2973.92888 318.678735,2974.68383 L318.049613,2981.85581 Z" fill="#5D119F" fill-rule="nonzero"></path>
        </g>
    </g>
</svg>
            <span class="text--bold">3 ans de formation</span>professionnalisante</p>
        <p class="galerie__stats">
             
           
            <svg width="170px" height="170px" viewBox="0 0 170 170" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 44.1 (41455) - http://www.bohemiancoding.com/sketch -->
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g transform="translate(-567.000000, -2885.000000)">
            <circle stroke="#5D119F" stroke-width="9" fill="#FFFFFF" cx="652" cy="2970" r="80"></circle>
            <g transform="translate(602.000000, 2927.000000)" fill-rule="nonzero" fill="#5D119F">
                <g>
                    <path d="M9.63953488,95 L35.9928492,85.2639535 L35.9928492,7.3755814 L9.63953488,-2.36046512 L9.63953488,95 Z M44.5627337,67.2187322 L46.7966155,67.2187322 L46.7966155,47.4404946 L44.0586229,47.4404946 C42.5322271,47.4415764 41.1161733,48.7299798 41.1205004,50.4272973 C41.1161733,50.468405 41.1205004,64.1626953 41.1205004,64.1626953 C41.117255,66.0806965 42.567926,67.1819516 44.0586229,67.1851969 L44.5627337,67.1851969 L44.5627337,67.2187322 Z M89.5205512,16.966669 C90.1068775,13.2453357 87.5668512,9.75983101 83.844436,9.1702593 C80.131757,8.58393295 76.6440888,11.1250411 76.0577624,14.8420473 C75.4703543,18.5590535 78.0082171,22.0488853 81.7241415,22.6352116 C85.4454748,23.2193744 88.9298977,20.6804298 89.5205512,16.966669 L89.5205512,16.966669 Z M71.5705267,34.0804752 L67.417562,47.4740298 L66.9707857,47.4740298 L64.7855841,47.4740298 L64.7855841,55.9573717 L64.7855841,67.2187322 L63.2992143,67.2187322 L63.2992143,60.7529155 L63.2992143,47.4740298 L59.897007,47.4740298 L59.897007,44.6354314 C59.897007,44.4720822 59.8375089,44.3357775 59.7931558,44.1929822 L66.2654632,36.2429593 L71.5705267,34.0804752 Z M58.4452543,47.4740298 L53.1542539,47.4740298 L53.1542539,44.5532159 L54.3312337,44.5532159 C54.4859287,44.7565911 54.6124973,44.9772748 54.8201996,45.1471147 C55.8803469,46.0114593 57.3180364,46.0893477 58.4452543,45.4651589 L58.4452543,47.4740298 Z M101.664647,51.0071329 C101.584595,50.1600969 101.175681,49.3433508 100.463867,48.7678422 L91.2578946,41.3792647 L86.4731686,28.5179473 C86.3628267,28.2182934 86.2038047,27.9597473 86.0231469,27.7206733 C85.1436574,26.2602663 83.7654659,25.095186 82.010814,24.5607853 C80.5514888,24.1172543 79.0640372,24.1680981 77.7161357,24.6008112 C77.5268236,24.6462461 77.3385934,24.6949264 77.1557721,24.7695694 L63.0374229,30.5257364 C62.5300667,30.7280298 62.0865357,31.0601372 61.7403651,31.4831143 L54.349624,40.5625186 C53.7762791,41.2667593 53.5501864,42.1365128 53.6410562,42.9716492 C52.5517008,42.9770581 51.6613934,43.6228826 51.6689659,44.6354314 L51.6689659,47.4740298 L48.2851488,47.4740298 L48.2851488,67.2187322 L60.4660248,67.2187322 L51.5954047,76.1953671 C49.8266895,77.9867996 49.8450798,80.8719147 51.6375942,82.6406298 C53.4322721,84.4115085 56.3163054,84.3942 58.0861023,82.6016857 L68.7665453,71.7806109 C69.0997345,71.4430946 69.3701802,71.0547345 69.5832915,70.6350027 C69.6914698,70.4424453 69.7920756,70.2455609 69.8742911,70.0335314 L73.2397178,59.3336163 L82.2964047,68.445474 L82.2964047,84.1453899 C82.2964047,86.6626988 84.3366473,88.7029415 86.855038,88.7029415 C89.3755922,88.7029415 91.4169167,86.6626988 91.4169167,84.1453899 L91.4169167,66.7719558 C91.4169167,66.6767589 91.4115078,66.5848074 91.4039353,66.4950194 L91.4223256,66.4906922 C91.3433554,65.6360837 91.0253112,64.817174 90.4984829,64.1356508 L80.5439163,53.8846756 L84.3398926,41.4668891 L85.4638651,44.4893907 C85.6704857,45.0432636 86.0220651,45.5279023 86.4785775,45.8946267 L96.3823004,53.8457314 C97.7853729,54.9751128 99.8353516,54.7501019 100.964733,53.349193 C101.51536,52.6644244 101.740371,51.8195519 101.664647,51.0071329 L101.664647,51.0071329 Z"></path>
                </g>
            </g>
        </g>
    </g>
</svg>
            <span class="text--bold">94% d’embauche</span>dans un secteur d’avenir</p>
        <p class="galerie__stats">
            
            <svg width="170px" height="170px" viewBox="0 0 170 170" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 44.1 (41455) - http://www.bohemiancoding.com/sketch -->
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g transform="translate(-896.000000, -2885.000000)">
            <circle stroke="#5D119F" stroke-width="9" fill="#FFFFFF" cx="981" cy="2970" r="80"></circle>
            <g transform="translate(602.000000, 2927.000000)" fill-rule="nonzero" fill="#5D119F">
                <g>
                    <g transform="translate(315.000000, 7.000000)">
                        <path d="M105.580936,22.9795745 C104.95183,20.8702979 104.347234,18.7555745 103.757617,16.636766 C103.064511,14.140766 101.847149,11.210383 101.847149,8.58638298 C98.4646809,10.1754894 95.1829787,11.8966809 91.4628085,12.4590638 C89.2677447,12.7913191 87.2360851,12.6497021 85.0328511,12.6074894 C82.9290213,12.568 80.8537872,12.7150638 78.7485957,12.6428936 C75.6262128,12.5353191 72.4697872,12.4222979 69.3732766,11.9634043 C67.4083404,11.6733617 65.3262979,11.9157447 63.4771064,12.6428936 C62.0377872,13.2066383 61.1744681,14.2388085 59.931234,15.0285957 C58.8922553,15.6876596 57.8355745,16.3222128 56.7693617,16.9349787 C55.4417021,17.7002553 53.3937021,18.3048511 52.3547234,19.3996596 C50.9045106,20.9288511 49.6027234,22.396766 48.8251915,24.380766 C48.1089362,26.2108936 47.5451915,28.1295319 46.349617,29.7227234 C45.4413617,30.9278298 44.1627234,31.8646809 43.506383,33.253617 C42.7833191,34.7800851 43.9217021,35.7850213 45.3147234,36.2643404 C47.0604255,36.8648511 49.0934468,36.6415319 50.6948085,35.7387234 C53.9560851,33.893617 55.2864681,30.04 58.1324255,27.7264681 C60.9538723,25.432 65.8587234,23.8238298 69.2697872,25.6471489 C71.0454468,26.5948936 72.4629787,28.0845957 74.2291064,29.0745532 C76.1491064,30.1475745 78.1753191,31.0040851 80.0721702,32.1193191 C84.0646809,34.4614468 87.6255319,37.4 91.8277447,39.3894468 C95.899234,41.3135319 100.281191,42.9965957 103.553362,46.2170213 C104.945021,45.1739574 106.327149,44.1077447 107.633021,42.9557447 C108.549447,42.1441702 109.284766,41.1746383 110.212085,40.3848511 C110.917447,39.7829787 111.682723,39.2491915 112.513362,38.835234 C108.740085,34.6071489 106.886809,28.325617 105.580936,22.9795745 Z"></path>
                        <path d="M102.827574,49.9412766 C100.785021,46.3300426 96.9477447,44.3460426 93.3092766,42.725617 C89.1451915,40.8682553 85.4917447,38.538383 81.7198298,35.9988085 C78.299234,33.6975319 74.4701277,31.7121702 70.7349787,29.9732766 C70.1821277,29.7145532 70.2284255,29.322383 69.7504681,28.9138723 C69.1022979,28.3555745 68.4214468,27.7836596 67.6017021,27.4963404 C65.8028936,26.8699574 63.2851064,27.5671489 61.6347234,28.3542128 C58.2495319,29.9678298 56.7557447,33.5518298 54.1821277,36.0600851 C51.4042553,38.771234 47.0073191,39.9518298 43.4069787,38.0781277 C42.3775319,37.5402553 41.3371915,36.554383 40.9817872,35.4377872 C40.4071489,33.6335319 41.5114894,31.7802553 42.6022128,30.4226383 C43.8440851,28.8730213 45.1377021,27.6025532 45.8430638,25.701617 C46.5715745,23.7448511 47.1557447,21.8711489 48.4071489,20.1676596 C45.9765106,20.7191489 43.4914043,21.6437447 40.987234,21.6137872 C39.538383,21.5960851 38.3768511,21.1222128 37.0573617,20.6674043 C35.0788085,19.9824681 33.1002553,19.2961702 31.1230638,18.611234 C30.5062128,18.3988085 30.477617,19.2389787 30.2651915,19.7754894 C27.0597447,27.7904681 23.8542979,35.8040851 20.6474894,43.8190638 C19.9993191,45.4449362 19.3484255,47.0721702 18.6975319,48.6980426 C20.4132766,49.2086809 22.7145532,49.7479149 24.141617,50.9108085 C26.0793191,52.4876596 28.2907234,53.7731064 30.4177021,55.0708085 C30.8779574,55.3499574 31.1217021,55.7516596 31.488,55.2859574 C31.8406809,54.8338723 32.2805106,54.4539574 32.7857021,54.1775319 C33.778383,53.642383 34.9494468,53.5634043 36.0483404,53.7526809 C38.4258723,54.168 40.7244255,55.7530213 41.9458723,57.8350638 C44.0374468,56.2840851 46.7540426,55.5446809 49.3194894,56.1942128 C50.3625532,56.4570213 51.341617,56.997617 52.0605957,57.8037447 C52.4091915,58.1945532 52.6897021,58.6411915 52.8885106,59.123234 C53.1431489,59.7373617 54.2651915,59.2062979 54.9460426,59.1790638 C57.3235745,59.0755745 60.3642553,59.7182979 61.2030638,62.2537872 C61.5652766,63.3526809 61.4495319,64.7484255 61.9710638,65.7724255 C62.2161702,66.2558298 63.0154894,66.1523404 63.4525957,66.1686809 C64.2709787,66.2 64.9885957,66.3361702 65.7089362,66.7351489 C68.3601702,68.211234 68.7387234,71.3867234 68.4051064,74.1400851 C68.2757447,75.2062979 68.1926809,75.2444255 69.2425532,75.658383 C69.8294468,75.8925957 70.4394894,76.0764255 71.0577021,76.2057872 C71.8542979,76.376 72.6849362,76.476766 73.499234,76.426383 C76.1477447,76.261617 78.4190638,74.8195745 78.5756596,71.9763404 C80.7394043,73.0398298 83.8849362,73.8459574 85.8771064,71.9790638 C87.4934468,70.460766 87.4907234,67.9742979 86.747234,66.0243404 C89.5959149,66.9148936 92.5603404,66.108766 93.9356596,63.3404255 C95.0386383,61.116766 94.052766,57.8187234 93.2302979,55.6304681 C95.8420426,57.3162553 99.2340426,59.1123404 101.804936,56.3399149 C103.462128,54.5533617 103.718128,52.184 102.827574,49.9412766 Z"></path>
                        <path d="M39.4035745,58.5717447 C38.2869787,57.2318298 37.0151489,56.4420426 35.2789787,56.2309787 C34.075234,56.088 33.0798298,56.2650213 32.8891915,57.7288511 C32.6495319,59.5671489 33.8001702,62.2374468 35.3102979,63.3458723 C36.4037447,64.1465532 39.3668085,65.7043404 40.2873191,63.8115745 C41.0471489,62.2551489 40.0857872,59.9361702 39.4035745,58.5717447 C38.8234894,57.8745532 39.6908936,59.1518298 39.4035745,58.5717447 Z"></path>
                        <path d="M50.8500426,61.3959149 C50.9194894,59.8721702 48.5610213,58.6997447 47.3477447,58.4805106 C45.3637447,58.1237447 43.3102979,59.4963404 42.2631489,61.0704681 C40.5964255,63.5841702 40.2505532,67.2988936 42.2018723,69.7676596 C43.8658723,71.8714894 47.3218723,70.794383 48.8360851,69.0622979 C49.9009362,67.8462979 50.5041702,66.2885106 50.8323404,64.7239149 C50.9535319,64.1411064 51.0393191,63.5542128 51.0842553,62.9605106 C51.1305532,62.3559149 50.8200851,61.9474043 50.8500426,61.3959149 C50.8500426,61.3537021 50.8323404,61.7131915 50.8500426,61.3959149 Z" ></path>
                        <path d="M59.954383,67.1191489 C59.3729362,66.0311489 59.7678298,64.5128511 59.0420426,63.5337872 C58.4755745,62.7725957 57.6299574,62.3205106 56.7285106,62.0890213 C55.707234,61.8262128 54.4163404,61.3659574 53.5339574,62.1053617 C51.3130213,63.9640851 50.0289362,67.7782128 50.3203404,70.5737872 C50.5572766,72.8532766 52.2621277,75.315234 54.9065532,74.4437447 C56.5283404,73.9045106 57.7157447,72.4651915 58.5504681,71.036766 C59.0434043,70.1884255 60.3765106,67.9388936 59.954383,67.1191489 C59.533617,66.3293617 59.9652766,67.1382128 59.954383,67.1191489 Z" ></path>
                        <path d="M63.2946383,68.5884255 C62.5756596,68.5053617 61.7817872,68.2507234 61.1390638,68.6415319 C60.5235745,69.0132766 60.082383,69.6342128 59.7555745,70.2605957 C59.1305532,71.4738723 58.6961702,72.9009362 58.6771064,74.2680851 C58.6525957,75.9974468 59.5526809,77.7731064 61.3855319,77.9678298 C66.2617872,78.4920851 67.4791489,70.2905532 63.2946383,68.5884255 C63.0304681,68.5584681 64.2478298,68.9765106 63.2946383,68.5884255 Z"></path>
                        <path d="M117.154043,38.323234 C117.154043,38.323234 112.82383,37.962383 110.118128,28.7586383 C110.118128,28.7586383 104.704,11.9702128 104.521532,9.08340426 C104.521532,9.08340426 103.080851,5.47080851 105.605447,4.93021277 L115.352511,0.0566808511 L127.806638,34.9843404 C127.806638,34.9843404 125.641532,36.1581277 117.154043,38.323234 Z" ></path>
                        <path d="M18.9657872,10.7079149 L27.6289362,13.9555745 C27.6289362,13.9555745 29.6156596,14.3177872 27.4478298,19.3710638 L15.5370213,48.6122553 C15.5370213,48.6122553 14.0922553,50.9611915 7.59421277,48.7933617 L0.192,45.7268085 L15.8965106,9.6253617 L18.9657872,10.7079149 Z"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg>
            <span class="text--bold">100% de travail en équipe</span>et dans la bonne humeur</p>
    </div>
    <h1 class="title title--left">Stages</h1>
    
    <p class="texte texte--left">
        Le programme TIM du Cégep de Sainte-Foy offre des <span class="texte--bold">stages en Alternances travail études (ATE)</span> l’été et un long <span class="texte--bold">stage crédité</span> en session VI qui peut être réalisé en France.
        <br>
        Contacte <a class="texte__link" href="index.php/nous-joindre?contact=stages">Audrey Morneau</a> pour en savoir plus.
    </p>

    
</div>

<div class="section--white section--trapezoid-right" id="inscriptions">
    <h1 class="title title--left"><span class="title--highlight">S'inscrire</span> au programme</h1>
    <p class="texte texte--left">
        <span class="texte--bold">Aucun prérequis</span> n’est demandé pour s’inscrire au programme.
        <br class="br">
        Les demandes d'admission au programme TIM sont reçues avant le 1er mars de chaque année (1er tour ) 1er mai (2e tour), 1er juin (3e tour) et 1er août (4e tour).
        <br class="br">
        Pour compléter ta demande d'admission à notre programme, tu dois <span class="texte--bold">faire une demande d'admission</span> au Service régional d'admission au collégial de Québec (SRAQ) : <a class="texte__link" href="http://www.sraq.qc.ca">sraq.qc.ca</a>
    </p>
    
    <a class="button--purple" href='http://www.sraq.qc.ca' target="_blank">Faire une demande d'admission<i class="flaticon-external"></i></a>
    

    
</div>

<?php
        $app_id = '883879701812093'; // Remplacez par votre app_id
        $secret = '0df5ee4dc39e611ffbfd681d63dad833'; // Remplacez par votre secret

        $pageName = 'timcsf'; // Nom de la page Facebook que vous souhaitez récupérer. Ce nom est celui dans l'URL de la page et non le nom réel. Ex: https://www.facebook.com/LemonCake/

        $token = $app_id . '|' . $secret; // On prépare le token en séparant $app_id et $secret par un |

        // Via cette URL on va récupérer l'identifiant unique de la page pour récupérer les données
        $page = file_get_contents('https://graph.facebook.com/' . $pageName . '?fields=fan_count,talking_about_count,name&access_token='.$token);
        $page = json_decode($page);

        // Récupération de l'identifiant unique de la page
        $pageID = $page->id;

        // Récupération du flux de la page
        // Dans cette URL on peut voir que je demande de récupérer :
        // - L'image du poste
        // - Le message
        // - La date de création
        // - Les partages
        // - Les likes et commentaires dont vous pouvez modifier la limite qui là est de 1
        $response = file_get_contents("https://graph.facebook.com/v2.6/$pageID/feed?fields=full_picture,message,story,created_time,shares,likes.limit(1).summary(true),comments.limit(1).summary(true)&access_token=".$token);
        $response = json_decode($response);
        $data = $response->data;
        $data = $data[0];
        $i = 0;
?>


<div class="section--purple last--trapezoid-left">
    <h1 class="title">Nos <span class="title--highlight">actualités</span></h1>
    <div class="galerie">
        <div class="galerie__actus">
            <a href='https://www.facebook.com/timcsf'>
            <div class='galerie__actus__link'><i class="flaticon-facebook-logo"></i>/TIMCSF</div>
                
                <div class="galerie--box-shadow">
            <div class="galerie__actus__image"><img src="<?php echo isset($data->full_picture) ? $data->full_picture : 'http://placehold.it/' ?>" alt="Post facebook"></div>
                
            <div class="galerie__actus__card">
            <h2 class="galerie__actus__date"><?php echo date('d/m/Y', strtotime($data->created_time)) ?></h2>
            <h3 class="galerie__actus__text"><?php echo isset($data->message) ? $data->message : '' ?></h3>
                </div>
                </div>
            </a>
        </div>

<?php

                                                
function buildBaseString($baseURI, $method, $params) {
    $r = array();
    ksort($params);
    foreach($params as $key=>$value){
        $r[] = "$key=" . rawurlencode($value);
    }
    return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth) {
    $r = 'Authorization: OAuth ';
    $values = array();
    foreach($oauth as $key=>$value)
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
    $r .= implode(', ', $values);
    return $r;
}

function returnTweet(){
    $oauth_access_token         = "774594223060426752-FneEqZ9sO56AECUgHWmsMhorbtvbAj9";
    $oauth_access_token_secret  = "fJfGzlfw1irbwRfmLHEuFaW9YmQ5KWwkysfCRmgg9aoos";
    $consumer_key               = "NEHXxVpckWlytQSRxHtXpL8Hd";
    $consumer_secret            = "CY8yTEI1iBUz3OSSy5216pt1qWROauigmE1xMfGQvYRtgCxI10";

    $twitter_timeline           = "user_timeline";  //  mentions_timeline / user_timeline / home_timeline / retweets_of_me

    //  create request
        $request = array(
            'screen_name'       => 'timcsf',
            'count'             => '1',
            'tweet_mode'        => 'extended',
            'include_entities'  =>  'true'
        );

    $oauth = array(
        'oauth_consumer_key'        => $consumer_key,
        'oauth_nonce'               => time(),
        'oauth_signature_method'    => 'HMAC-SHA1',
        'oauth_token'               => $oauth_access_token,
        'oauth_timestamp'           => time(),
        'oauth_version'             => '1.0'
    );

    //  merge request and oauth to one array
        $oauth = array_merge($oauth, $request);

    //  do some magic
        $base_info              = buildBaseString("https://api.twitter.com/1.1/statuses/$twitter_timeline.json", 'GET', $oauth);
        $composite_key          = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
        $oauth_signature            = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature']   = $oauth_signature;

    //  make request
        $header = array(buildAuthorizationHeader($oauth), 'Expect:');
        $options = array( CURLOPT_HTTPHEADER => $header,
                          CURLOPT_HEADER => false,
                          CURLOPT_URL => "https://api.twitter.com/1.1/statuses/$twitter_timeline.json?". http_build_query($request),
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_SSL_VERIFYPEER => false);

        $feed = curl_init();
        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);
    return json_decode($json, true);
    
}
$datas_twitter = returnTweet();                                               
              
if(isset($datas_twitter[0][entities][media][0][media_url])){
    $img_url = $datas_twitter[0][entities][media][0][media_url];
}else{
    $img_url = $datas_twitter[0][user][profile_image_url];
}

// The Regular Expression filter
$reg_exUrl = "/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

$text_twitter = $datas_twitter[0][full_text];

/* Check if there is a url in the text
if(preg_match($reg_exUrl, $text_twitter, $url)) {

       // make the urls hyper links
       $text_twitter = preg_replace($reg_exUrl, "<a class='texte__link' href='".$url[0]."' alt='".$url[0]."'>".$url[0]."</a> ", $text_twitter);

}*/
$text_twitter = explode(" ", $text_twitter);
for($i=0;$i<count($text_twitter);$i++){
    if(strncmp($text_twitter[$i], "https://", strlen("https://")) == 0){
        $text_twitter[$i] = " <a class='texte__link' href='".$text_twitter[$i]."'>".$text_twitter[$i]."</a> ";
    };
};
$text_twitter = implode(" ", $text_twitter);                                                    
?>
        <div class="galerie__actus">
            <a href='https://twitter.com/timcsf'>
            <div class='galerie__actus__link'><i class="flaticon-twitter-logo-on-black-background"></i>/TIMCSF</div>
                <div class="galerie--box-shadow">
            <div class="galerie__actus__image"><img src="<?php echo $img_url ?>" alt="Post Twitter"></div>
            <div class="galerie__actus__card">
                <h2 class="galerie__actus__date"><?php echo date('d/m/Y', strtotime($datas_twitter[0][created_at])) ?></h2>
                <h3 class="galerie__actus__text"><?php echo $datas_twitter[0][full_text] ?></h3>
            </div>
                </div>
            </a>
        </div>
    </div>
    
</div>