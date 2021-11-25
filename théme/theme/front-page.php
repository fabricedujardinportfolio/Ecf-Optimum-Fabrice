<?php get_header(); ?>
<div class="col-12 pt-4">
	<h1 class="title text-center">
	</h1>
</div>
<div class="container-fluid d-block d-md-flex">
	<div class="col-1"></div>
	<div class="col-12 col-md-2">
		<!-- <aside class="site__sidebar">
			<ul> -->
				<!-- SIDEBAR GAUCHE Start -->
				<!-- <?php dynamic_sidebar('sidebar-2'); ?> -->
				<!-- SIDEBAR GAUCHE END -->
			<!-- </ul>
		</aside> -->
	</div>
	<div class="col-12 col-md-6 bg-light">
		<h2 class="p-2">Top events</h2>
		<!-- Titre -->
		<strong>
			<h3><?php the_title(); ?></h3>
		</strong>
		<aside class="container p-3 mb-3 mt-2 border ">
			<!-- Contenue wordpress start -->
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" class="post__link">Lire la suite</a>
			<!-- Contenue wordpress END -->
		</aside>
		<aside class="container p-3 mb-3 mt-2 border ">
		<div class="container d-flex">
			<div class="col-6">
				<h2>Qui sommes-nous</h2>
			<p>
				Distanciation sanitaire, aménagement des espaces, protections personnelles,  désinfection renforcée, règles strictes d'utilisation des équipements... 
				Nous nous engageons à mettre en œuvre toutes les règles sanitaires nécessaires pour faire de nos clubs des lieux de vie sains et protégés pour rebooster tes défenses immunitaires et te permettre de pratiquer dans les meilleurs conditions.
			</p>
			</div>
			<div class="col-6">
				<img src="http://fabrice.devweb.cfa.nc/wordpress/wp-content/uploads/2021/11/Visuels_Dispositif.png" alt="fitness" >
			</div>
		</div>
		<div class="container p-3">
			<img src="http://fabrice.devweb.cfa.nc/wordpress/wp-content/uploads/2021/11/Capture-decran-78.png" alt="" srcset="">
		</div>
		<div class="container  text-center p-3">
			<h2 class="text-center">HOME PARK</h2>
			<p  class="text-center">Tu souhaites te dépasser où tu veux et quand tu veux ? </p>
			<p  class="text-center">Atteins tes objectifs et entraîne toi avec nos lives et vidéos à la demande en accès illimité sur smartphone, tablette, ordinateur et caste même sur ta TV !</p>
			<a href="http://fabrice.devweb.cfa.nc/wordpress/salle-musculation/acces-a-la-salle-de-musculation-9000-m-110000-a/"  class="text-center m-auto"><button >JE DECOUVRE</button></a>
		</div>
		</aside>
		<aside class="site__sidebar">
			<h2>ACTUALITÉS FITNESS PARK DÉCOUVREZ NOS DERNIERS ARTICLES<?php get_current_user_id();?></h2>
			<ul>
				<!-- SIDEBAR CENTRALE MAIN* mais pas utilisé  Start -->
				<?php dynamic_sidebar('sidebar-front-page-widget-area'); ?>
				<!-- SIDEBAR CENTRALE MAIN* mais pas utilisé  END -->
						
				<!-- Contenue afficher par un echo d'un shortcode Start-->
				<?php echo do_shortcode('[the-post-grid id="55" title="All post"]'); ?>
				<!-- Contenue afficher par un echo d'un shortcode END-->
			</ul>
		</aside>
	</div>
	<div class="col-12 col-md-2">
		<aside class="site__sidebar">
			<ul>
				<!-- SIDEBAR DROITE Start -->
				<?php dynamic_sidebar('sidebar-1'); ?>
				<!-- <div class="text-center">
					<a href='<?php echo home_url('/culturelles', ''); ?>' class="modifLien">Voire tous les articles
						culturelles</a>
				</div> -->
				<div class="text-center">
					<!-- <a href='<?php echo home_url('/sportives', ''); ?>' class="modifLien">Voire tous les articles
						sportive</a> -->
				</div>
				<!-- SIDEBAR DROITE END -->
			</ul>
		</aside>
	</div>
	<div class="col-1"></div>
</div>
<?php   ?>
<?php get_footer(); ?>