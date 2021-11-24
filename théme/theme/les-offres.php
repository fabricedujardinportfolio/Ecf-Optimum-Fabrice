<?php /* * Template Name: les offres */ ?>
<?php get_header(); ?>
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$custom_args = array(
    'post_type' => 'Yoga',
    'posts_per_page' => 5,
    'post_status' => ' publish',
    'order_by' => 'post_date',
    'order' => 'DESC',
    'paged' => $paged
);
$custom_args2 = array(
    'post_type' => 'salle musculation',
    'posts_per_page' => 5,
    'post_status' => ' publish',
    'order_by' => 'post_date',
    'order' => 'DESC',
    'paged' => $paged
);; ?>
<div class="container text-center">
    <h1>LES OFFRES</h1>
    <div class="row">
        <div class="col-6 d-flex border border-secondary p-1" style="min-height: 350px;">
            <?php
            $custom_query = new WP_Query($custom_args); ?>
            <?php if ($custom_query->have_posts()) : ?>
                <div class="col-2"></div>
                <div class="col-8 text-center" style="align-self: center;">
                <img src="http://localhost/Ecf-Optimum-Fabrice/wordpress/wp-content/uploads/2021/11/Yoga-conseils-astuces-seances.jpg" alt="" srcset="">
                <h2>POUR QUOI ?</h2>
                <p>
                Quand on pratique la musculation, c'est généralement pour gagner en masse et en force. Ajouter une séance de yoga avant ou après l'entraînement de musculation permet d'étirer les muscles pour en optimiser la croissance.
                </p>
                    <div class="container-fluid border">
                    <h2 class="p-3">Yoga</h2>
                    <ul>
                        <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                            <h3 class="entry-title">- <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></h3>
                        <?php endwhile; ?>
                    </ul>
                </div>
                </div>
                <div class="col-2"></div>
            <?php endif; ?>

        </div>

        <div class="col-6 d-flex border border-secondary p-1" style="min-height: 350px;">
            <?php
            $custom_query2 = new WP_Query($custom_args2); ?>
            <?php if ($custom_query2->have_posts()) : ?>
                <div class="col-2"></div>
                <div class="col-8 text-center " style="align-self: center;">
                <img src="http://localhost/Ecf-Optimum-Fabrice/wordpress/wp-content/uploads/2021/11/Espace-musculation-n°1.jpg" alt="" srcset="">
                <h2>POUR QUOI ?</h2>
                <p>
                - Développer ta croissance musculaire et ta force physique. Obtenir une plus grande résistance et des muscles plus toniques, plus saillants.
<br><br>- Augmenter ta prise de masse musculaire en diminuant ta masse grasse</p>
<div class="container-fluid border">
                    <h2 class="p-3">Salle musculation</h2>
                    <?php while ($custom_query2->have_posts()) : $custom_query2->the_post(); ?>
                        <h3 class="entry-title">- <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></h3>
                    <?php endwhile; ?>
                </div>
                </div>
                <div class="col-2"></div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>