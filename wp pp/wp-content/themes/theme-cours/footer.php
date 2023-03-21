<!-- partie réservé au footer -->
<footer class="bg-primary">
    <div class="d-flex justify-content-around">
        <div class="col-sm-4">
            <h2>BIENVENUE DANS LE FOOTER</h2>
            <p>contact: supersite.com</p>
            <p>mail: supersite.com@gmail.com</p>
            <p>tel: 45643546554</p>
            <p>supersite.com</p>

        </div>
        <div>
            <?php wp_nav_menu([
                "theme_location" => "menu-footer", //récuperation du menu (avec le slug)
                "container" => "nav", //création d'un container parent, ici nav
                "container_class" => "navbar navbar-expand-lg navbar-light footer", //ajout de class au container
                "menu_class" => "navbar-nav mr-auto d-flex flex-column", // ajout de class au menu
                "menu-id" => "", //possibilité d'ajouter un id
                "walker" => new Main_Menu_Walker, // récuperation de la classe crée précedement
            ])

            ?>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>

</html>