<?php get_header(); ?>
<div class="col-12 pt-4">
	<h1 class="title text-center">
	</h1>
</div>
<div class="container-fluid d-block d-md-flex">
	<div class="col-1"></div>
	<div class="col-12 col-md-2">
		<aside class="site__sidebar">
			<ul>
				<!-- SIDEBAR GAUCHE Start -->
				<?php dynamic_sidebar('sidebar-2'); ?>
				<!-- SIDEBAR GAUCHE END -->
			</ul>
		</aside>
	</div>
	<div class="col-12 col-md-6 bg-light">
		<h2 class="p-2">Top events</h2>
		<!-- Titre -->
		<strong>
			<h3><?php the_title(); ?></h3>
		</strong>
		<aside class="container p-3 mb-3 mt-2 border ">
			<!-- Contenue wordpress start -->
			<?php the_content(); ?>
			<!-- Contenue wordpress END -->
		</aside>
		<aside class="site__sidebar">
			<h2>Les dernier article sur le sport <?php get_current_user_id();?></h2>
			<ul>
				<!-- SIDEBAR CENTRALE MAIN* mais pas utilisé  Start -->
				<?php dynamic_sidebar('sidebar-front-page-widget-area'); ?>
				<!-- SIDEBAR CENTRALE MAIN* mais pas utilisé  END -->
						
				<!-- Contenue afficher par un echo d'un shortcode Start-->
				<?php echo do_shortcode('[the-post-grid id="71" title="All post"]'); ?>
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
					<a href='<?php echo home_url('/sportives', ''); ?>' class="modifLien">Voire tous les articles
						sportive</a>
				</div>
				<!-- SIDEBAR DROITE END -->
			</ul>
		</aside>
	</div>
	<div class="col-1"></div>
</div>
<?php   ?>
<?php get_footer(); ?>