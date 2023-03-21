<?php

//certaines versions de wordpress n'arrivent pas a etendre la class WP_List
//pour y remedier on chargera la class manuellement
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

//on importe notre class pp_database_service
require_once plugin_dir_path(__FILE__) . '/services/PP_Database_Service.php';

class PP_List extends WP_List_Table
{

    private $dal;
    //on a surcharger le constructeur
    public function __construct($args = array())
    {
        parent::__construct([
            'singular' => __('Client'),
            'plural' => __('Clients'),
        ]);
        $this->dal = new PP_Database_Service();
    }

    //on va preparer notre liste
    public function prepare_items()
    {
        //on va preparer toutes les variables qu'on aura besoin
        $columns = $this->get_columns(); // on recupere les colonnes
        $hidden = $this->get_hidden_columns(); // on ajoute cette variable si on veut masquer des colonnes
        $sortable = $this->get_sortable_columns(); //permet de trier des colonnes
        //on traite la pagination
        //pour afficher un nombre de resultats par page
        $perPage = $this->get_items_per_page('client_per_page', 10);
        $currentPage = $this->get_pagenum(); //permet de savoir dans quelle page on est
        //on traite les données
        $data = $this->dal->findAll(); //pour récuperer les infos de la DB
        $totalPage = count($data); //pour savoir le nombre de lignes de $data
        //on traite le tri
        usort($data, array(&$this, 'usort_reorder')); // &$this =>pour faire reference a notre class 

        $paginationData = array_slice($data, (($currentPage -1)*$perPage), $perPage);
        //on redefinit les valeurs de la pagination
        $this->set_pagination_args([
            'total_items' => $totalPage,
            'per_page' => $perPage
        ]);
        //on injecte les differentes data aux colonnes
        $this->_column_headers= [$columns, $hidden, $sortable];
        //On alimente les champs de données
        $this->items = $paginationData;

    }
    //on va surcharger la fonction get_columns
    public function get_columns(): array
    {
        $columns = [
            'cb' => '<input type="checkbox"/>',
            'id' => 'id',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'fidelite' => 'Fidelite'
        ];
        return $columns;
    }
    //function supplementaire si on voulait masquer des colonnes
    public function get_hidden_columns(): array
    {
        return []; // on retourne un tableau vide car on ne veut pas masquer de colonnes
        //sinon on aurait pu faire :
        //return ['Telephone' => 'Telephone'];
    }
    //on s'occupe de la fonction qui va gerer le tri
    public function usort_reorder($a, $b)
    {
        //si on passe un parametre de tri dans l'url, on le traite
        //sinon par defaut on tripar l'id
        $orderBy = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'id';
        //IDEM pour l'ordre de tri
        $order = (!empty($_GET['order'])) ? $_GET['order'] : 'desc';
        //on crée la mecanique
        $result = strcmp($a->$orderBy, $b->$orderBy); //on compare string a avec string b
        return ($order === 'asc') ? $result : -$result; // -$result inverse le tableau
    }

    //permet de remplir le nom des colonnes par defaut
    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
            case 'nom':
            case 'prenom':
            case 'email':
            case 'telephone':
            case 'fidelite':
                return $item->$column_name;
                break;
            default:
                return print_r($item, true);
        }
    }

    //premet d'affilier les colonnes que l'on souhaite trier 
    public function get_sortable_columns(){
        $sortable = [
            'id' => array('id', true),
            'nom' => array('nom', true),
            'prenom' => array('prenom', true),
            'email' => array('email', true),
            'fidelite' => array('fidelite', true)
        ];
        return $sortable;
    }

    
    public function column_cb($item)
    {
        //convertir l'élement en tableau
        $item = (array) $item;
        //Retourner une checkbox pour chaque ligne du tableau
        return sprintf(
            "<input type='checkbox' name='delete-client[]' value='%s'>", $item['id']
        );
    }

    public function get_bulk_actions()
    {
        return array(
            'delete-client' => __('Delete'),
            'update-client' => __('Update')
        );
    }
}
