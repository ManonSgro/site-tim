<?php
/*Template Name: Joindre*/
?>

<?php
    require 'recaptchalib.php';
    $secret = "MY-SECRET";
    /*Front Page gabarit */
    //Appel au gabarit de l'entête
    get_header();
?>

    
<!-- Ouverture du conteneur #contenu -->
<div id="contenu">
    

<div id="top"></div>
    
<div class="section--white" id="joindre">
    <h1 class="title">Nous <span class="title--highlight">joindre</span></h1>
    <div class="contact">
        <?php
        $reCaptcha = new ReCaptcha($secret);
        if(isset($_POST["g-recaptcha-response"])) {
            $resp = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $_POST["g-recaptcha-response"]
                );
            if ($resp != null && $resp->success) {
                $message = "";
                $class = "--success";
                // Initialize variables to null.
                $nom ="";
                $email ="";
                $destinataire =""; 
                $mail_desinataire = "";
                $sujet =""; 
                $message ="";

                $emailError ="";
                $purposeError ="";
                $messageError ="";
                $successMessage ="";

                if(isset($_POST['submit'])) { // Checking null values in message.
                    $name = $_POST["nom"];
                    $email = $_POST["courriel"];
                    $destinataire = $_POST["destinataire"];
                    $mail_desinataire = get_field('mail_coordonnateur');
                    if($destinataire==="coordination"){
                        $mail_desinataire = get_field('mail_coordonnateur');
                        
                    }else{
                        if($destinataire==="stages"){
                        $mail_desinataire = get_field('mail_responsable_des_stages');

                        }else{
                            if($destinataire==="etudiant_dun_jour"){
                                $mail_desinataire = get_field("mail_responsable_etudiant_dun_jour");

                            }
                            
                        }
                    }
                    $sujet = $_POST["sujet"];
                    $message = $_POST["message"];
                if( !($name=='') && !($email=='') && !($destinataire=='') && !($sujet=='') &&!($message=='') )
                { // Checking valid email.
                    if (preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
                    {
                    $header= $name."<". $email .">";
                    $headers = "timcsf.qc.ca";
                    $msg = "Bonjour $name, nous avons bien reçu votre message.
                    Nom complet : $name
                    Adresse courriel: $email
                    Vers : $mail_desinataire
                    Sujet: $sujet
                    Message: $message
                    Ceci est un message de confirmation. Nous vous contacterons dès que possible.";
                    $msg1 = "Message de $name.
                    Nom complet : $name
                    Adresse courriel : $email
                    Sujet: $sujet
                    Message: $message ";
                    if(mail($email, $headers, $msg ) && mail($mail_desinataire, $header, $msg1 ))
                    {
                    $successMessage = "Votre message a bien été envoyé. Vous recevrez un email de confirmation dans quelques instants.";
                        $message = $successMessage;
                    }else{
                        $messageError = "Votre message n'a pas été envoyé correctement. Veuillez renvoyer votre message.";
                        $message = $messageError;
                        $class = "--error";
                    }
                    }
                    else
                    { $emailError = "Veuillez saisir une addresse courriel valide.";
                     $message = $emailError;
                    $class = "--error";
                     }
                 }
                }
            }else{
                $message = "CAPTCHA incorrect";
                $class = "--error";
            }
            }
        ?>

            
    <form class="contact__form" action="<?php echo esc_url( home_url( '/' ) ); ?>nous-joindre" method="post">
        <div class="form__message<?php if(isset($class)){echo $class;} ?>">
            <?php if(isset($message)){echo $message;} ?>
        </div>
        <label for="nom" class="contact__label">Nom complet</label><input id="nom" type="text" name="nom" class="contact__input" placeholder="Entrez votre nom complet" required>
        <label for="courriel" class="contact__label">Adresse courriel</label><input id="courriel" type="email" name="courriel" class="contact__input" placeholder="Entrez votre adresse courriel" required>
        <label for="destinataire" class="contact__label">Destinataire</label>
        <select id="destinataire" name="destinataire" class="contact__input" required>
            <option disabled selected value> -- Choisir un destinataire -- </option>
            <option value="coordination" <?php if($_GET["contact"]=="coordination"){ echo "selected=true"; } ?> ><?php the_field('coordonnateur') ?> (Coordonnateur départemental)</option>
            <option value="stages" <?php if($_GET["contact"]=="stages"){ echo "selected=true"; } ?> ><?php the_field('responsable_des_stages') ?> (Responsable des stages)</option>
            <option value="etudiant_dun_jour" <?php if($_GET["contact"]=="etudiant_dun_jour"){ echo "selected=true"; } ?> ><?php the_field('responsable_etudiant_dun_jour') ?> (Responsable "Étudiant d'un jour")</option>
        </select>
        
        <label for="sujet" class="contact__label">Sujet</label><input id="sujet" type="text" name="sujet" class="contact__input" placeholder="Entrez le sujet du message" required>
        <label for="message" class="contact__label">Message</label><textarea id="message" rows="3" name="message" class="contact__input" placeholder="Entrez votre message" required></textarea>
        <div class="contact__message--required">Champs requis.</div>
        <div class="g-recaptcha" data-sitekey="6LdxkEkUAAAAAGm7R8i_zbfuWPBV0qN3cwvhEhg0"></div>
        <button type="submit" name="submit" value="envoyer" class="contact__button button--purple">Envoyer</button>
    </form>
    
    <div class="contact__infos" id="1">
        <h1 class="contact__infos__title">Informations</h1>
        <p id="texte" class="contact__infos__text">Pour obtenir de plus amples informations sur la formation, contactez la coordination.</p>
        <h2 class="contact__infos__subtitle">Votre contact</h2>
        <p id="name" class="contact__infos__text"><?php the_field('coordonnateur') ?></p>
        <img  class="contact__infos__image" src="<?php the_field('img_coordonnateur') ?>" alt="<?php the_field('coordonnateur') ?>">
        <br>
        <p id="tel" class="contact__infos__text">Tel. : <?php the_field('tel_coordonnateur') ?></p>
        <p id="poste" class="contact__infos__text">Poste <?php the_field('poste_coordonnateur') ?></p>
    </div>
        
    <div class="contact__infos" id="2">
        <h1 class="contact__infos__title">Informations</h1>
        <p id="texte" class="contact__infos__text">Pour obtenir de plus amples informations sur les stages en TIM, contactez le responsable des stages.</p>
        <h2 class="contact__infos__subtitle">Votre contact</h2>
        <p id="name" class="contact__infos__text"><?php the_field('responsable_des_stages') ?></p>
        <img  class="contact__infos__image" src="<?php the_field('img_responsable_des_stages') ?>" alt="<?php the_field('responsable_des_stages') ?>">
        <br>
        <p id="tel" class="contact__infos__text">Tel. : <?php the_field('tel_responsable_des_stages') ?></p>
        <p id="poste" class="contact__infos__text">Poste <?php the_field('poste_responsable_des_stages') ?></p>
    </div>
        
    <div class="contact__infos" id="3">
        <h1 class="contact__infos__title">Informations</h1>
        <p id="texte" class="contact__infos__text">Pour obtenir de plus amples informations sur le programme "Etudiant d'un jour", contactez le responsable du programme.</p>
        <h2 class="contact__infos__subtitle">Votre contact</h2>
        <p id="name" class="contact__infos__text"><?php the_field('responsable_etudiant_dun_jour') ?></p>
        <img  class="contact__infos__image" src="<?php the_field('img_responsable_etudiant_dun_jour') ?>" alt="<?php the_field('responsable_etudiant_dun_jour') ?>">
        <br>
        <p id="tel" class="contact__infos__text">Tel. : <?php the_field('tel_responsable_etudiant_dun_jour') ?></p>
        <p id="poste" class="contact__infos__text">Poste <?php the_field('poste_responsable_etudiant_dun_jour') ?></p>
    </div>
    </div>
</div>

<?php
    get_footer();
?>