<?php /* * Template Name: les cours */ ?>
<?php get_header(); ?>
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$custom_args = array(
    'post_type' => 'Courscollectifs',
    'posts_per_page' => 5,
    'post_status' => ' publish',
    'order_by' => 'post_date',
    'order' => 'DESC',
    'paged' => $paged
);
$custom_args2 = array(
    'post_type' => 'Coursparticuliers',
    'posts_per_page' => 5,
    'post_status' => ' publish',
    'order_by' => 'post_date',
    'order' => 'DESC',
    'paged' => $paged
);; ?>
<div class="container text-center">
    <h1>LES COURS</h1>
    <div class="row">
        <div class="col-6 d-flex border border-secondary p-1" style="min-height: 350px;">
        
            <?php
            $custom_query = new WP_Query($custom_args); ?>
            <?php if ($custom_query->have_posts()) : ?>
                <div class="col-2"></div>
                <div class="col-8 text-center">
                <img src="http://fabrice.devweb.cfa.nc/wordpress/wp-content/uploads/2021/11/Capture-decran-79.png" alt="" srcset="">
                <h2>POUR QUOI ?</h2>
                <p>
                Pour te motiver, pour travailler en groupe, pour suivre un coach, pour pratiquer de manière ludique et pour compléter ta séance de musculation. Tu as forcément une bonne raison de suivre les cours collectifs chez Fitness Park !
                </p>
                    <div class="container-fluid border">
                        <h2 class="p-3">Cours collectifs</h2>
                        <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                            <h3 class="entry-title">- <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></h3>
                        <?php endwhile; ?>
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
                <div class="col-8 text-center">
                <img src="http://fabrice.devweb.cfa.nc/wordpress/wp-content/uploads/2021/11/maxresdefault.jpg" alt="" srcset="">
                <h2>POUR QUOI ?</h2>
                <p>
                Le coach sportif particulier est avant tout là pour vous motiver. Il vous fera comprendre l’intérêt de continuer, ira chercher les arguments qui feront mouche chez vous pour vous pousser à continuer et atteindre vos objectifs.</p>
                    <div class="container-fluid border">
                    <h2 class="p-3">Cours particuliers</h2>
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