<!--Pour récupérer la partie header-->
<?php get_header() ?>

<main><!-- partie reservé au main -->
	<h1>Je suis dans le fichier page</h1>
	<div class="row">
		<div class="col-sm-8 bloc-main bg-warning d-flex flex-wrap justify-content-center">
			<!--partie pour le contenu principal-->

			<?php
			//SI j'ai au moins un "article", je "loop" dessus pour récupérer chaque "article"
			if (have_posts()) : while (have_posts()) : the_post();

				//On recupère content.php auquel on lui donne les infos de "the_post"
				get_template_part('content','page', get_post_format());

				//on ferme la boucle while
			endwhile;

				//on ferme la condition if
			endif;
			?>

		</div>
		<!-- on importe la sidebar -->
		<?php get_sidebar() ?>
	</div>
</main>

<!--Pour récupérer la partie footer-->
<?php get_footer() ?>

