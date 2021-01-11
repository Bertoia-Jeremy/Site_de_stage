<!-- Présentation du savoir faire, l'administrateur a la possibilité de changer les types de prestations (dans partie basse) et les 
3 dernières réalisations de l'entreprise de ce savoir-faire seront affichés en bas de la page. 
    La page donnees_savoirs_faire.php fournis :
                                        - Les types de prestations du savoir $valeur_savoir_faire grâce à Prestations()
                                        - Les 3 dernières réalisations de $valeur_savoir_faire grâce à QuelquesRealisations() + affichage 
    Page similaire à carrelage.php, platrerie.php et peinture.php -->
<?php
    $valeur_savoir_faire = "Revêtement de sols";

    include ('donnees_savoirs_faire.php');
?>

<div class="w-100 mx-0 px-0 d-flex align-items-center justify-content-center bg_img" <?= 'style = "background-image: url('.$image_principale.');"'; ?>>
    <h1 class="text-white text-center">REVÊTEMENT DE SOLS</h1> 
</div>
 
<section class="container mb-5">
   <!-- --- Partie haute --- -->
    <section class="mt-3">
        <div class="row mx-0 my-4">
            <div>
                <h2 class="mb-1 pb-1 text-primary">Nos soliers</h2>
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
                                        <img src="<?= $image_droite; ?>" alt="Chambre vide avec parquet" class="img-fluid" style="max-height: 90vh;">
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
                            Il existe nombre de revêtements. Pour être sûr de son choix et assurer une utilisation pérenne, 
                            mieux vaut réfléchir en amont à quel usage le revêtement est destiné, et surtout, à quelle pièce de la maison.</br>
                            Ces éléments (et bien d'autres) sont à prendre en considération avant de porter son choix sur tel ou tel revêtement. </br>
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
                        <img src="<?= $image_gauche; ?>" alt="" class="img-fluid pr-2" style="max-height: 350px;">
                    </a>
                    <div class="modal fade" id="image_gauche" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body pt-0 d-flex flex-column justify-content-center">
                                    <button type="button" class="close align-self-end" data-dismiss="modal" aria-label="Close">
                                        <span class="h2 mb-3" aria-hidden="true">x</span>
                                    </button>
                                    <div class="mx-auto text-center">
                                        <img src="<?= $image_gauche; ?>" alt="Parquet" class="img-fluid" style="max-height: 90vh;">
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
                            Nos soliers maîtrisent les types de sol suivants :
                        </p>
                        <ul>
                            <?php
                                Prestations($valeur_savoir_faire, $bdd);
                            ?>
                        </ul>
                        <p>
                            Chaque type de sol nécessite un savoir faire que nos équipes ont acquis avec une expérience laissant place à 
                            une finition fiable et sans défaut.
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