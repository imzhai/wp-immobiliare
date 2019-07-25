<?php

function immobiliare_enqueue_styles() {
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
  
    wp_enqueue_script('jquery', "https://code.jquery.com/jquery-3.3.1.slim.min.js", [], false, true );
    wp_enqueue_script('popper.js', "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js", [], false, true );
    wp_enqueue_script('bootstrap', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js", [], false, true );
    wp_enqueue_script('app',  get_template_directory_uri() . '/assets/js/app.js', [], false, true );

}

// On attache la fonction immobiliare 'wp_enqueue_scripts'
add_action( 'wp_enqueue_scripts', 'immobiliare_enqueue_styles' );


function register_my_menu() {
    register_nav_menu('main-menu', 'Menu principal');
}

add_action( 'init', 'register_my_menu' );

// Register Custom Navigation Walker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

// Image à la une.
add_theme_support( 'post-thumbnails' );


function register_housing(){
    register_post_type('housing',[
        'label' => 'Logements',
        'labels' => [
            'name' => 'Logements',
            'singular_name' => 'Logement',
            'all_items' => 'Tous les logements',
            'add_new_item' => 'Ajouter un logement',
            'edit_item' => 'Éditer le logement',
            'new_item' => 'Nouveau logement',
            'view_item' => 'Voir le logement',
            'search_items' => 'Rechercher parmi les logements',
            'not_found' => 'Pas de logement trouvé',
            'not_found_in_trash' => 'Pas de logement dans la corbeille'
        ],
        'public' => true,
        'supports' => ['title', 'editor', 'author', 'thumbnail'],
        'has_archive' => true,
        'show_in_rest' => true, // Si on veut activer Gutenberg
    ]);
}
   
// Ajout des annonces
add_action( 'init', 'register_housing' );

// ajout des taxonomy

 // type
 function registerSize(){
 register_taxonomy('size', 'housing', [
    'label' => 'Size',
    'labels' => [
        'name' => 'Size',
        'singular_name' => 'Size',
        'all_items' => 'Tous les size',
        'edit_item' => 'Éditer le size',
        'view_item' => 'Voir le size',
        'update_item' => 'Mettre à jour le size',
        'add_new_item' => 'Ajouter un size',
        'new_item_name' => 'Nouveau size',
        'search_items' => 'Rechercher parmi les size',
        'popular_items' => 'Size les plus utilisés'
    ],
    'hierarchical' => true,
    'show_in_rest' => true, // Pour Gutenberg
]);
}
    // ajout du type
add_action( 'init', 'registerSize');

 // VILLE
 function registerCity(){
 register_taxonomy('city', 'housing', [
    'label' => 'Citys',
    'labels' => [
        'name' => 'Citys',
        'singular_name' => 'City',
        'all_items' => 'Tous les citys',
        'edit_item' => 'Éditer le city',
        'view_item' => 'Voir le city',
        'update_item' => 'Mettre à jour le city',
        'add_new_item' => 'Ajouter un city',
        'new_item_name' => 'Nouveau city',
        'search_items' => 'Rechercher parmi les citys',
        'popular_items' => 'Citys les plus utilisés'
    ],
    'hierarchical' => true,
    'show_in_rest' => true, // Pour Gutenberg
]);
}
    // ajout du city
add_action( 'init', 'registerCity' );



/**
 * CREATE TABLE `wf3_wordpress`.`wp_contact` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `reference` VARCHAR(255) NOT NULL , `housing_id` INT NOT NULL , `lastname` VARCHAR(255) NOT NULL , `firstname` VARCHAR(255) NOT NULL , `message` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
 */
// ce hooke est executé au moment où le back offiche de WP est chargé
add_action( 'admin_menu', 'contact_menu' );

/** Step 1. */
function contact_menu() {
	add_menu_page( 'Demande de contact', 'Demandes de contact', 'manage_options', 'demande-de-contact', 'contact_page' );
}

/** Step 3. */
function contact_page() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	} ?>
	<div class="wrap">
    <h1>Demandes de contact.</h1>


    <style>
        table {
        border: medium solid #000000;
        width: 50%;
        }

        thead, th, td{
            text-align : center;
        }

        th{
            background-color: lightgrey;
            border-left : 1px solid black;
        }

        td{
            border-left : 1px solid black;
        }
    

    </style>
    
    
    <?php 
    global $wpdb;
    $contacts =  $wpdb->get_results("SELECT * FROM {$wpdb->prefix}contact");    
     ?>
      <hr color="blue"> 
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                 <th scope="col tr">#</th>
                <th scope="col">Référence  </th>
                <th scope="col">Annonce  </th>
                <th scope="col"> Prenom </th>
                <th scope="col"> Nom </th>
                <th scope="col"> Message </th>            
            </tr>
        </thead>
    <tbody>

    <?php foreach($contacts as $contact): ?>
    <tbody>
        <tr>
       
            <th scope="row"> <?= $contact->id ?> </th>
            <td>  <?= $contact->reference ?> </td>

            <td>  
                <a target="_blank"href="<?php the_permalink($contact->housing_id) ?>">Voir l'annonce</a>
               
            </td>
            
            <td>  <?= $contact->lastname ?> </td>
            <td>  <?= $contact->firstname ?> </td>
            <td>  <?= $contact->message ?> </td>

            <?php endforeach; ?>
        </tr>
        </tbody>
    </table>






    </div>
<?php }