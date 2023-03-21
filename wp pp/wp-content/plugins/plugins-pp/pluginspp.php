<?php
/*
Plugin Name: Plugin projet pro
Description: Mon super plugin
Author: PP Teams
Version: 0.01
*/

//on import notre fichier PP_Random_Phot_Widget
require_once plugin_dir_path(__FILE__) . "/widget/PP_Random_Photo_Widget.php";

//on importe le fichier PP_database_Service
require_once plugin_dir_path(__FILE__) . "/services/PP_Database_Service.php";
//on importe notre class PP_List
require_once plugin_dir_path(__FILE__) . "/PP_List.php";



//creation de la class du plugin

class PP
{
    public function __construct()
    {
        //à l'activation du plugin
        register_activation_hook(__FILE__, array('PP_Database_Service', 'create_db'));
        //À LA DESACTIVATION DU PLUGI: on vide les tables de leurs données
        register_deactivation_hook(__FILE__, array('PP_Database_Service', 'empty_db'));

        //à la suppression du plugin, on supprime la table
        register_uninstall_hook(__FILE__, array('PP_Database_Service', 'delete_db'));

        //on enregistre le widget
        add_action('widgets_init', function () {
            register_widget('PP_Random_Photo_Widget');
        });

        //enregistrement 
        add_action('admin_menu', array($this, 'add_menu_client'));
    }

    //creation du menu client dans le BO
    public function add_menu_client()
    {
        add_menu_page(
            'Les clients PP',
            'Clients PP',
            'manage_options',
            'client-pp',
            array($this, "mes_clients"),
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
            array($this, 'mes_clients')

        );
    }

    public function mes_clients()
    {
        //on doit instancié la class PP_Database_Service
        $db = new PP_Database_Service();
        // on récupere le titre de la page
        echo "<h2>" . get_admin_page_title() . "</h2>";

        if ($_REQUEST['page'] == 'client-pp' || $_POST['send'] == 'ok' || $_GET['action']=='delete-client') {
            //on va mettre une seconde condition IF 
            // si on a bien lesdonnées du formulaire 
            // on execute la requete d'insertion
            if (isset($_POST['send']) && $_POST['send'] == 'ok') {
                $db->save_client();
            }
            if (isset($_POST['action']) && $_POST['action'] == 'delete-client') {
                $db->delete_client($_POST['delete-client']);
            }
            //on commence a construire notre table en HTML
            // echo "<table class='table-border'>";
            // echo "<tr>";
            // echo "<th>NOM</th>";
            // echo "<th>Prenom</th>";
            // echo "<th>email</th>";
            // echo "<th>telephone</th>";
            // echo "<th>fidelité</th>";
            // echo "</tr>";
            // //on va devoir boucler pour afficher les données des clients
            // foreach ($db->findAll() as $client) {
            //     echo "<tr>";
            //     echo "<td>" . $client->nom . "</td>";
            //     echo "<td>" . $client->prenom . "</td>";
            //     echo "<td>" . $client->email . "</td>";
            //     echo "<td>" . $client->telephone . "</td>";
            //     echo "<td>" . (($client->fidelite == 0) ? "Client infidele" : "Client fidele") . "</td>";

            //     // creation dun bouton de suppression
            //     //on utilisera un flag avec la valeur "del"
            //     echo "<td>";
            //     echo "<form method='post'>";
            //     echo "<input type='hidden' name='action' value='del'>";
            //     echo "<input type='hidden' name='id' value='". $client->id ."'>";
            //     echo "<input type='submit' value='supprimer'>";
            //     echo "</form>";
            //     echo "</td>";

            //     echo "</tr>";
            // }
            // //on pense a fermer le tableau
            // echo "</table>";

            $table = new PP_List(); //on instancie 
            $table->prepare_items(); // on appelle la methode prepare_items

            echo "<form action='' method='post'>";
            echo $table->display();//on affiche la table grace a display
            echo "</form>";

        } else {
            //on affiche le formulaire
?>
            <form action="" method="post">

                <!-- on place un input de type hidden
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
                    <label>Telephone</label>
                    <input type="text" id="telephone" name="telephone" class="widefat" required>
                </div>
                <div>
                    <label>Fidelité :</label>
                    <input type="radio" name="fidelite" class="widefat" value="0" checked>Non
                    <input type="radio" name="fidelite" class="widefat" value="1">Oui
                </div>
                <div>
                    <input type="submit" value="Enregistrer">
                </div>
            </form>

<?php
        }
    }
}



new PP();//on instancie la class