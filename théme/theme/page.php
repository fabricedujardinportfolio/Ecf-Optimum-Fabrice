<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="col-12 pt-4">
			<h1 class="title text-center"><?php the_title(); ?></h1>
		</div>
		<div class="container-fluid d-flex">
			<div class="col-2"></div>
			<div class="col-2">
				<!-- SIDEBAR dynamique start -->
				<aside class="site__sidebar">
					<ul>
						<?php
						$url1 = home_url('/culturelles', '');
						$url2 = home_url('/sportives', '');
						// var_dump($url1);
						if (is_page('culturelles')) :
							dynamic_sidebar('sidebar-2');
							echo "<div class='text-center'>	
									<a href='$url2' class='modifLien'>Voire tous les articles sportive</a>
								</div>
								";
						endif;
						if (is_page('sportives')) :
							dynamic_sidebar('sidebar-1');
						// echo"<div class='text-center'>	
						// 	<a href='$url1' class='modifLien'>Voire tous les articles culturelles</a>
						// </div>
						// ";
						endif;
						?>
					</ul>
				</aside>
				<!-- SIDEBAR dynamique END -->
			</div>
			<div class="col-6">
				<div class="col-2"></div>
				<!-- Content dynamique Start -->
				<?php the_content(); ?>
				<?php
				//Affichage sur les pages
				if (is_page('culturelles')) :
					echo "Catégorie : <strong>culturelles</strong>";
					echo do_shortcode('[the-post-grid id="23" title="Culturelle page"]');
				endif;
				if (is_page('sportives')) :
					echo "Catégorie : <strong>sportives</strong>";
					echo do_shortcode('[the-post-grid id="33" title="Sport page"]');
				endif;
				?>
				<!-- Content dynamique Start -->
			</div>
		</div>
<?php endwhile;
endif; ?>
<?php get_footer(); ?>