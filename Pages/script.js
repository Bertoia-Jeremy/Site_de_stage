/* Page contenant : 
		- Lightbox créée (par moi-même) pour afficher en plein écran les photos des réalisations puis naviguer entre les différentes 
		photos d'un seul chantier.
		- Un évènement pour afficher le numéro au premier clic sur le bouton appeler (sur portable).
		- Un affichage/suppression du formulaire "Rappel Gratuit"" */

/* Bouton APPEL sur mobile*/
var boutonAppel = document.getElementById('bouton_appel'),
    numeroAppel = document.getElementById('appel_mobile').name;

bouton_appel.addEventListener("click", function(e){
    if(boutonAppel.innerHTML === "Appeler"){
        e.preventDefault();
        boutonAppel.innerHTML = '<i class="fas fa-phone-alt"></i> ' + numeroAppel;
    }
});

/* Bouton RAPPEL autre que sur mobile */
var boutonRappel = document.getElementById('mot_rappel'),
    formRappel	 = document.getElementById('form_rappel'),
    flecheRappel = document.getElementById('fleche_rappel');

boutonRappel.addEventListener("click", function(){
    if(formRappel.className == "collapse p-1 border"){
            formRappel.className   = "show p-1 border";
            flecheRappel.className = "fas fa-angle-left";
    }else{
            formRappel.className   = "collapse p-1 border";
            flecheRappel.className = "fas fa-angle-right";
    }
});

/* Fonction affichage pour lightbox */
function affichageImage(infosImages, srcMiniature, altMiniature){
    for(let i = 0, nb = infosImages.length; i < nb ; i++){
        src = infosImages[i][0];
        alt = infosImages[i][1];

        if((src === srcMiniature) & (alt === altMiniature)){
            
            if(document.getElementById('blackout')){

                var blackout = document.getElementById('blackout');
                document.getElementById('div_titre').remove();
                
            }else{
                var blackout = document.createElement('div');
                
                blackout.id = 'blackout';
            }
        
            // Création d'une div pour le titre au dessus de l'image plein écran 
            var divTitre = document.createElement('div'),

            //Initialisation de la nouvelle image (en plein écran)
            nouvelleImage = document.createElement('img'),

            //Initialisation du titre à partir du alt de l'image
            paragraphe = document.createElement('p'),
            titre 	   = document.createTextNode(alt + " (" + (i+1) + "/" + nb + ") "),
            croixFermer = document.createElement('span'),

            //Initialisation des boutons précédent et suivant
            divImage = document.createElement('div');
            divImage.className = "position-relative";
            divImage.id 	   = "contenant_image";
            
            //Flèche gauche
            var divGauche 	 = document.createElement('div'),
                flecheGauche = document.createElement('i');

                divGauche.className    = "fleche_gauche";
                flecheGauche.className = "fas fa-arrow-left";

            if(i > 0){	//Si la position de la photo est inférieur au nombre de photos

                divGauche.addEventListener("click",function(){//On passe à l'image suivante
                    affichageImage(infosImages, infosImages[i - 1][0], infosImages[i - 1][1]);
                });

            }else{

                divGauche.addEventListener("click",function(){//Sinon on va au dernier
                    affichageImage(infosImages, infosImages[nb - 1][0], infosImages[nb - 1][1]);
                });

            }

            divGauche.appendChild(flecheGauche);
            divImage.appendChild(divGauche);
            //FIN flèche gauche

            //Flèche droite 
            var divDroite 	 = document.createElement('div'),
                flecheDroite = document.createElement('i');

                divDroite.className    = "fleche_droite";
                flecheDroite.className = "fas fa-arrow-right";

            if(i < (nb - 1)){//Si la position de la photo est inférieur au nombre de photos

                divDroite.addEventListener("click",function(){//On passe à l'image suivante
                    
                    affichageImage(infosImages, infosImages[i + 1][0], infosImages[i + 1][1]);
                });

            }else{

                divDroite.addEventListener("click",function(){//Sinon on retourne au début.
                    
                    affichageImage(infosImages, infosImages[0][0], infosImages[0][1]);
                });
            }
            
            divDroite.appendChild(flecheDroite);
            divImage.appendChild(divDroite);
            //Fin flèche droite

            croixFermer.innerHTML = "X";
            croixFermer.className = "croix_fermer p-3";
            nouvelleImage.src = srcMiniature;
            nouvelleImage.className = "img-fluid";
            paragraphe.className 	= "my-4";	
            divTitre.className 		= "titre container";
            divTitre.id = 'div_titre';

            paragraphe.appendChild(titre);		  //Paragraphe avec le titre + position
            divImage.appendChild(nouvelleImage);  //Div image contenant les flèches(si besoin) + l'image(plein écran)
            divTitre.appendChild(croixFermer);    //On insère la croix pour ferme l'image en pleine écran
            divTitre.appendChild(paragraphe);  	  //Div contenant le paragraphe(titre) + divImage
            divTitre.appendChild(divImage);
            blackout.appendChild(divTitre);

            croixFermer.addEventListener("click", function(){
                blackout.remove();
            });

            if(!document.getElementById('blackout')){//Ne pas le rajouter si déjà existant
                body.appendChild(blackout);
            }
            
        }//Fin if((src === srcMiniature) & (alt === altMiniature))
    }//Fin boucle for
}//Fin fonction affichageImage()

// C'est ici que nous definissons les images qui doivent ouvrir une lightbox au click.
var miniatures = document.querySelectorAll(".miniature"),
    body 	   = document.body;

for(var i = 0, nombreMiniatures = miniatures.length; i < nombreMiniatures; i++){

    miniatures[i].addEventListener("click", function(){
        //On prend son parent
        var parentMiniature = this.parentNode,
        //Son enfant + ses infos
            imageMiniature  = this.firstElementChild,
            altMiniature	= imageMiniature.alt,
            srcMiniature	= imageMiniature.src,
        //Et ses frères/soeurs
            fratrieMiniature = parentMiniature.children,
            infosImages = [];

        //Les infos de l'image de chaque miniature de la fratrie sont stockées dans le tb infosImages
        for(let i = 0, nb = fratrieMiniature.length; i < nb ; i++){
            
            var enfantMiniature = fratrieMiniature[i].firstElementChild,
                src = enfantMiniature.src,
                alt = enfantMiniature.alt;
            infosImages.push([src, alt]);

        }

        affichageImage(infosImages, srcMiniature, altMiniature);
    });
}