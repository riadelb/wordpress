<!-- template de rendu pour les categories -->
<div class="m-3 col-sm-4 border p-1">
<div>
    <h3>
        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
    </h3>
    <?php
    if ('post' == get_post_type()) : ?>
        <!-- on check s'il y a des posts lié a une categories -->
        <div class="blog-postmeta ">
            <div class="post-date">
                <?php echo get_the_date() ?>
            </div>
        </div>

    <?php endif ?>
</div>
<div class="entry-summary">
    <?php the_excerpt() ?>
    <a href="<?php the_permalink() ?>">
        <?php esc_html_e('lire plus &rarr;') ?>
    </a>
</div>
</div>


