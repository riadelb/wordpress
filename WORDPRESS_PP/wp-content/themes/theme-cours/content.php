<!--<div class="blog-post">-->
<!--    <h2 class="blog-post-title text-primary">--><?php //the_title(); ?><!--</h2>-->
<!--    <p class="blog-post-meta">-->
<!--		--><?php //the_date(); ?><!-- par <a href="#">--><?php //the_author(); ?><!--</a>-->
<!--    </p>-->
<!--	--><?php //the_content(); ?>
<!---->
<!---->
<!---->
<!--</div>-->

<div class="card m-3" style="width: 18rem;">
    <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="<?php the_title() ?>">
    <div class="card-body">
        <h5 class="card-title"><?php the_title() ?></h5>
        <p class="card-text"><?php the_date()?><a href="#"><?php the_author()?></a></p>
        <p class="card-text"><?php the_excerpt();?></p>
    </div>
    <div class="card-footer">
        <a href="<?php the_permalink(); ?>" class="btn btn-primary text-white">voir plus</a>
    </div>
</div>