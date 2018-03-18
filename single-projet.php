<?php
/*Template Name: Projets*/
?>

<?php get_header();?>

    
<?php

    if(have_posts()) : the_post();?>

<?php

//Connexion. Pourrait être dans le fichier de configuration et appelé en include...

$strDsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
$pdoConnexion = new PDO($strDsn, DB_USER,DB_PASSWORD);
$pdoConnexion -> exec("SET CHARACTER SET utf8");


//Récupération de l'identifiant du diplomé(ACF)
$id_projet = get_field('id_projet');
if($id_projet!=null){
    
//Établissement et exécution de la requête réparée à la base de données
$strRequete = "SELECT tim__projet_diplome.id_diplome,technologies,cat_projet,description,participation,cadre,url_projet,nom_diplome,prenom_diplome FROM tim__projet_diplome INNER JOIN tim_diplome ON tim__projet_diplome.id_diplome=tim_diplome.id_diplome WHERE id_projet=:id_projet";
$pdosResultat = $pdoConnexion->prepare($strRequete);
$pdosResultat->bindparam(":id_projet", $id_projet);
$pdosResultat->execute();

//Récupération du code d'erreur, s'il y a lieu
$intCodeErreur = $pdosResultat->errorCode();

//Récupère l'enregistrement du dilpomé
$arrProjet = $pdosResultat->fetch();

//Affiche les infos du projet

?>
<header id="top" class="header section--trapezoid-right">
    <div class="header__titles">
        <h1 class="header__title--bold">
            <?php the_title(); ?>
        </h1>
        <h2 class="title">
            <?php echo $arrProjet["prenom_diplome"]." ".$arrProjet["nom_diplome"];?>
        </h2>
        <?php if($arrProjet["url_projet"]!=null && $arrProjet["url_projet"]!=""){
            echo "<a class='projet-button--white' href='".$arrProjet["url_projet"]."' target='_blank'>Voir le projet<i class='flaticon-external'></i></a>";
        }
        ?>
    
    </div>
        
    <div class="header__image">
        <a class="progressive replace" href="<?php echo get_bloginfo('template_directory') ?>/00_PhotosFinissants_CHOIX/<?php  echo strtolower(substr($arrProjet["prenom_diplome"], 0, 1).$arrProjet["nom_diplome"]) ?>.jpg">
        <img src="<?php echo get_bloginfo('template_directory') ?>/00_PhotosFinissants_CHOIX/<?php  echo strtolower(substr($arrProjet["prenom_diplome"], 0, 1).$arrProjet["nom_diplome"]) ?>_tiny.jpg" alt="<?php echo strtolower($arrProjet["prenom_diplome"]." ".$arrProjet["nom_diplome"]); ?>">
        </a>
    </div>
            
</header>

<?php } ?>

<div id="contenu">

<?php if($id_projet!=null){ ?>
    
<div class="section--purple  section--trapezoid-left">
    <h2 class="title">Informations</h2>
    <div class="informations">
        <div class="informations__image">
            <img src="<?php echo get_bloginfo('template_directory').'/../../uploads/00_Images_projets/prj'.$id_projet.'_01.jpg' ?>" alt="Projet <?php echo the_title() ?>">
        </div>
        <div class="informations__infos">
            
            <h3 class="informations__infos__subtitle">Technologies utilisées :</h3>
            <div class="informations__texte"><?php echo $arrProjet["technologies"];?></div>

            <h3 class="contact__infos__subtitle">Contexte :</h3>
            <div class="informations__texte"><?php echo $arrProjet["cadre"];?></div>

            <h3 class="contact__infos__subtitle">Type de production :</h3>
            <p class="informations__texte"><?php echo $arrProjet["cat_projet"];?></p>
        </div>
    </div>
    
    
</div>

<div class="section--white section--trapezoid-right">
    <h2 class="informations__title title--bold">Description</h2>
    <div class="informations">
        <div class="informations__infos">
            
            <h3 class="informations__infos__subtitle sr-only">Description du mandat :</h3>
            <?php echo $arrProjet["description"];?>

            <h3 class="contact__infos__subtitle">Participation au projet :</h3>
            <?php echo $arrProjet["participation"];?>
        </div>
        <div class="informations__image">
            <img src="<?php echo get_bloginfo('template_directory').'/../../uploads/00_Images_projets/prj'.$id_projet.'_02.jpg' ?>" alt="Projet <?php echo the_title() ?>">
        </div>
    </div>
    
</div>

<?php } ?>
    

    

    <div class="section--purple last--trapezoid-left">
    <h1 class="title">Nos <span class="title--highlight">projets</span></h1>
    
    
    <div id="galerie--extend" class="galerie__projets">
            
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
    for($i=0;$i<count($_SESSION["slugs"]);$i++){
        echo '<a class="galerie__project__link" href="'.get_home_url().'/projets/'.$_SESSION["slugs"][$i].'/"><div class="galerie__project"><div class="galerie__project__image"><img src="'. get_bloginfo('template_directory').'/../../uploads/00_Images_projets/prj'.$_SESSION["ids_projets"][$i].'_01.jpg" alt="Projet '.$_SESSION["titres_projets"][$i].'"></div><h2 class="galerie__project__title">'.$_SESSION["titres_projets"][$i].'</h2><h3 class="galerie__project__subtitle">'.$_SESSION["cats_projets"][$i].'</h3></div></a>';
        };
    ?>
            
        
    </div>
    
    <button id="extend_gallery__button" type="button" class="button--white">Voir plus</button>
    </div>

<?php else:
    //non developpé dans cet exemple
    get_template_part('components/post/content', 'none');
    endif;
?>


<?php get_footer(); ?>