<?php
//création de la fonction register_menu
function register_menu() {
	//fonction native de wordpress pour déclarer un menu
	register_nav_menus(
		array(
			'menu-sup'    => __( 'Main menu' ),
			'menu-footer' => __( 'Footer menu' ),  //la fonction __() permet la traduction dans le back office
			'menu-toto' => __( 'Toto menu' ),  //la fonction __() permet la traduction dans le back office
		)
	);
}

add_theme_support( 'custom-header' );

//on utilise la méthode add_action pour injecter notre fonction
//1er paramètre: le hook 'init'
//2eme paramètre: on appelle notre fonction
add_action( 'init', 'register_menu' );

//On va créer le rendu de notre menu
class Main_Menu_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		//$output servira pour le rendu "html" du menu
		//$data_object servira à récupérer les infos du menu (grace au BO)
		//on récupère les datas du menu
		$title     = $data_object->title; //récupère le titre
		$permalink = $data_object->url;//récupère le lien de redirection
		//on crée le template de rendu
		$output .= "<div class='nav-item'>";//on ouvre une div avec la class nav-item
		$output .= "<a href='" . $permalink . "' class='nav-link menu-style m-1 text-light'>";//on ouvre un a href avec le $permalink
		$output .= $title;// on affiche le titre
		$output .= "</a>";//on ferme la balise a
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		$output .= "</div>";// on finit en fermant la balise div
	}
}

class Main_Menu_Dropdown_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '<ul class="dropdown-menu">';
	}

	function start_el( &$output, $data_object, $depth = 0, $args = array(), $id = 0 ) {

		$title     = $data_object->title;
		$permalink = $data_object->url;

		if ( $permalink != '#' ) {
			if ( $depth > 0 ) {
				$output .= '';
			} else {

				$output .= "<li class='nav-item'>";
			}
		} else {
			$output .= "<li class='nav-item dropdown'>";
		}

		//Add SPAN if no Permalink
		if ( $permalink && $permalink != '#' ) {
			if ( $depth > 0 ) {
				$output .= '<a href="' . $permalink . '" 
				class="dropdown-item ">';
			} else {
				$output .= '<a href="' . $permalink . '" 
				class="nav-link border py-1 px-3 m-1 text-light menu-style">';
			}
		} else {
			$output .= '<a href="' . $permalink .
			           '" class="nav-link dropdown-toggle border 
			           py-1 px-3 m-1 text-light menu-style" data-bs-toggle="dropdown">';
		}

		$output .= $title;
		$output .= '</a>';
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = array() ) {
		if ( $depth > 0 ) {
			$output .= '';
		}
	}
}

//CREATION DE SHORTCODE
function monShortCode()
{
	//on return ce que le shortcode doit afficher
	return "<strong>Voici mon premier ShortCode</strong>";
}
function monShortPromo($attrs)
{
//on déclare une variable ici $a
	//on utilise la fonction de WP "shortcode_atts
	//pour attribuer des paramètres au shortcode
	//dans un array on définit notre key=value
	//key = percent et value=10 (par defaut)
	$a = shortcode_atts(['percent' => 10], $attrs);
	//dans le return on introduit notre variable entre { }
	return "<strong>Réduction de {$a['percent']}%</strong>";
}
//Il faut le déclarer dans wordpress
add_shortcode('myShort', 'monShortCode');
add_shortcode('promo', 'monShortPromo');

//fonction enregistrement zone pour widget
function register_custom_widget_area(): void
{
	register_sidebar(
		array(
			'id' => 'new-widget-area',
			'name' => esc_html__( 'Zone widget ', 'theme-domain' ),
			'description' => esc_html__( 'Une zone pour contenir des widgets dans la sidebar',
				'theme-domain' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title-holder"><h3 class="widget-title">',
			'after_title' => '</h3></div>'
		)
	);
}
add_action( 'widgets_init', 'register_custom_widget_area' );


function themename_custom_header_setup() {
	$args = array(
		'default-image'      => get_template_directory_uri() . 'img/banniere.jpg',
		'default-text-color' => '000',
		'width'              => 1000,
		'height'             => 250,
		'flex-width'         => true,
		'flex-height'        => true,
	);
	add_theme_support( 'custom-header', $args );
}

add_action( 'after_setup_theme', 'themename_custom_header_setup' );



