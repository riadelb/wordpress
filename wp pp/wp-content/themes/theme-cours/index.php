<!-- Pour recuperer la partie header -->
<?php get_header() ?>

<main><!-- partie réservé au main -->
    <div class="row ">
        <div class="col-sm-8 bloc-main bg-warning d-flex flex-wrap justify-content-center">
            <!-- partie pour le contenu principale -->
            <?php
                //si jai au moins un 'article', je loop(boucle) dessus pour recuperer chaque article
                if(have_posts()): while(have_posts()): the_post();
                //on recupere content.php auquel on lui donne les infos de 'the_post'
                get_template_part('content', get_post_format());


                //on ferme la boucle while
                endwhile;
                //on ferme le if
                endif;
            ?>
        </div>
        <!-- on importe la sidebar -->
        <?php get_sidebar() ?>
    </div>
</main>

<!-- Pour recuperer la partie footer -->
<?php get_footer() ?>