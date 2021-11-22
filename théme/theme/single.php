<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <!-- article start -->
    <article class="post">
      <div class="col-12 pt-4">
        <h1 class="title text-center"><?php the_title(); ?></h1>
      </div>
      <div class="container-fluid text-center">
        <!-- <?php the_post_thumbnail("square"); ?> -->
      </div>
      <!-- INFO du post start -->
      <div class="post__meta d-flex pt-3 container">
        <div class="col-2"></div>
        <div class="col-8 d-flex bg-light pt-3">
          <div class="px-5">
            <?php echo get_avatar(get_the_author_meta('ID'), 120); ?>
          </div>
          <div class="container">
            <div class="col-12">
              <p>
                Publié le : <?php the_date(); ?><br>
                Par : <strong><?php the_author(); ?></strong><br>
              <div class="col-12">
                Dans la catégorie :
                <?php the_category(); ?></div>
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- INFO du post END -->
      <div class="col-2"></div>
      <div class="post__content">
        <!-- Content du post start -->
        <div class="container">
          <?php the_content(); ?>
        </div>
        <!-- Content du post END -->
        <!-- Commentaire du post start -->
        <!-- <div class="container">
          
        </div> -->
        <!-- // Par ici les commentaires -->
        <!-- Commentaire du post END -->
        <!-- AVIS du post start -->
        <!-- <div class="container">
          <p>
            <strong>Avis :</strong>
            <?php echo get_post_meta(get_the_ID(), 'avis', true); ?>
          </p>
          <p>
            <strong>Note :</strong>
            <?php echo get_post_meta(get_the_ID(), 'note', true); ?> / 10
          </p>
          <div class="plus-moins">
            <div class="plus">
              <?php echo get_post_meta(get_the_ID(), 'plus', true); ?>
            </div>
            <div class="plus">
              <?php echo get_post_meta(get_the_ID(), 'moins', true); ?>
            </div>
          </div>
        </div> -->
      </div>
        <!-- AVIS du post END -->
    </article>
    <!-- article END -->
<?php endwhile;
endif; ?>
<!-- Previous and Next Post start -->
<div class="container d-flex">
  <div class="col-6 text-right">
    <?php previous_post_link('Article Précédent<br>%link'); ?>
  </div>
  <div class="col-6">
    <?php next_post_link('Article Suivant: <br>%link'); ?>
  </div>
</div>
<!-- Previous and Next Post END -->
</div>
<?php get_footer(); ?>