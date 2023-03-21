<?php
/*
 * Plugin Name: Plugin projet pro
 * Description: Mon super plugin
 * Author: PP Teams
 * Version: 0.0.1
 */

//on importe notre fichier PP_Random_Photo_Widget
require_once plugin_dir_path( __FILE__ ) . "/widget/PP_Random_Photo_Widget.php";
//on importe le fichier PP_Database_Service
require_once plugin_dir_path( __FILE__ ) . "/service/PP_Database_Service.php";
//on importe notre class PP_List
require_once plugin_dir_path( __FILE__ ) . "/PP_List.php";


//création de la class du plugin
class PP {
	public function __construct() {
		//à l'activation du plugin : création des tables dans la BDD
		register_activation_hook( __FILE__, array( 'PP_Database_Service', 'create_db' ) );

		//à la désactivation du plugin: on vide les tables de leurs données
		register_deactivation_hook( __FILE__, array( 'PP_Database_Service', 'empty_db' ) );

		//à la suppression du plugin, on supprime la table
		register_uninstall_hook( __FILE__, array( 'PP_Database_Service', 'delete_db' ) );
		//on enregistre le widget
		add_action( 'widgets_init', function () {
			register_widget( 'PP_Random_Photo_Widget' );
		} );

		//Enregistrement du nouveau menu
		add_action( 'admin_menu', array( $this, 'add_menu_client' ) );
	}

	//création du menu client dans le BO
	public function add_menu_client() {
		add_menu_page(
			'Les clients PP',
			'Clients PP',
			'manage_options',
			'client-pp',
			array( $this, "mes_clients" ),
			'dashicons-groups',
			40
		);

		//ajouter un sous menu
		add_submenu_page(
			'client-pp',
			'Ajouter un client',
			'Ajouter',
			'manage_options',
			'add-client',
			array( $this, 'mes_clients' )
		);
	}

	//crée la méthode mes_clients()
	public function mes_clients() {
		//on doit instancier la class PP_Database_Service
		$db = new PP_Database_Service();
		//on récupère le titre de la page
		echo "<h2>" . get_admin_page_title() . "</h2>";
		if ( $_REQUEST['page'] == 'client-pp' || $_POST['send'] == 'ok' || $_POST['action'] == 'delete-client' ) {
			//on va mettre une seconde condition IF
			//Si on a bien les données du formulaire
			//on execute la requete d'insertion
			if ( isset( $_POST['send'] ) && $_POST['send'] == 'ok' ) {
				$db->save_client();
			}
			if ( isset( $_POST['action'] ) && $_POST['action'] == 'delete-client' ) {
//				var_dump( $_POST['delete-client'] );
				$db->delete_client($_POST['delete-client']);
			}


			$table = new PP_List();//on instancie la class
			$table->prepare_items();//on appelle la méthode prepare_items


			echo "<form method='post'>";
			echo $table->display();// on affiche la table grace à display()
			echo "</form>";

		} else {
			//on affiche le formulaire
			?>
            <form method="post">
                <!-- On place un input hidden
				 permet d'envoyer "ok" lorsqu'on poste le formulaire
				 cette valeur "ok" servira de flag pour faire du traitement dessus -->
                <input type="hidden" name="send" value="ok">
                <div>
                    <label>Nom</label>
                    <input type="text" id="nom" name="nom" class="widefat" required>
                </div>
                <div>
                    <label>Prenom</label>
                    <input type="text" id="prenom" name="prenom" class="widefat" required>
                </div>
                <div>
                    <label>Email</label>
                    <input type="text" id="email" name="email" class="widefat" required>
                </div>
                <div>
                    <label>Téléphone</label>
                    <input type="text" id="telephone" name="telephone" class="widefat" required>
                </div>
                <div>
                    <label>Fidelité</label>
                    <input type="radio" name="fidelite" class="widefat" value="0" checked>non
                    <input type="radio" name="fidelite" class="widefat" value="1">oui
                </div>
                <div>
                    <input type="submit" value="Enregistrer">
                </div>
            </form>

			<?php
		}
	}
}

new PP(); //on instancie la class