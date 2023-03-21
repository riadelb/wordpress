<!-- nous avons acces ici aux valeurs renvoyés par 'the_post' 
on a donc acces a pleins d'information
exemple: => the_title(), the_content(), .. 
-->


<div class="card m-2" style="width: 18rem;">
  <img src="<?php the_post_thumbnail_url() ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php the_title() ?></h5>
    <p class="card-text"><?php the_excerpt() ?></p>
    <a href="<?php the_permalink() ?>" class="btn btn-primary">Voir +</a>
  </div>
</div>