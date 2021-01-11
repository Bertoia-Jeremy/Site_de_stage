<!-- Présentation du savoir faire, l'administrateur a la possibilité de changer les types de prestations (dans partie basse) et les 
3 dernières réalisations de l'entreprise de ce savoir-faire seront affichés en bas de la page. 
    La page donnees_savoirs_faire.php fournis :
                                        - Les types de prestations du savoir $valeur_savoir_faire grâce à Prestations()
                                        - Les 3 dernières réalisations de $valeur_savoir_faire grâce à QuelquesRealisations() + affichage 
    Page similaire à carrelage.php, peinture.php et revetement.php -->
<?php
    $valeur_savoir_faire = "Plâtrerie";

    include ('donnees_savoirs_faire.php');
?>

<div class="w-100 mx-0 px-0 d-flex align-items-center justify-content-center bg_img" <?= 'style = "background-image: url('.$image_principale.');"'; ?>>
    <h1 class="text-white text-center">Plâtrerie</h1> 
</div>
 
<section class="container mb-5">
   <!-- --- Partie haute --- -->
    <section class="mt-3">
        <div class="row mx-0 my-4">
            <div>
                <h2 class="mb-1 pb-1 text-primary">Nos plâtriers</h2>
            </div>

            <!-- --- Image droite --- -->
            <div class="row mx-0">
                <div class="col-md-4 col-sm-12 order-1 order-sm-2 d-flex justify-content-center align-items-center px-0">
                    <a type="button" data-toggle="modal" data-target="#image_droite"> 
                        <img src="<?= $image_droite; ?>" alt="" class="img-fluid" style="max-height: 350px;">
                    </a>
                    <div class="modal fade" id="image_droite" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body pt-0 d-flex flex-column justify-content-center">
                                    <button type="button" class="close align-self-end" data-dismiss="modal" aria-label="Close">
                                        <span class="h2 mb-3" aria-hidden="true">x</span>
                                    </button>
                                    <div class="mx-auto text-center">
                                        <img src="<?= $image_droite; ?>" alt="Pièce en placo avec carrelage posé" class="img-fluid" style="max-height: 90vh;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- --- Paragraphe gauche --- -->
                <div class="col-md-8 col-sm-12 order-2 order-sm-1 d-flex align-items-stretch px-0">
                    <div class="my-2" >
                         <p class="border-left border-secondary px-2" style="border-left-width: thick!important;">
                            Vous venez de construire ? Vous avez besoin de rénover ? Ou tout simplement une envie de changement ?</br>

                            Nos plâtriers/plaquistes interviennent dans toutes les parties du bâtiment, sols, plafonds, murs et cloisons afin de rattraper les éventuelles 
                            inégalités, poser un faux-plafond ou pour isoler votre logement.</br>

                            Pour en savoir plus, n'hésitez pas à <u><a href="index.php?page=5">contacter l'EURL Guillermain</a></u> pour vous aidez dans vos choix.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- --- Partie basse --- -->
        <div class="row mx-0 my-4">
            <div>
                <h2 class="mb-1 pb-1 text-primary">Prestations proposées</h2>
            </div>

            <div class="row mx-0">
                <!-- --- Image gauche --- -->
                <div class="col-md-4 col-sm-12 d-flex justify-content-center align-items-center px-0 ">
                    <a type="button" data-toggle="modal" data-target="#image_gauche"> 
                        <img src="<?= $image_gauche; ?>" alt="Isolation sous toiture" class="img-fluid pr-2" style="max-height: 350px;">
                    </a>
                    <div class="modal fade" id="image_gauche" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body pt-0 d-flex flex-column justify-content-center">
                                    <button type="button" class="close align-self-end" data-dismiss="modal" aria-label="Close">
                                        <span class="h2 mb-3" aria-hidden="true">x</span>
                                    </button>
                                    <div class="mx-auto text-center">
                                        <img src="<?= $image_gauche; ?>" class="img-fluid" style="max-height: 90vh;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- --- Paragraphe droite --- -->
                <div class="col-md-8 col-sm-12 px-0">
                    <div class="my-2 ml-1 px-2 border-left border-secondary" style="border-left-width: thick!important;">
                        <p>
                            Nos plâtriers maîtrisent les prestations suivantes :
                        </p>
                        
                        <ul>
                            <?php
                                Prestations($valeur_savoir_faire, $bdd);
                            ?>
                        </ul>
                        <p>
                            Nos équipes expérimentées et qualifiées aux nouvelles normes vous feront part de leur savoir-faire et mettrons leurs compétences 
                            et leur qualité de travail à votre disposition pour la réalisation de vos projets.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
    
<!-- --- Les 3 dernières réalisations en carrelage (si il y en a) --- -->
<?php
    QuelquesRealisations($valeur_savoir_faire, $bdd);
?>