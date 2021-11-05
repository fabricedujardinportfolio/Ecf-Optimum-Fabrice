<?php get_header(); ?>
<?php
if (is_category()) {
    $title = "Catégorie : " . single_tag_title('', false);
} elseif (is_tag()) {
    $title = "Étiquette : " . single_tag_title('', false);
} elseif (is_search()) {
    $title = "Vous avez recherché : " . get_search_query();
} else {
    $title = 'Actualités';
}
?>
<div class="col-12 pt-4">
    <h1 class="title text-center"><?php echo $title; ?></h1>
</div>
<div class="container d-block d-md-flex">
    <div class="col-md-2"></div>
    <div class="col-md-7 col-12">
        <main>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article class="post p-3">
                        <h2><?php the_title(); ?></h2>
                        <p class="post__meta">
                            Publié le <?php the_time(get_option('date_format')); ?>
                            par <?php the_author(); ?> • <?php comments_number(); ?>
                        </p>
                        <?php the_excerpt(); ?>
                        <p>
                            <a href="<?php the_permalink(); ?>" class="post__link">Lire la suite</a>
                        </p>
                    </article>
                    <?php endwhile;
                    ?>;

                <?php endif; ?>
                <?php the_posts_pagination(); ?>

        </main>
    </div>
    <div class="col-md-3"></div>
</div>
</div>
<?php get_footer(); ?>