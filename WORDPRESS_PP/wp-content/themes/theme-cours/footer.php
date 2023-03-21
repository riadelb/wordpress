
<footer class="d-flex justify-content-around"><!-- partie reservé au footer -->
    <div class="col-sm-4">
        <h2 class="text-light">Bienvenue dans le footer</h2>
        <p class="text-light">SuperSite.com</p>
        <p class="text-light">contact : contact@SuperSite.com</p>
        <p class="text-light">téléphone : 01.02.03.04.05</p>
    </div>
    <div class="col-sm-4">

	    <?php wp_nav_menu( [
		    "theme_location"  => "menu-footer", //récupération du menu (avec le slug)
		    "container"       => "nav", //création d'un container parent, ici nav
		    "container_class" => "navbar navbar-expand-lg bg-body-tertiary", //ajout de class au container
		    "menu_class"      => "navbar-nav mr-auto d-flex flex-column", //ajout de class au menu
		    "menu-id"         => "", //possibilité d'ajouter un id
		    "walker"          => new Main_Menu_Walker(),  //récupération de la classe
	    ] );

	    ?>
    </div>
    <!--On appelle notre menu principal ici-->

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

</body>
</html>
