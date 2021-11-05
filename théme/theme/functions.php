<?php
//FUNCTION
//SIDEBAR 
function fabrice_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Primary Sidebar', 'fabrice_widgets'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here to appear in your Primary Sidebar.', 'fabrice_widgets'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	));
	register_sidebar(array(
		'name'          => esc_html__('Secondary Sidebar', 'fabrice_widgets'),
		'id'            => 'sidebar-2',
		'description'   => esc_html__('Add widgets here to appear in your Secondary Sidebar.', 'fabrice_widgets'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	));
	register_sidebar(array(
		'name'          => esc_html__('Front Page Widget Area', 'fabrice_widgets'),
		'id'            => 'sidebar-front-page-widget-area',
		'description'   => esc_html__('Add widgets here to appear in Front Page Widget Area.', 'fabrice_widgets'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	));
	register_sidebar(array(
		'name'          => esc_html__('Header Right Widget Area', 'fabrice_widgets'),
		'id'            => 'header-right',
		'description'   => esc_html__('Add widgets here to appear in Header Right Widget Area.', 'fabrice_widgets'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	));
}

//Function pour rajouter un menu
function fabrice_enregistre_mon_menu()
{
	register_nav_menu('menu_principal', __('Menu principal de Fabrice ECF-4 NC')); // ajouter un menu crée dans wordpress dans le header de notre théme
}

// Activation des fonctionalité disponible de wordpress sur le théme
function fabrice_support()
{
	add_theme_support('title-tag');
	// add_theme_support('post-thumbnails'); // Function servant à appeler la mise en avant de l'image dans un article 
	// Définir la taille des images mises en avant
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(2000, 400, true);
	// Définir d'autres tailles d'images
	add_image_size('products', 800, 600, false);
	add_image_size('square', 256, 256, false);
}

//DEPENDANCE
function fabrice_register_asset()
{
	// Déclarer style.css à la racine du thème    

	wp_enqueue_style(
		'bootstrap',
		get_template_directory_uri() . '/css/bootstrap.min.css',
		array(),
		'5.7'
	);

	// Déclarer un autre fichier CSS
	wp_enqueue_style(
		'bootstrap',
		get_template_directory_uri() . 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js',
		array(),
		'1.0'
	);
	wp_enqueue_style(
		'css',
		get_stylesheet_uri(),
		array(),
		'1.0'
	);
}

//Cours parriculiers
function wpm_custom_post_type_cours_particuliers()
{

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x('Cours particuliers', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x('Cours particuliers', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __('Cours particuliers'),
		// Les différents libellés de l'administration
		'all_items'           => __('Touts les Cours particuliers'),
		'view_item'           => __('Voir les Cours particuliers'),
		'add_new_item'        => __('Ajouter une nouvelle Cours particuliers'),
		'add_new'             => __('Ajouter'),
		'edit_item'           => __('Editer le Cours particuliers'),
		'update_item'         => __('Modifier le Cours particuliers'),
		'search_items'        => __('Rechercher un Cours particuliers'),
		'not_found'           => __('Non trouvée'),
		'not_found_in_trash'  => __('Non trouvée dans la corbeille'),
	);

	// On peut définir ici d'autres options pour notre custom post type

	$args = array(
		'label'               => __('Cours particuliers'),
		'description'         => __('Tous sur le Cours particulier'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
		/* 
		* Différentes options supplémentaires
		*/
		'show_in_rest' => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array('slug' => 'cours-particuliers'),

	);

	// On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
	register_post_type('Coursparticuliers', $args);
}

add_action('init', 'wpm_custom_post_type_cours_particuliers', 0);


add_action('add_meta_boxes', 'add_particuliers_date_meta_box');
// Add meta box date to particuliers

function add_particuliers_date_meta_box()
{
	function particuliers_date($post)
	{
		$date = get_post_meta($post->ID, 'particuliers_date', true);

		if (empty($date)) $date = the_date();

		echo '<input type="date" name="particuliers_date" value="' . $date  . '" />';
	}

	add_meta_box('particuliers_date_meta_boxes', 'Date', 'particuliers_date', 'Coursparticuliers', 'side', 'default');
}

add_action('add_meta_boxes', 'add_particuliers_date_meta_box');


// Update meta on particuliers post save

function particuliers_post_save_meta($post_id)
{
	if (isset($_POST['particuliers_date']) && $_POST['particuliers_date'] !== "") {
		update_post_meta($post_id, 'particuliers_date', $_POST['particuliers_date']);
	}
}

add_action('save_post', 'particuliers_post_save_meta');
// Short code to display particuliers date meta data

function show_particuliers_date()
{
	ob_start();
	$date = get_post_meta(get_the_ID(), 'particuliers_date', true);
	echo "<date>$date</date>";
	return ob_get_clean();
}

add_shortcode('show_particuliers_date', 'show_particuliers_date');


//Cours collectifs
function wpm_custom_post_type_cours_collectifs()
{

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x('Cours collectifs', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x('Cours collectifs', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __('Cours collectifs'),
		// Les différents libellés de l'administration
		'all_items'           => __('Touts les Cours collectifs'),
		'view_item'           => __('Voir les Cours collectifs'),
		'add_new_item'        => __('Ajouter une nouvelle Cours collectifs'),
		'add_new'             => __('Ajouter'),
		'edit_item'           => __('Editer le Cours collectifs'),
		'update_item'         => __('Modifier la Cours collectifs'),
		'search_items'        => __('Rechercher un Cours collectifs'),
		'not_found'           => __('Non trouvée'),
		'not_found_in_trash'  => __('Non trouvée dans la corbeille'),
	);

	// On peut définir ici d'autres options pour notre custom post type

	$args = array(
		'label'               => __('Cours collectifs'),
		'description'         => __('Tous sur les Cours collectifs'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
		/* 
		* Différentes options supplémentaires
		*/
		'show_in_rest' => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array('slug' => 'cours-collectifs'),

	);

	// On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
	register_post_type('Courscollectifs', $args);
}

add_action('init', 'wpm_custom_post_type_cours_collectifs', 0);


// Add meta box date to collectifs

function add_collectifs_date_meta_box()
{
	function collectifs_date($post)
	{
		$date = get_post_meta($post->ID, 'collectifs_date', true);

		if (empty($date)) $date = the_date();

		echo '<input type="date" name="collectifs_date" value="' . $date  . '" />';
	}

	add_meta_box('collectifs_date_meta_boxes', 'Date', 'collectifs_date', 'Courscollectifs', 'side', 'default');
}

add_action('add_meta_boxes', 'add_collectifs_date_meta_box');


// Update meta on collectifs post save

function collectifs_post_save_meta($post_id)
{
	if (isset($_POST['collectifs_date']) && $_POST['collectifs_date'] !== "") {
		update_post_meta($post_id, 'collectifs_date', $_POST['collectifs_date']);
	}
}

add_action('save_post', 'collectifs_post_save_meta');
// Short code to display collectifs date meta data

function show_collectifs_date()
{
	ob_start();
	$date = get_post_meta(get_the_ID(), 'collectifs_date', true);
	echo "<date>$date</date>";
	return ob_get_clean();
}

add_shortcode('show_collectifs_date', 'show_collectifs_date');


//Yoga
function wpm_custom_post_type_yoga()
{

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x('les forfaits yoga', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x('Yoga', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __('Yoga'),
		// Les différents libellés de l'administration
		'all_items'           => __('Toutes le yoga'),
		'view_item'           => __('Voir le yoga'),
		'add_new_item'        => __('Ajouter une nouveau forfait yoga'),
		'add_new'             => __('Ajouter'),
		'edit_item'           => __('Editer le yoga'),
		'update_item'         => __('Modifier le yoga'),
		'search_items'        => __('Rechercher un forfait yoga'),
		'not_found'           => __('Non trouvée'),
		'not_found_in_trash'  => __('Non trouvée dans la corbeille'),
	);

	// On peut définir ici d'autres options pour notre custom post type

	$args = array(
		'label'               => __('Yoga'),
		'description'         => __('Tous sur yoga'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
		/* 
		* Différentes options supplémentaires
		*/
		'show_in_rest' => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array('slug' => 'yoga'),

	);

	// On enregistre notre custom post type qu'on nomme ici "Yoga" et ses arguments
	register_post_type('yoga', $args);
}

add_action('init', 'wpm_custom_post_type_yoga', 0);

// Add meta box date to musculation

function add_yoga_date_meta_box()
{
	function yoga_date($post)
	{
		$date = get_post_meta($post->ID, 'yoga_date', true);

		if (empty($date)) $date = the_date();

		echo '<input type="date" name="yoga_date" value="' . $date  . '" />';
	}

	add_meta_box('yoga_date_meta_boxes', 'Date', 'yoga_date', 'yoga', 'side', 'default');
}

add_action('add_meta_boxes', 'add_yoga_date_meta_box');


// Update meta on yoga post save

function yoga_post_save_meta($post_id)
{
	if (isset($_POST['yoga_date']) && $_POST['yoga_date'] !== "") {
		update_post_meta($post_id, 'yoga_date', $_POST['yoga_date']);
	}
}

add_action('save_post', 'yoga_post_save_meta');
// Short code to display yoga date meta data

function show_yoga_date()
{
	ob_start();
	$date = get_post_meta(get_the_ID(), 'yoga_date', true);
	echo "<date>$date</date>";
	return ob_get_clean();
}

add_shortcode('show_yoga_date', 'show_yoga_date');



//Fin yoga

//Salle de musculation (9000/m - 110000/a)
function wpm_custom_post_type_salle_musculation()
{

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x('les forfaits salle musculation', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x('La salle musculation', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __('Salle musculation'),
		// Les différents libellés de l'administration
		'all_items'           => __('Toutes les salles musculation'),
		'view_item'           => __('Voir la salle musculation'),
		'add_new_item'        => __('Ajouter un nouveau forfait salle musculation'),
		'add_new'             => __('Ajouter'),
		'edit_item'           => __('Editer le salle musculation'),
		'update_item'         => __('Modifier le salle musculation'),
		'search_items'        => __('Rechercher un forfait salle musculation'),
		'not_found'           => __('Non trouvée'),
		'not_found_in_trash'  => __('Non trouvée dans la corbeille'),
	);

	// On peut définir ici d'autres options pour notre custom post type

	$args = array(
		'label'               => __('salle musculation'),
		'description'         => __('Tous sur les salles musculation'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
		/* 
		* Différentes options supplémentaires
		*/
		'show_in_rest' => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array('slug' => 'salle-musculation'),
	);

	// On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
	register_post_type('salle musculation', $args);
}

add_action('init', 'wpm_custom_post_type_salle_musculation', 0);

// Add meta box date to musculation

function add_musculation_date_meta_box()
{
	function musculation_date($post)
	{
		$date = get_post_meta($post->ID, 'musculation_date', true);

		if (empty($date)) $date = the_date();

		echo '<input type="date" name="musculation_date" value="' . $date  . '" />';
	}

	add_meta_box('musculation_date_meta_boxes', 'Date', 'musculation_date', 'salle musculation', 'side', 'default');
}

add_action('add_meta_boxes', 'add_musculation_date_meta_box');


// Update meta on musculation post save

function musculation_post_save_meta($post_id)
{
	if (isset($_POST['musculation_date']) && $_POST['musculation_date'] !== "") {
		update_post_meta($post_id, 'musculation_date', $_POST['musculation_date']);
	}
}

add_action('save_post', 'musculation_post_save_meta');
// Short code to display musculation date meta data

function show_musculation_date()
{
	ob_start();
	$date = get_post_meta(get_the_ID(), 'musculation_date', true);
	echo "<date>$date</date>";
	return ob_get_clean();
}

add_shortcode('show_musculation_date', 'show_musculation_date');

//ACTION

//Appel de function pour rajouter un menu
add_action('widgets_init', 'fabrice_widgets_init');
add_action('init', 'fabrice_enregistre_mon_menu'); // Rajouter un menu pour créer
add_action('after_setup_theme', 'fabrice_support'); // Les support du théme
add_action('wp_enqueue_scripts', 'fabrice_register_asset'); // Les dépendance
