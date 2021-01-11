<!-- Présentation du savoir faire, l'administrateur a la possibilité de changer les types de prestations (dans partie basse) et les 
3 dernières réalisations de l'entreprise de ce savoir-faire seront affichés en bas de la page. 
    La page donnees_savoirs_faire.php fournis :
                                        - Les types de prestations du savoir $valeur_savoir_faire grâce à Prestations()
                                        - Les 3 dernières réalisations de $valeur_savoir_faire grâce à QuelquesRealisations() + affichage
    Page similaire à carrelage.php, platrerie.php et revetement.php -->
<?php
    $valeur_savoir_faire = "Peinture";

    include ('donnees_savoirs_faire.php');
?>

<div class="w-100 mx-0 px-0 d-flex align-items-center justify-content-center bg_img" <?= 'style = "background-image: url('.$image_principale.');"'; ?>>
    <h1 class="text-white text-center">Peinture</h1> 
</div>
 
<section class="container mb-5">
   <!-- --- Partie haute --- -->
    <section class="mt-3">
        <div class="row mx-0 my-4">
            <div>
                <h2 class="mb-1 pb-1 text-primary">Nos peintres</h2>
            </div>

            <div class="row mx-0">
                <!-- --- Image droite --- -->
                <div class="col-md-4 col-sm-12 order-1 order-sm-2 d-flex justify-content-center align-items-center px-0">
                    <a type="button" data-toggle="modal" data-target="#image_droite"> 
                        <img src="<?= $image_droite; ?>" alt="Photo de salon" class="img-fluid" style="max-height: 350px;">
                    </a>
                    <div class="modal fade" id="image_droite" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body pt-0 d-flex flex-column justify-content-center">
                                    <button type="button" class="close align-self-end" data-dismiss="modal" aria-label="Close">
                                        <span class="h2 mb-3" aria-hidden="true">x</span>
                                    </button>
                                    <div class="mx-auto text-center">
                                        <img src="<?= $image_droite; ?>" class="img-fluid" style="max-height: 90vh;">
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
                            Des travaux de qualité ne commencent qu'avec des produits de qualité adaptés à vos besoins. Afin de vous offrir des travaux durables 
                            nous faisons uniquement affaire avec des fournisseurs d'envergure tel que Tollens et Domaine de la peinture.</br>
                            Nous nous ferons un plaisir de vous conseiller et décrire les produits qui optimiseront la durée de vie de vos travaux.</br>

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
                                        <img src="<?= $image_gauche; ?>" alt="Photo d'une tapisserie 'Poster'" class="img-fluid" style="max-height: 90vh;">
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
                            Nos peintres maîtrisent les prestations suivantes :
                        </p>
                        <ul>
                            <?php
                                Prestations($valeur_savoir_faire, $bdd);
                            ?>
                        </ul>
                        <p>
                            Quels que soient vos besoins, nos peintres chez Guillermain maitrisent parfaitement les différentes techniques de peinture (rouleau, fusil, pinceau...), 
                            et ce sur tous les types de surface. Nous vous donneront le coup de pinceau dont vous avez besoin pour achever vos projets.</p>
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