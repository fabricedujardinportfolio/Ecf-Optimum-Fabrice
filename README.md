# Ecf-Optimum-Fabrice
Ecf cci pour le plugin de réservation
![Capture d’écran (69)](https://user-images.githubusercontent.com/44850811/140199063-a99126d7-cf7a-4bba-9205-ceed9cb8f7dd.png)

## Demande client :
La salle de sport “OPTIMUM” veut refaire son site internet, le directeur Monsieur Ga souhaite moderniser son site en ajoutant un module de réservation pour les différents cours de sport et autres services comme les séances de yoga.

Le site permettra la réservation des services suivants :

Accès à la salle de musculation (9000/m - 110000/a)
Cours particuliers
Renforcement musculaire (6000/s)
Préparation physique (6000/s)
Cours collectifs
Cardio training (3000/s)
Cross training (4000/s)
Séance de yoga (5000/s)

## Procédure à suivre pour installer le projet


- Installer correctement le théme fournis avec le plugin 
- L'affichage de la page accueil et des sidebar de page en générale se feront par des "do_shortcode"

![image](https://user-images.githubusercontent.com/44850811/140199380-e6c331e8-b7f2-422d-b5c0-702c1db779b5.png)
``` 
//Affichage sur les pages
<?php
	if (is_page('culturelles')) :
		echo "Catégorie : <strong>culturelles</strong>";
		echo do_shortcode('[the-post-grid id="23" title="Culturelle page"]');
	endif;
	if (is_page('sportives')) :
	    echo "Catégorie : <strong>sportives</strong>";
	    echo do_shortcode('[the-post-grid id="33" title="Sport page"]');
	endif;
?>
``` 
![Capture d’écran (70)](https://user-images.githubusercontent.com/44850811/140199161-1653f108-ae94-4cf1-84c4-347cbc3c20fd.png)

- Intaller les extensions fakerPress et The Post Grid
- Créer les pages Accueil ,Sportives ,Les offres ,Les cours ,Réservation ,Contact
- Créer la catégorie "sportives"

- Créer un jeux d'article de test fakerPress avec la catégorie "sportives" ou Créer les manuellement.
- Créer le post Grid pour l'affichage de la catégorie "sportives"

- Créer les offres voulue dans les custom post type "Salle musculation", "Yoga", "Cours collectifs", "Cours particuliers"

- Se rendre dans les extension de wordpress 
- Installer le plugin "resa events plugin ", "Events" ,"contacts plugin"

- Installer les shortCodes du plugin  "contacts plugin" sur la page contact 
``` 
[contact]
```
- Installer le shortcode du plugin "resa events plugin" sur les articles récemment Créer à partir des customs post type 
```
[fabreservations]
```
Pour voir la date des réservation possible il existe un code court pour chaque custom post type:

- Pour le custom post type "yoga"
```
[show_yoga_date]
```
- Pour le custom post type "salle musculation"
```
[show_musculation_date]
```
- Pour le custom post type "Cours collectifs"
```
[show_collectifs_date]
```
- Pour le custom post type "Cours particuliers"
```
[show_particuliers_date]
```
- Définir sur la page "les offres" et "Les cours" leurs modéles qui porte leur nom.



