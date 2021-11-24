# Ecf-Optimum-Fabrice
Ecf cci pour le plugin de réservation
![Capture d’écran (80)](https://user-images.githubusercontent.com/44850811/143307537-ece78a0b-6dec-4204-99e4-c45f0fbec0e7.png)


## Demande client :
La salle de sport “OPTIMUM” veut refaire son site internet, le directeur Monsieur Ga souhaite moderniser son site en ajoutant un module de réservation pour les différents cours de sport et autres services comme les séances de yoga.

Le site devra permettre la réservation des services suivants :

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
![Capture d’écran (72)](https://user-images.githubusercontent.com/44850811/140199489-7de75b8b-594b-432f-a159-12a5cfe9fb69.png)
``` 
//Affichage sur les pages
<?php
	if (is_page('sportives')) :
	    echo "Catégorie : <strong>sportives</strong>";
	    echo do_shortcode('[the-post-grid id="33" title="Sport page"]');
	endif;
?>
``` 
![Capture d’écran (70)](https://user-images.githubusercontent.com/44850811/140199161-1653f108-ae94-4cf1-84c4-347cbc3c20fd.png)
``` 
<aside class="site__sidebar">
		<h2>Les dernier article sur le sport</h2>
		<ul>
		<!-- SIDEBAR CENTRALE MAIN* mais pas utilisé  Start -->
		<?php dynamic_sidebar('sidebar-front-page-widget-area'); ?>
		<!-- SIDEBAR CENTRALE MAIN* mais pas utilisé  END -->

		<!-- Contenue afficher par un echo d'un shortcode Start-->
		<?php echo do_shortcode('[the-post-grid id="71" title="All post"]'); ?>
		<!-- Contenue afficher par un echo d'un shortcode END-->
		</ul>
</aside>
``` 
- Intaller les extensions fakerPress et The Post Grid
- Créer les pages Accueil ,Sportives ,Les offres ,Les cours ,Réservation ,Contact
- Créer la catégorie "sportives"

- Créer un jeux d'article de test fakerPress avec la catégorie "sportives" ou Créer les manuellement.
- Créer le post Grid pour l'affichage de la catégorie "sportives"

- Créer les offres voulue dans les custom post type "Salle musculation", "Yoga", "Cours collectifs", "Cours particuliers"

- Se rendre dans les extension de wordpress 
- Installer les plugins ["resa events plugin ", "Events" ,"contacts plugin"]

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
![Capture d’écran (74)](https://user-images.githubusercontent.com/44850811/140200130-ddf2443b-9070-4845-95fe-319ad69be336.png)


