<?php


class PP_Database_Service {
	public function __construct() {
	}

	//création de la fonction pour créer des tables dans la BDD
	public static function create_db() {
		//on appelle la variable globale de WP pour la connexion
		global $wpdb;
		//on peut créer la query pour créer une table
		$wpdb->query( "CREATE TABLE IF NOT EXISTS " .
		              " {$wpdb->prefix}pp_client ( " .
		              " id INT AUTO_INCREMENT PRIMARY KEY, " .
		              " nom VARCHAR(150) NOT NULL, " .
		              " prenom VARCHAR(150) NOT NULL, " .
		              " email VARCHAR(250) NOT NULL, " .
		              " telephone VARCHAR(50) NOT NULL, " .
		              " fidelite BOOLEAN DEFAULT false " .
		              "); " );

		//On va regarder si la table contient des lignes (données)
		$count = $wpdb->get_var( "SELECT count(*) FROM {$wpdb->prefix}pp_client;" );

		//si la table est vide on lui ajoute une valeur par défaut
		if ( $count == 0 ) {
			$wpdb->insert( "{$wpdb->prefix}pp_client", [
				'nom'       => 'Linard',
				'prenom'    => 'Julien',
				'email'     => 'julien@gmail.com',
				'telephone' => '0612345678',
				'fidelite'  => true,
			] );
		}

	}

	//créer une function qui permet de vider la table de toutes ses données
	// ATTENTION: A NE PAS FAIRE EN CAS REEL
	public function empty_db() {
		global $wpdb;
		$wpdb->query( "TRUNCATE {$wpdb->prefix}pp_client;" );
	}

	//on crée une méthode qui supprime la table
	public function delete_db() {
		global $wpdb;
		$wpdb->query( "DROP TABLE {$wpdb->prefix}pp_client;" );
	}

	//requete pour récupérer la liste des clients
	public function findAll() {
		global $wpdb;
		$result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}pp_client;" );

		return $result;
	}

	//on crée la méthode pour enregistrer un client en BDD
	public function save_client() {
		global $wpdb;
		//on récupère les données envoyées par le formulaire
		$valeurs = [
			'nom'       => $_POST['nom'],
			'prenom'    => $_POST['prenom'],
			'email'     => $_POST['email'],
			'telephone' => $_POST['telephone'],
			'fidelite'  => $_POST['fidelite'],
		];
		//on vérifie que le client n'existe pas dans la DB
		$row = $wpdb->get_row( "SELECT id FROM {$wpdb->prefix}pp_client WHERE `email`='{$valeurs['email']}';" );
		if ( is_null( $row ) ) {
			//si le client n'existe pas on peut l'inserer
			$wpdb->insert( "{$wpdb->prefix}pp_client", $valeurs );
		}
	}

	//requete pour supprimer un utilisateur
	public function delete_client( $ids ) {
		global $wpdb;
//		var_dump($ids);
		//on check si ids sont dans un tableau sinon on le met dedans
		//pour avoir la possibilité de supprimer plusieurs clients à la fois
		if ( ! is_array( $ids ) ) {
			$ids = array( $ids );
		}
		//requête de suppression
		$wpdb->query( "DELETE FROM {$wpdb->prefix}pp_client
       WHERE id IN (" . implode( ',', $ids ) . ");" );
	}
}