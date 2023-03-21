<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thème custom</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
          crossorigin="anonymous"
    >
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/style.css" ?>">
</head>
<body>

<header class="text-white p-3"
        style="
            background-image: url(<?php header_image(); ?>) ;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            width: 100vw;

">
    <!-- partie reservé au header -->
    <a class="text-light" href="<?php echo get_bloginfo( 'wpurl' ) ?>">
        <h2><?php echo get_bloginfo( 'name' ) ?></h2>
    </a>
    <em><?php echo get_bloginfo( 'description' ) ?></em>

    <!--On appelle notre menu principal ici-->
	<?php wp_nav_menu( [
		"theme_location"  => "menu-sup", //récupération du menu (avec le slug)
		"container"       => "nav", //création d'un container parent, ici nav
		"container_class" => "navbar navbar-expand-lg bg-body-tertiary", //ajout de class au container
		"menu_class"      => "navbar-nav mr-auto", //ajout de class au menu
		"menu-id"         => "", //possibilité d'ajouter un id
		"walker"          => new Main_Menu_Dropdown_Walker(),  //récupération de la classe
	] );

	?>


</header>
