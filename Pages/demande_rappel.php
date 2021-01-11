<!-- Traitement du formulaire "Rappel gratuit" et inclut dans la page index.php (linge 163) -->
<?php
    $nom_rappel = htmlspecialchars(trim($_POST['nom_rappel']));
    $tel_rappel = htmlspecialchars(trim($_POST['tel_rappel']));
    
    if(is_numeric($tel_rappel)){

        $destinataire = $contact['E-mail'];
        $sujet        = "Demande de rappel sur www.eurl-guillermain.fr";

        $boundary = md5(uniqid(rand(), true));
        
        $headers = "MIME-Version: 1.0". "\r\n";
        $headers .= 'Content-Type: multipart/mixed; boundary='.$boundary.''."\r\n";
        $headers .= "\r\n";

        $message = '--'.$boundary                             ."\r\n";
        $message .= 'Content-type: text/plain;charset=UTF-8'  ."\r\n";
        $message .= 'Content-Transfer-Encoding: 8bit'         ."\r\n";
        $message .= "\r\n"; 

        $message .= 'Demande de rappel du '.date("d/m/y").' (à '.date("H:i").') de la part de '. $nom_rappel ."\r\n"; 
        $message .= 'Joignable au numéro de téléphone : '.$tel_rappel."\r\n";
        $message .= 'www.eurl-guillermain.fr'  ."\r\n";
        $message .= "\r\n"; 
        $message .= '--'.$boundary."\r\n";

        $regex_head = '/[\n\r]/';   

        if (preg_match($regex_head, $tel_rappel) || preg_match($regex_head, $nom_rappel)){  
            echo 'En-têtes interdites dans les champs du formulaire'; 
        }else{   
            if(mail($destinataire, $sujet, $message, $headers)){
                echo '<div class="alert alert-success px-3 w-75 mx-auto my-4 alert-dismissible fade show d-none d-sm-block" role="alert">
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
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Mobile -->
                    <div class="alert alert-success px-3 w-75 mx-auto my-4 alert-dismissible fade show d-sm-none" role="alert">
                        <h4 class="alert-heading">Message envoyé.</h4>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }else{
                echo '<div class="alert alert-danger text-center px-0 w-50 mx-auto my-4" role="alert">
                        <p>
                            Nous avons rencontrés quelques difficultés au moment de l\'envoi du mail de rappel, veuillez réessayer.
                            Merci.
                        </p>
                        </div>';
            }
        }
    }else{
        echo '<div class="alert alert-danger text-center px-0 w-50 mx-auto my-4 alert-dismissible fade show" role="alert">
                <p class="my-1">
                    Le numéro de téléphone n\'est pas valide. 
                    Veuillez réessayer.
                </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    }