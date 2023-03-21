<!-- Pour recuperer la partie header -->
<?php get_header() ?>

<main><!-- partie réservé au main -->
    <div class="row ">
        <h2>C'est mon article</h2>
        <!-- template de rendu pour les categories -->
<div class="m-3 col-sm-8 border p-1"><div class="card mb-3" style="max-width: 100%;">
  <div class="row g-0">
    <div class="col-md-4 p-3">
      <img src="<?php echo get_the_post_thumbnail_url() ?>" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php the_title() ?> </h5>
        <p class="card-text"><?php the_content() ?></p>
        <p class="card-text"><small class="text-muted"><?php the_date() ?></small></p>
      </div>
    </div>
  </div>
</div>
        <!-- on importe la sidebar -->
        <?php get_sidebar() ?>
    </div>
</main>

<!-- Pour recuperer la partie footer -->
<?php get_footer() ?>