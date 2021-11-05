<?php
/*
  Template Name: Modéle Fabrice
*/
get_header(); ?>

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
<main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="post">
                <h2><?php the_title(); ?></h2>
                <?php the_post_thumbnail(); ?>
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
    endif; ?>
    <?php the_posts_pagination(); ?>
</main>
<aside class="site__sidebar">
    <ul>
        <?php dynamic_sidebar('sidebar-2'); ?>
    </ul>
</aside>
</div>
<?php get_footer(); ?>