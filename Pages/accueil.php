<!-- Page contenant la 1ère page du site, la présentation de l'entreprise -->
<?php
    $query = "  SELECT Nom, Valeur 
                FROM   Guillermain_produits
                WHERE  Identifiant_page = 1598255290";

    $req = $bdd->prepare($query);
    $req->execute() or die(print_r($bdd->errorInfo()));

    $produits_accueil = [];

    while($donnees = $req->fetch()){
        $produits_accueil[$donnees['Nom']] = $donnees['Valeur'];
    }
    $req = NULL;
?>

    <div class="container text-center mt-2">
            <img src="<?= $produits_accueil["Logo"]; ?>" alt="Logo Guillermain" class="img-fluid" style="max-height: 350px;">
        <p class="text-justify mb-0 my-sm-3">
            <?= $produits_accueil['Texte accueil'] ?>    
        </p>
    </div> 

    <div class="d-flex justify-content-around">
        <a href="index.php?page=5"       class="btn d-sm-none btn-success mb-3">Nous contacter</a>
        <a href="index.php?page=5&devis" class="btn d-sm-none btn-primary mb-3">Demander un devis</a> 

        <a href="index.php?page=5"       class="btn btn-lg d-none d-sm-inline-block btn-success mb-4">Nous contacter</a> 
        <a href="index.php?page=5&devis" class="btn btn-lg d-none d-sm-inline-block btn-primary mb-4">Demander un devis</a> 
    </div>
</div> 

<section class="w-100 bg_img text-center font-weight-bold d-flex justify-content-center" id="rge">
    <div class="align-self-center mt-1 pt-2">
        <h3 class="text-white">
            Signe de qualité mis en place par les Pouvoirs Publics </br>
            et donnant accès aux aides de l'État
        </h3>
        <div class="mt-2 ">
            <a href="https://www.qualibat.com/particulier/entreprises-qualibat/nos-entreprises-qualibat-et-qualibat-rge-2/" class="text-white">
                <img src="./Images/rge_logo.png" class="w-100" style="max-width: 140px;" alt="logo QUALIBAT RGE">
                <p class="mt-2 mb-1">
                    <u><strong>QUALIBAT RGE</strong></u> qu'est-ce que c'est ?    <i class="fas fa-angle-right"></i>
                </p>        
            </a>
        </div>
    </div>
    <small class="position-absolute text-dark"> * RGE (Reconnu Garant de l'Environnement) </small>
</section>

<h4 class="mt-5 pt-5 mb-4 text-center text-primary font-weight-bold"><u>Nos différentes équipes :</u></h4>
<section class="row mx-auto justify-content-center mb-5">

    <div class="card p-0 m-3 col-lg-4 col-md-5 col-sm-11 shadow">
        <a href="index.php?page=4">
            <img src="./Images/peinture.jpg" alt="Pots de peinture et escabeau" class="w-100 rounded-top">  
        </a>

        <div class="card-body pb-1">
            <a href="index.php?page=4" class="text-decoration-none">
                <h2 class="text-primary">Peintres</h2>
                <p class="card-text text-dark mb-0">
                    L'EURL Guillermain vous accompagne à chaque étape de votre projet par des conseils personnalisés 
                    et garantit des prestations dans les règles de l’art. 
                </p>
            </a>
        </div>
            
        <div class="text-right pr-3 pb-3">
            <a href="index.php?page=4" class="btn btn-secondary py-2">En savoir plus</a>  
        </div> 
    </div>
    
    <div class="card p-0 m-3 col-lg-4 col-md-5 col-sm-11 shadow">
        <a href="index.php?page=2">
            <img src="./Images/platrier.jpg" alt="Application d'enduit avec 2 spatules" class="w-100 rounded-top"> 
        </a>   
        <div class="card-body pb-1">
            <a href="index.php?page=2" class="text-decoration-none">
                <h2 class="text-primary">Plâtriers</h2>
                <p class="card-text text-dark mb-0">
                    L'EURL Guillermain conçoit et met en œuvre votre système d’isolation thermique et acoustique.</br>
                    De plus nous vous proposons des isolants performants et écologiques.  
                </p>
            </a>
        </div>
        <div class="text-right pr-3 pb-3">
            <a href="index.php?page=2" class="btn btn-secondary py-2">En savoir plus</a>  
        </div> 
    </div>

    <div class="card p-0 m-3 col-lg-4 col-md-5 col-sm-11 shadow">
        <a href="index.php?page=7">
            <img src="./Images/carrelage4.jpg" alt="Pose d'un carrelage grand carreau" class="w-100 rounded-top">   
        </a> 
        <div class="card-body pb-1">
            <a href="index.php?page=7" class="text-decoration-none">
                <h2 class="text-primary">Carreleurs</h2>
                <p class="card-text text-dark mb-0">
                    Le savoir-faire artisanal de nos carreleurs vous garantit une pose soignée, des joints fins et 
                    un rendu harmonieux dans le respect des normes en vigueur et de l’environnement.
                </p>
            </a>
        </div>
        <div class="text-right pr-3 pb-3">
            <a href="index.php?page=7" class="btn btn-secondary py-2">En savoir plus</a>  
        </div> 
    </div>

    <div class="card p-0 m-3 col-lg-4 col-md-5 col-sm-11 shadow">
        <a href="index.php?page=8">
            <img src="./Images/parquet.jpg" alt="Pose de parquet clippable" class="w-100 rounded-top"> 
        </a>  
        <div class="card-body pb-1">
            <a href="index.php?page=8" class="text-decoration-none">
                <h2 class="text-primary">Soliers</h2>
                <p class="card-text text-dark mb-0">
                    Qu’il s’agisse de revêtement de sols souples, de revêtement de sols durs ou de tout autre revêtement 
                    nos équipes de poseurs expérimentés répondent à toutes vos exigences pour un résultat irréprochable. 
                </p>
            </a>
        </div>
        <div class="text-right pr-3 pb-3">
            <a href="index.php?page=8" class="btn btn-secondary py-2">En savoir plus</a>  
        </div> 
    </div>
</section>

<section>
    <h4 class="mt-5 pt-5 text-center text-primary font-weight-bold mb-4"><u>Partenaire Guillermain :</u></h4>
    <div class="w-100 p-0 d-flex flex-column align-items-center justify-content-center text-center bg_img sco2bois">
            <a class="h1 text-white font-weight-bold text-decoration-none" href="http://www.sco2bois.com" target="_blank">
                SCO2BOIS & CO</br>
                <span class="h3">LES ARTISANS BATISSEURS ASSOCIÉS</span></br>
                <span class="h5">CONSTRUCTEUR DE MAISONS OSSATURES BOIS</span>
            </a>
            <a class="mt-3 text-white font-weight-bold" href="http://www.sco2bois.com" target="_blank">Voir le site www.sco2bois.com   <i class="fas fa-angle-right"></i></a>
    </div>
</section>
