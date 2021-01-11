<!-- Page contenant la barre de contact + barre de navigation + includes 
	Insertion de la page script.js contenant : 
		- Lightbox créée (par moi-même) pour afficher en plein écran les photos des réalisations puis naviguer entre les différentes 
		photos d'un seul chantier.
		- Un évènement pour afficher le numéro au premier clic sur le bouton appeler (sur portable).
		- Un affichage/suppression du formulaire "Rappel Gratuit""
-->
<!DOCTYPE html>
<html lang="fr">
<head>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-177465690-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-177465690-1');
	</script>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./Pages/style.css">
	<link rel="stylesheet" type="text/css" href="./Pages/bootstrap.min.css">
	<link rel="stylesheet" href="./Images/fontawesome/css/all.min.css" >
	<meta name="author" content="Jérémy Bertoïa">
	<link rel="shortcut icon" href="./Images/favicon.ico">
	<title>Guillermain: Peinture | Carrelage | Revêtement de sols | Plâtrerie</title>
	<meta name="description" content="L'EURL Guillermain met à votre disposition 25ans d'expériences professionnelle pour vous conseiller, 
	vous guider.">
</head>
<body>
	<?php
		include('./Pages/connect.php');
		date_default_timezone_set('Europe/Paris');

		$query = "SELECT Nom, Valeur 
				  FROM   Guillermain_produits
				  WHERE  Nom_page = 'Contact' ";

		$req = $bdd->prepare($query);
        $req->execute() or die(print_r($bdd->errorInfo()));

        while($donnees = $req->fetch()){
			$contact[$donnees['Nom']] = $donnees['Valeur'];
		}
		$req = NULL;

		$query = "  SELECT Valeur 
                	FROM   Guillermain_produits
                	WHERE  Identifiant_page = 1598255290
					AND    Nom = 'Logo' ";

		$req = $bdd->prepare($query);
		$req->execute() or die(print_r($bdd->errorInfo()));
		$donnees = $req->fetch();

		$logo['Logo'] = $donnees['Valeur'];

	?>
	<!-- --- Barre de contact (pour les ordi) --- -->
	<div class="w-100 bg-secondary d-none d-sm-flex justify-content-between text-white py-1 px-3 ">
		<div>
			Écrivez-nous : <?= $contact['E-mail']; ?>
		</div>

		<div>
			<?= $contact['Adresse']; ?>
		</div>

		<div>
			<input type="hidden" id="appel_mobile" name="<?= $contact['Téléphone']; ?>">
			Appelez-nous : <a href="tel:+33<?= $contact['Téléphone']; ?>" class="text-decoration-none text-white"><?= $contact['Téléphone']; ?></a>
		</div>
	</div>
	<!-- Fin barre de contact -->

	<header class="sticky-top w-100">
		<nav class="navbar navbar-expand-sm navbar-light bg-primary">
			<a class="navbar-brand text-white font-weight-bold" href="index.php">Guillermain</a>

			<a href="tel:+33<?= $contact['Téléphone']; ?>" class="btn btn-success d-sm-none text-decoration-none" id="bouton_appel" disabled="disabled">Appeler</a>
		

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<div class="d-sm-none pt-3"></div>
				<div class="w-100 d-sm-flex justify-content-end">
					<ul class="navbar-nav text-center">
						<li class="nav-item active">
							<a class="nav-link text-white" href="index.php">Qui sommes nous ?</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Nos savoirs faire
							</a>
							<div class="dropdown-menu dropdown-menu-right bg-info" aria-labelledby="navbarDropdown">
								<a class="dropdown-item text-white" href="index.php?page=2"> Plâtrerie			</a>
								<a class="dropdown-item text-white" href="index.php?page=4"> Peinture 			</a>
								<a class="dropdown-item text-white" href="index.php?page=7"> Carrelage          </a>
								<a class="dropdown-item text-white" href="index.php?page=8"> Revêtement de sols </a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white" href="index.php?page=3">Nos réalisations</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white" href="index.php?page=5">Contact</a>
						</li>
						
						<!-- --- Formulaire de contact présent dans la barre de navigation seulement sur mobile --- -->
						<div class="dropdown-divider d-sm-none"></div>
						<li class="nav-item dropdown my-2 d-sm-none">
							<a class="nav-link btn btn-info dropdown-toggle text-white" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-phone-alt"></i> Faites vous rappelez
							</a>
							<form class="dropdown-menu dropdown-menu bg-info p-3" aria-labelledby="navbarDropdown2" method="POST" action="#">
								<div class="d-flex flex-column justify-content-around h-100">
									<div>
										<label for="nom_rappel" class="text-white m-0">Nom / Prénom </label>
										<input type="text" class="form-control" name="nom_rappel" id="nom_rappel" required="required">
									</div>
									<div>
										<label for="tel_rappel" class="text-white m-0">Téléphone </label>
										<input type="tel" class="form-control" name="tel_rappel" id="tel_rappel" required="required">
									</div>
									<div class="text-center mt-3">
										<button type="submit" class="btn btn-primary">ENVOYER</button>
									</div>
								</div>
							</form>	
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<!-- --- Rappel gratuit à droite de l'écran (sur ordinateur/ tablette) --- -->
	<section class="position-fixed bg-white rounded-left d-none d-sm-flex" id="section_rappel">
		<div id="mot_rappel" class="bg-secondary rounded-right">
			<p class="m-0 p-2 text-white"><i class="fas fa-phone-alt mb-1" style="transform: rotate(90deg);"></i> RAPPEL GRATUIT <i id="fleche_rappel" class="fas fa-angle-right"></i></p>
		</div>
		<!-- --- Formulaire "Rappel Gratuit" --- -->
		<form id="form_rappel" class="collapse p-1 border" method="POST" action="#">
			<div class="d-flex flex-column justify-content-around h-100">
				<div>
					<label for="nom_rappel" class="text-primary m-0">Nom / Prénom </label>
					<input type="text" class="form-control" name="nom_rappel" id="nom_rappel" required>
				</div>
				<div>
					<label for="tel_rappel" class="text-primary m-0">Téléphone </label>
					<input type="tel" class="form-control" name="tel_rappel" id="tel_rappel" required>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary">ENVOYER</button>
				</div>
			</div>
		</form>
	</section>
	<!-- Fin rappel gratuit -->

	<section class="corps_index">
		<?php
			/* --- Traitement de la page rappel en cas de prise de contact par le formulaire "Rappel Gratuit" --- */
			if(isset($_POST['tel_rappel']) AND isset($_POST['nom_rappel'])){
				include ('./Pages/demande_rappel.php');
			}

			if(isset($_GET['page'])){ 

				if(is_numeric($_GET['page'])){
					$page = $_GET['page'];

					if($page == 1){
						include("./Pages/accueil.php");
					}elseif($page == 2){
						include("./Pages/platrerie.php");
					}elseif($page == 3){
						include("./Pages/realisations.php");
					}elseif($page == 4){
						include("./Pages/peinture.php");
					}elseif($page == 5){
						include("./Pages/contact.php");
					}elseif($page == 6){
						include("./Pages/credit_photo.php");
					}elseif($page == 7){
						include("./Pages/carrelage.php");
					}elseif($page == 8){
						include("./Pages/revetement.php");
					}elseif($page == 9){
						include("./Pages/mentions_legales.php");
					}else{
						include("./Pages/accueil.php");
					}

				}else{
					include("./Pages/accueil.php");
				}

			}else{
				include("./Pages/accueil.php");
			}

		if(!isset($_COOKIE['consetementCookie'])){
		?>
			<div class="position-fixed bg-primary d-flex justify-content-around align-items-center p-1 w-100 text-white" 
					style="left: 0px; bottom: 0px; z-index: 1000;">
				<p class="my-1">
					Pour vous offrir la meilleure expérience utilisateur possible, ce site Web utilise des cookies. </br>
					En continuant à naviguer sur ce site, vous acceptez notre utilisation des cookies. 
				</p>
				<a href="#" class="btn btn-success border rounded-pill" id="compris">J'ai compris</a>
			</div>
		<?php
		}
		?>
	</section>
	

	<footer class="d-flex flex-column w-100 bg-primary justify-content-around text-white mt-5">
		<div>
			<div class="row mx-0">
				<div class="col-lg-4 col-md-5 col-sm-12 d-flex flex-column justify-content-around">

					<div class="text-center">
						<div class="w-100 align-items-center">
							<div class="row mx-0">
								<img src="<?= $logo['Logo'];  ?>" alt="Logo Guillermain" class="col-8 img-fluid rounded-pill my-2 ">
								<img src="./Images/rge_logo.png" alt="Label RGE Qualibat" class="col-4 img-fluid rounded my-2 ">
							</div>
						</div>
						<p class="font-weight-bold">Plâtrerie - Peinture - Carrelage - Revêtement de sol</p>
					</div>
					<div class="align-self-center text-center my-3">
						<a class="text-white text-decoration-none d-flex flex-column align-items-center justify-content-center" href="https://fr-fr.facebook.com/eurlguillermainpatrick/">
							<img src="./Images/iconeFb.png" alt="Logo Facebook">
							<span class="font-weight-bold"> EURL Guillermain Patrick</span>
						</a>
					</div>
					<div class="text-left mt-3">
						<ul class="list-unstyled pl-3">
							<li class="my-1"><i class="fas fa-home"></i> <?= $contact['Adresse']; ?></li>
							<li class="my-1"><i class="fas fa-at"></i>   <?= $contact['E-mail']; ?></li>
							<li class="my-1"><a href="tel:+33<?= $contact['Téléphone']; ?>" class="text-decoration-none text-white"><i class="fas fa-phone-alt"></i> <?= $contact['Téléphone']; ?> </a></li>
							<li class="mt-2"><u>Nos horaires </u>:</br>
								<?= $contact['Horaires']; ?>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-lg-8 col-md-7 col-sm-12 px-0">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2769.782056892566!2d4.2931938155766876!3d46.03549707911192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f473dab234d7e5%3A0x88d0ab6fcc01b113!2sEURL%20Guillermain!5e0!3m2!1sfr!2sfr!4v1600069606122!5m2!1sfr!2sfr" 
					class="w-100 h-100" frameborder="0" style="border:0; min-height: 300px;" aria-hidden="false" tabindex="0"></iframe>
				</div>
			</div>
		</div>

		<div class="py-1 bg-info">
			<ul class="list-unstyled text-center d-flex justify-content-around m-0">
				<li><a class="text-white" href="index.php?page=6" title="Crédits des photos utilisées sur le site">Crédits photos</a></li>
				<li><a class="text-white" href="mailto:bertoia.jeremy@hotmail.fr">Créé par Bertoïa Jérémy</a></li>
				<li><a class="text-white" href="index.php?page=9">Mentions légales</a></li>
			</ul>
		</div>
	</footer>

	<script rel="stylesheet" type="text/javascript" src="./Pages/jQuery.js"></script>
	<script rel="stylesheet" type="text/javascript" src="./Pages/bootstrap.min.js"></script>
	<script rel="stylesheet" type="text/javascript" src="./Pages/script.js"></script>
</body>
</html>