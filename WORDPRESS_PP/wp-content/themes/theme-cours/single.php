<!--Pour récupérer la partie header-->
<?php get_header() ?>

<main><!-- partie reservé au main -->
	<div class="row">
		<h2>C'est mon post</h2>
		<div class="col-sm-8 bloc-main bg-warning d-flex flex-wrap justify-content-center">
			<!--template de rendu pour les catégories-->
			<div class="card mb-3 p-3" style="width: 100%;">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="<?php echo get_the_post_thumbnail_url() ?>" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title"><?php the_title() ?></h5>
							<p class="card-text"><?php the_content(); ?></p>
							<p class="card-text"><small class="text-muted"><?php the_date() ?></small></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- on importe la sidebar -->
		<?php get_sidebar() ?>
	</div>
</main>

<!--Pour récupérer la partie footer-->
<?php get_footer() ?>

