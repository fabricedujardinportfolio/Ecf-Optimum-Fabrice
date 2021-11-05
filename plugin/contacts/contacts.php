<?php
/**
 * @package Contacts plugin
 * @version 1.0
 */
/*
Plugin Name: contacts plugin
Description: These just a contacts plugin for ECF CCI in Nouméa
Author: Fabrice DUJARDIN
Version: 1.0
Author URI: https://fabricedujardinportfolio.github.io/
*/
// First step: create the database

function contact_database() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'contacts';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		first_name varchar(55) NOT NULL,
		last_name varchar(55) NOT NULL,
		phone VARCHAR(20) NOT NULL,
		comment text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option('contact_db_version', '1.0');
}

register_activation_hook(__FILE__, 'contact_database');


function contact_default_data() {
	global $wpdb;

    $table_name = $wpdb->prefix . 'contacts';
	
	$wpdb->insert( 
		$table_name,
		array( 
			'first_name' => 'Fabrice',
			'last_name' => 'DUJARDIN ',
			'phone' => '720165',
			'comment' => 'Bitcoin gang',
		) 
	);
}

register_activation_hook(__FILE__, 'contact_default_data');

// Third step: Add plugin to admin

function add_plugin_to_admin_contact() {
	function contact_content() {
		echo "<h1>Contacts</h1>";
		echo "<div style='margin-right:20px'>";

		if(class_exists('WP_List_Table')) {
			require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
			require_once(plugin_dir_path( __FILE__ ) . 'contact-list-table.php');
			$contactListTable = new ContactListTable();
			$contactListTable -> prepare_items();
			$contactListTable -> display();
		} else {
			echo "WP_List_Table n'est pas disponible.";
		}
		
		echo "</div>";
	}

	add_menu_page('Contacts', 'Contacts', 'manage_options', 'contact-plugin', 'contact_content');
}

add_action('admin_menu', 'add_plugin_to_admin_contact');


function contact_form() {
	ob_start();
	if (isset($_POST['fabcontact'])) {
		$first_name = sanitize_text_field($_POST["first_name"]);
		$last_name = sanitize_text_field($_POST["last_name"]);
		$phone = sanitize_text_field($_POST["phone"]);
		$comment = esc_textarea($_POST["comment"]);
		if ($first_name != '' && $last_name != '' && $phone  != '' && $comment  != '') {
		// var_dump($first_name,$last_name,$phone,$comment);
			global $wpdb;
			$table_name = $wpdb->prefix . 'contacts';
			$wpdb->insert( 
				$table_name,
				array( 
					'first_name' => $first_name,
					'last_name' => $last_name,
					'phone' => $phone,
					'comment' => $comment,
				) 
			);
			echo "<h4>Olé!</h4>";
		}
	}

	// Contact
	echo "<form class='col-8 mx-auto' method='POST'>";
	echo"<div class='input-group mb-3'>";
	echo"<span class='input-group-text'>Prénom</span>";
	echo"<input class='form-control' type='text' name='first_name' placeholder='Prénom' required>";
	echo"</div>";
	echo"<div class='input-group mb-3'>";
	echo "<input class='form-control'  type='text' name='last_name' placeholder='Nom de famille' required>";
	echo"<span class='input-group-text'>Nom</span>";
	echo"</div>";
	echo"<div class='input-group mb-3'>";
	echo"<span class='input-group-text'>Télèphone</span>";
	echo "<input class='form-control'  type='tel' name='phone' placeholder='' required>";
	echo"</div>";
	echo"<div class='input-group mb-3 form-floating'>";
	echo '<textarea name="comment" class="form-control " placeholder="Ajouter un commentaire" id="floatingTextarea" required></textarea>';
	echo "</div>";
	echo "<button class='btn btn-light' type='submit' name='fabcontact' value='Envoyez'>Envoyez</button>";
	echo "</form>";
	return ob_get_clean();
}

add_shortcode('contact', 'contact_form');
