<div class="col-sm-3 offset-sm-1 blog-sidebar bg-danger">
    <div class="sidebar-module">
        <?php if (is_single()): // is_single permet de savoir si on se trouve dans un post?>
            <h5>A propos</h5>
            <p>

               <?php the_author_meta('description'); ?>
            </p>
            <!-- on va afficher tous les articles de l'auteur en question-->
            <h5>Autre(s) acticle(s)</h5>
            <ol class="list-unstyled list-archive">
                <!--on doit interroger la bdd-->
                <?php
                $author_post = new WP_Query(array(
                    'author' => get_the_author()->id
                ));
                while ($author_post->have_posts()) : $author_post->the_post();
                    ?>
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                    </li>

                <?php endwhile ?>
            </ol>
        <?php endif; ?>


        <h5>Archives</h5>
        <ol class="list-unstyled list-archive">
            <?php wp_get_archives('type=monthly') ?>
        </ol>

	    <?php
	    // affichage des widget dans la sidebar
	    if ( is_active_sidebar( 'new-widget-area' ) ) : ?>
            <div id="secondary-sidebar" class="new-widget-area">
			    <?php dynamic_sidebar( 'new-widget-area' ); ?>
            </div>
	    <?php endif; ?>

    </div>


</div>
