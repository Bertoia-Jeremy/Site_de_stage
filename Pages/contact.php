<!-- Cette page, affiche et traite le formulaire de contact + insère le consetement de la personne contactant l'entrenpise dans la BDD -->

<?php
    if(isset($_POST['contact_nom']) AND isset($_POST['contact_email']) AND isset($_POST['contact_message'])){
        $nom            = htmlspecialchars(trim($_POST['contact_nom']));
        $email          = htmlspecialchars(trim($_POST['contact_email']));
        $message_client = htmlspecialchars($_POST['contact_message']);
        $timestamp      = time();
        $consentement   = "Exploitation des données dans le cadre de la demande de contact et de la relation commerciale qui peut en découler.";
        
        $destinataire   = $contact['E-mail'];
        $sujet = "Prise de contact sur www.eurl-guillermain.fr";

        $boundary = md5(uniqid(rand(), true));
        
        $headers =  "From: ".$email.      "\r\n";
        $headers .= "MIME-Version: 1.0". "\r\n";
        $headers .= 'Content-Type: multipart/mixed; boundary='.$boundary.''."\r\n";
        $headers .= "\r\n";

        $message = '--'.$boundary                             ."\r\n";
        $message .= 'Content-type: text/plain;charset=UTF-8'  ."\r\n";
        $message .= 'Content-Transfer-Encoding: 8bit'         ."\r\n";
        $message .= "\r\n"; 
        $message .= 'Message du '.date("d/m/y").' de la part de '. $nom ."\r\n"; 

        /* --- Si la case "Demande de devis à été cochée on ajoute les différents savoirs concernés --- */
        if(isset($_POST['domaine'])){
            $domaine = "";

            foreach ($_POST['domaine'] as $value) {
                $domaine .= " - ".htmlspecialchars(trim($value))." - ";
            }
 
            $message .= 'Demande de devis : '.$domaine."\r\n";
        }
        
        $message .= 'Message du client :'                ."\r\n";
        $message .= $message_client                      ."\r\n";
        $message .= '---------------------------------'  ."\r\n";
        $message .= 'Joignable par :'                    ."\r\n";

        if(isset($_POST['contact_telephone'])){

            if(is_numeric($_POST['contact_telephone'])){
                
                $telephone = $_POST['contact_telephone'];
                $message  .= 'Téléphone : '.$telephone."\r\n";

            }else{
                $telephone = NULL;
            }
        }else{
            $telephone = NULL;
        }


        $message .= 'E-mail :'.$email          ."\r\n";
        $message .= "                            \r\n";
        $message .= 'www.eurl-guillermain.fr'  ."\r\n";
        $message .= "\r\n"; 
        $message .= '--'.$boundary."\r\n";
 
        /* --- Respect du RGPD => conservation du consentement de la personne contactant l'entreprise --- */
        if(mail($destinataire, $sujet, $message, $headers)){
            $query = "  INSERT INTO Guillermain_contact(Identifiant, 
                                                        Nom, 
                                                        Email, 
                                                        Telephone, 
                                                        Jour, 
                                                        Heure, 
                                                        Consentement) 
                        VALUES (:identifiant, 
                                :nom, 
                                :email, 
                                :telephone, 
                                :jour, 
                                :heure, 
                                :consentement)";
            
            $req = $bdd->prepare($query);
            $req->bindValue("identifiant", $timestamp,                PDO::PARAM_INT);
            $req->bindValue("nom",         $nom,                      PDO::PARAM_STR);
            $req->bindValue("email",       $email,                    PDO::PARAM_STR);
            $req->bindValue("telephone",   $telephone,                PDO::PARAM_INT);
            $req->bindValue("jour",        date("d/m/Y", $timestamp), PDO::PARAM_STR);
            $req->bindValue("heure",       date("H:i:s", $timestamp), PDO::PARAM_STR);
            $req->bindValue("consentement",$consentement,             PDO::PARAM_STR);
            $req->execute() or die(print_r($bdd->errorInfo()));

            echo '<div class="alert alert-success px-3 w-75 mx-auto my-4" role="alert">
                    <h4 class="alert-heading">Message envoyé.</h4>
                    <p>
                        Merci de l\'intérêt que vous nous portez.
                        Nous vous recontacterons dès que possible. 
                    </p> 
                    <hr>
                    <p class="text-center">
                        Si vous le souhaitez, vous pouvez découvrir les réalisations faites par notre entreprise :
                    </p>
                    <div class="text-center">
                        <a class="button btn-primary rounded p-2 text-center" role="button" href="index.php?page=3">Découvrir les réalisations</a>
                    </div>
                    </div>';
        }else{
            echo '<div class="alert alert-danger text-center px-0 w-50 mx-auto my-4" role="alert">
                    <p>
                        Nous avons rencontrés quelques difficultés au moment de l\'envoi du mail de confirmation,</br>
                        veuiller recommencer l\'inscription en cliquant 
                        <a href="https://www.eurl-guillermain.fr/index.php?page=5"> ICI </a>, merci.
                    </p>
                    </div>';
        }
    }else{
?>
<!-- --- Affichage de la page Contact --- -->
<section class="container-fluid px-0">
    <div class="w-100 mx-0 px-0 d-flex align-items-center justify-content-center bg_img contact">
        <h1 class="text-white text-center">CONTACT</h1>
    </div>

    <div class="container">
        <h2 class="mt-5 pb-2 text-center">
            <span class="border_bottom">Contactez-nous</span>
            <div class="mt-2 w-25 mx-auto border border-primary"></div>
        </h2>

        <p class="text-center">
            Vous êtes intéressé par nos services ou avez besoin d’informations supplémentaires ? </br>
            Remplissez ce formulaire et nous vous répondrons au plus vite.
        </p>
   
        <form method='POST' action="#" class="row container mx-auto text-primary font-weight-bold">
            <div class="col-12 mt-4">
                <label for="contact_nom" class="mb-0">NOM / PRÉNOM *</label>
                <input type="text" name="contact_nom" id="contact_nom" required class="form-control" 
                value="<?php if(isset($_POST['contact_nom'])){  echo $_POST['contact_nom']; }else{ echo ""; }?>">
            </div>
            
            <div class="col-md-6 col-sm-12 mt-4">
                <label for="contact_email" class="mb-0">EMAIL *</label>
                <input type="email" name="contact_email" id="contact_email" required class="form-control"
                value="<?php if(isset($_POST['contact_email'])){  echo $_POST['contact_email']; }else{ echo ""; }?>">
            </div>

            <div class="col-md-6 col-sm-12 mt-4">
                <label for="contact_telephone" class="mb-0">TÉLÉPHONE</label>
                <input type="text" name="contact_telephone" id="contact_telephone" class="form-control"
                value="<?php if(isset($_POST['contact_telephone'])){  echo $_POST['contact_telephone']; }else{ echo ""; }?>">
            </div>

            <div class="col-12 mt-4">
                <label for="devis">Demander un devis</label>
                <input class="ml-1" type="checkbox" id="devis" <?php if(isset($_GET['devis'])){ echo "checked";} ?>>
            </div>

            <!-- --- Div liée au javascript en fin da page --- -->
            <div class="col-11 mx-auto mt-2 bg-light rounded" <?php if(!isset($_GET['devis'])){ echo 'style="display:none;"';} ?> id="domaines_devis">
                <label>Votre demande de devis concerne :</label></br>
                <div class="d-flex flex-wrap justify-content-center">
                    <!-- Listes des savoirs faire -->
                    <?php
                        $query = "  SELECT Nom 
                                    FROM   Guillermain_sous_pages
                                    WHERE  Identifiant_page = 1598255300 ";

                        $req = $bdd->prepare($query);
                        $req->execute() or die(print_r($bdd->errorInfo()));

                        while($donnees = $req->fetch()){
                            echo '<div class="m-2">
                                    <input type="checkbox" id="'.$donnees['Nom'].'" value="'.$donnees['Nom'].'" name="domaine[]">
                                    <label for="'.$donnees['Nom'].'">'.$donnees['Nom'].'</label>
                                </div>';
                        }
                    ?>
                    <div class="m-2">
                        <input type="checkbox" id="autre" value="Autres" name="domaine[]">
                        <label for="autre">Autres</label>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4">
                <label for="contact_message" class="mb-0">COMMENT POUVONS-NOUS VOUS AIDER ?</label>
                <textarea id="contact_message" name="contact_message" required class="form-control w-100" style="min-height: 180px;"><?php if(isset($_POST['contact_message'])){  echo $_POST['contact_message']; }else{ echo ""; }?></textarea>
            </div>

            <div class="container text-center text-dark mt-3">
                <label for="condition">
                <input type="checkbox" id="condition" class="mr-2" required> En soumettant ce formulaire, j'accepte que les informations saisies soient exploitées dans le cadre de la prise de contact et de la relation commerciale qui peut en découler.</label>
            </div>
            <button type="submit" class="btn btn-secondary d-block mx-auto mt-3 mb-5">Envoyer mon message</button>
        </form>
    </div>
</section>
<?php
    }
?>

<!-- --- Affichage (ou non) des savoirs faire en fonction de si la case "Demander un devis" est cochée ou non --- -->
<script>
    var radioDevis   = document.getElementById('devis'),
        sectionDevis = document.getElementById('domaines_devis');

    radioDevis.addEventListener("click", function(){
        if(radioDevis.checked){
            sectionDevis.style.display = "block";
        }else{
            sectionDevis.style.display = "none";
        }
    });
</script>