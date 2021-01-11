<!-- Page inclut dans la page de présentation de chaque savoirs faire : carrelage.php, platrerie.php, revetement.php et peinture.php
    - Récupération d'une $valeur_savoir_faire avec le savoir faire concerné.
    - Création de 2 fonctions  de récupérer :
        - Les types de prestations du savoir $valeur_savoir_faire grâce à Prestations()
        - Les 3 dernières réalisations de $valeur_savoir_faire grâce à QuelquesRealisations() + affichage -->
<?php
    $query = "  SELECT  Identifiant, Nom, Image_principale, Image_droite, Image_gauche 
                FROM    Guillermain_sous_pages 
                WHERE   Nom = :nom";

    $req = $bdd->prepare($query);
    $req->bindValue("nom", $valeur_savoir_faire, PDO::PARAM_STR);
    $req->execute() or die(print_r($bdd->errorInfo()));
    $donnees = $req->fetch();

    $image_principale = $donnees['Image_principale'];
    $image_droite     = $donnees['Image_droite'];
    $image_gauche     = $donnees['Image_gauche'];
    $req = NULL;

    /* Récupération des différents types de prestation de la valeur $valeur_savoir_faire */
    function Prestations($valeur_savoir_faire, $bdd){
        
        $query = "  SELECT  Valeur 
                    FROM    Guillermain_produits 
                    WHERE   Nom_sous_page = :nom_sous_page
                    AND     Nom           = :nom";

        $req = $bdd->prepare($query);          
        $req->bindValue("nom_sous_page", $valeur_savoir_faire, PDO::PARAM_STR);
        $req->bindValue("nom",           "Prestation",         PDO::PARAM_STR);
        $req->execute() or die(print_r($bdd->errorInfo()));

        while($donnees = $req->fetch()){
            echo '<li>'.$donnees['Valeur'].'</li>';
        } 

        $req = NULL;
    }          


	function QuelquesRealisations($valeur_savoir_faire, $bdd){
        $query = "  SELECT Nom, Valeur, Identifiant 
                    FROM   Guillermain_produits
                    WHERE  Valeur = :valeur_savoir_faire 
                    ORDER BY ID DESC
                    LIMIT  0, 3";
        
        $req = $bdd->prepare($query);
        $req->bindValue("valeur_savoir_faire", $valeur_savoir_faire, PDO::PARAM_STR);
        $req->execute() or die(print_r($bdd->errorInfo()));

        $identifiant_realisation = [];
        $lieu_realisation        = [];
        $savoir_realisation      = [];

        while($donnees = $req->fetch()){
            array_push($identifiant_realisation, $donnees['Identifiant']);
            array_push($lieu_realisation,        $donnees['Nom']);
            array_push($savoir_realisation,      $donnees['Valeur']);
        }
        $req = NULL;

        $nb_realisation = count($identifiant_realisation);

        if($nb_realisation > 0){
            echo '<section class="my-4 px-0">
                    <div class="container border-top pt-5">
                        <p class="h4 mb-4 text-primary"><u>Voir quelques-unes de nos réalisations :</u></p>
                    </div>

                    <div class="row mx-0 w-100 justify-content-center">';

            /* Affichage des carrousels miniatures des réalisations du savoir faire concerné */
            for($i = 0; $i < $nb_realisation; $i++){
    
                echo '<div class="card p-0 m-2 col-lg-3 col-md-5 col-sm-11 shadow rounded">
                        <div id="slider'.$i.'" class="carousel slide hover_fleches" data-ride="carousel">
                            <!-- Carrousel -->
                            <div class="carousel-inner">';

                $query = "  SELECT Chemin 
                            FROM   Guillermain_carrousel
                            WHERE  Identifiant_produit = :identifiant_produit
                            ORDER BY Ordre ASC";
                
                $req = $bdd->prepare($query);
                $req->bindValue("identifiant_produit", $identifiant_realisation[$i], PDO::PARAM_INT);
                $req->execute() or die(print_r($bdd->errorInfo()));

                $active = true;
                while($donnees = $req->fetch()){
                    if($active){
                        echo '<div class="carousel-item active miniature text-center" data-interval="15000">';        
                        $active = false;

                    }else{
                        echo '<div class="carousel-item miniature text-center" data-interval="10000">';
                    }
                    
                    echo       '<img src="'.$donnees['Chemin'].'" class="img-fluid rounded" style="max-height: 260px; max-width: 400px; height: 100%;" 
                                                                            alt="'.$lieu_realisation[$i].' - '.$savoir_realisation[$i].'">
                            </div>';
                }
                echo '      </div>
                                <!-- Contrôles -->
                                <a class="carousel-control-prev" href="#slider'.$i.'" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Précédent</span>
                                </a>
                                <a class="carousel-control-next" href="#slider'.$i.'" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Suivant</span>
                                </a>
                        </div>
                            
                        <div class="w-100 h-25 legende_photo rounded-bottom bg-secondary">
                            <p class="m-0">
                                '.$savoir_realisation[$i].' </br>
                                '.$lieu_realisation[$i].'
                            </p>
                        </div>
                    </div>';
            }

            echo '  </div>
                    <div class="text-center mt-5">
                        <a href="index.php?page=3" class="btn btn-lg btn-primary">Voir toutes nos réalisations</a>
                    </div>
                </section>';

        }
    }
?>
