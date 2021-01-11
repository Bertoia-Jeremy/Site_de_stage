<!-- Page contenant l'affichage de toutes les réalisations. Possibilité de les triées par savoir faire. -->

<section class="container-fluid px-0">
    <div class="w-100 mx-0 px-0 d-flex align-items-center justify-content-center bg_img realisations">
        <h1 class="text-white text-center">NOS RÉALISATIONS</h1>     
    </div>

    <div class="container py-2 my-2">
        <ul class="d-flex flex-wrap justify-content-around list-unstyled text-primary font-weight-bold  mb-4">
        <?php
            $tout = true;

            $query = "SELECT Nom FROM Guillermain_sous_pages WHERE Identifiant_page = 1598255300";
            $req = $bdd->prepare($query);
            $req->execute() or die(print_r($bdd->errorInfo()));
            $sous_pages = [];
            
            while($donnees = $req->fetch()){
                
                $uppercase = $nom = str_replace(' ', '_', strtoupper($donnees['Nom']));//Remplacement des espaces par _ et tout en majuscules
                array_push($sous_pages, $uppercase); 

                if(isset($_GET[$uppercase])){
                    $tout = false;
                    echo '<li class="rounded bg-primary px-2 m-2">
                            <a href="index.php?page=3&'.$uppercase.'" class="text-decoration-none text-white">
                                '.$donnees['Nom'].'
                            </a>
                          </li>';
                }else{
                    echo '<li class="m-2">
                            <a href="index.php?page=3&'.$uppercase.'" class="text-decoration-none text-primary">
                                '.$donnees['Nom'].'
                            </a>
                          </li>';
                }
            }

            if($tout){
                echo '<li class="rounded bg-primary px-2 m-2"> 
                        <a href="index.php?page=3" class="text-decoration-none text-white">
                           Tout
                        </a> 
                      </li>';
            }else{
                echo '<li class="m-2"> 
                        <a href="index.php?page=3" class="text-decoration-none text-primary">
                           Tout
                        </a> 
                      </li>';
            }
        ?>
        </ul>
        <div class="w-50 border border-primary mb-2 mx-auto"></div>
    </div>

    <section>
        <div class="row mx-0 justify-content-center">
<?php
            $query = "  SELECT Nom, Valeur, Identifiant 
                        FROM   Guillermain_produits
                        WHERE  Identifiant_page = 1598255400 ";
                        
            foreach ($sous_pages as $value) {
                if(isset($_GET[$value])){
                    $savoir_faire = str_replace('_', ' ', ucfirst(strtolower($value)));//Remplacement inverse des _ et une majuscule au début
                    $query .= ' AND Valeur = "'.$savoir_faire.'" ';
                }
            }
            $query .= " ORDER BY ID DESC";
            $req = $bdd->prepare($query);
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

            $nb_realisation = (count($identifiant_realisation));

            if($nb_realisation > 0){
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
            }else{
                echo '<div class="alert alert-primary" role="alert">
                        <h4 class="alert-heading text-center">Pas de réalisation pour ce métier !</h4>
                        <p>
                            Nous n\'avons pas encore publié de réalisations pour le métier demandé.</br>
                            Revenez plus tard pour admirer nos réalisations !</p>
                      </div>';
            }

?>
        
    </section>

    <div class="container pt-3 my-3">
        <div class="w-50 border border-primary mx-auto"></div>
    </div>
</section>