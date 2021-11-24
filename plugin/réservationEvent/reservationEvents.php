<?php

/**
 * @package résa events plugin
 * @version 1.0
 */
/*
Plugin Name: resa events plugin
Description: These just a events resa plugin for ECF CCI in Nouméa
Author: Fabrice DUJARDIN
Version: 1.0
Author URI: https://fabricedujardinportfolio.github.io/
*/
// First step: create the database

function event_database()
{
	global $wpdb;

	$table_name = $wpdb->prefix . 'reservation_events';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id mediumint(100) NOT NULL AUTO_INCREMENT,
		first_name varchar(55) NOT NULL,
		last_name varchar(55) NOT NULL,
		phone VARCHAR(20) NOT NULL,
		age TEXT(250) NOT NULL,
		cours VARCHAR(100) NOT NULL,
		horraire VARCHAR(100) NOT NULL,
		info VARCHAR(100)  NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option('event_database', '1.0');
}

register_activation_hook(__FILE__, 'event_database');

function add_plugin_to_admin_events()
{
	function event_content()
	{
		echo "<h1>Events</h1>";
		echo "<div style='margin-right:20px'>";

		if (class_exists('WP_List_Table')) {
			require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
			require_once(plugin_dir_path(__FILE__) . 'events-list-table.php');
			$eventsListTable = new ReservationListTable();
			$eventsListTable->prepare_items();
			$eventsListTable->display();
		} else {
			echo "WP_List_Table n'est pas disponible.";
		}

		echo "</div>";
	}

	add_menu_page('Toutes les réservations', 'Toutes les réservations', 'manage_options', 'events-plugins', 'event_content');

	function resa_form()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . 'reservation_events';
		$table_namePost = $wpdb->prefix . 'posts';
		$events = $wpdb->get_results("SELECT * FROM $table_name ", ARRAY_A);
		$eventsPoststypeYogas = $wpdb->get_results("SELECT * FROM $table_namePost WHERE post_type = 'yoga' OR post_type = 'sallemusculation' OR post_type = 'courscollectifs' OR post_type = 'coursparticuliers' ", ARRAY_A);

		if (isset($_POST['resa'])) {
			$first_name = sanitize_text_field($_POST["first_name"]);
			$last_name = sanitize_text_field($_POST["last_name"]);
			$phone = sanitize_text_field($_POST["phone"]);
			$age = esc_textarea($_POST["age"]);
			$eventsName = sanitize_text_field($_POST["events"]);
			$horraire = sanitize_text_field($_POST["horraire"]);

			if ($first_name != '' && $last_name != '' && $phone  != '' && $age  != '' && $eventsName  != '') {
				global $wpdb;

				$table_name = $wpdb->prefix . 'reservation_events';

				$wpdb->insert(
					$table_name,
					array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'phone' => $phone,
						'age' => $age,
						'cours' => $eventsName,
						'horraire' => $horraire,

					)
				);

				echo "<h4>Merci! Vous êtes inscrit à ce cours.</h4>";
			}
		}

		echo "<div class='d-flex'>";
		echo "<div class='row'>";
		echo "<p>La réservation</p>";
		echo "<form class='col-8 mx-auto' method='POST'>";
		echo "<div class='input-group mb-3'>";
		echo "<span class='input-group-text'>Nom</span>";
		echo "<input class='form-control'  type='text' name='last_name' placeholder='Nom de famille' required>";
		echo "</div>";
		echo "<span class='input-group-text'>Prénom</span>";
		echo "<input class='form-control' type='text' name='first_name' placeholder='Prénom' required>";
		echo "</div>";
		echo "<div class='input-group mb-3'>";
		echo "<span class='input-group-text'>Téléphone</span>";
		echo "<input class='form-control'  type='tel' name='phone' placeholder='' required>";
		echo "</div>";
		echo "<div>";
		echo "<select name='events' id='events-select' required>";
		echo "<option value='' >--Please choose an option--</option>";
		foreach ($eventsPoststypeYogas as $eventsPoststypeYoga) {
			$stack1 = array();
			array_push($stack1, $eventsPoststypeYoga['post_title']);
			$postype = $eventsPoststypeYoga['post_title'];
			echo "<option value='$postype'>$postype</option>";
		}
		echo "</select>";
		echo "</br>";
		echo "</br>";
		echo "</div>";
		echo "<div class='input-group mb-3'>";
		echo "<input class='form-control'  name='age' placeholder='Âge' required>";
		echo "<span class='input-group-text'>Âge</span>";
		echo "</div>";
		echo "<div class='input-group mb-3'>";
		echo "<select class='form-select p-2 mb-3' aria-label='Default select example' name='horraire'>
			<option selected>Choisie ton crénaux horaire</option>
			<option value='10h à 12h'>10h à 12h</option>
			<option value='13h à 15h'>13h à 15h</option>
			<option value='16h à 18h'>16h à 18h</option>
		</select>";
		echo "</div>";
		echo "<button type='reservation' name='resa'>Click Me!</button>";
		echo "</form>";
		echo "</div>";
		echo "</div>";
	}

	add_submenu_page('events-plugins', 'event', 'Ajouter', 'edit_posts', 'addreservation_event', 'resa_form');
}

add_action('admin_menu', 'add_plugin_to_admin_events');

function reservation_form()
{
	ob_start();

	if (isset($_POST['fabreservations'])) {
		if (get_post_type(get_the_ID()) == 'sallemusculation') {
			// condition name sallemusculation
			$abonement = sanitize_text_field($_POST["abonement"]);
			$first_name = sanitize_text_field($_POST["first_name"]);
			$last_name = sanitize_text_field($_POST["last_name"]);
			$phone = sanitize_text_field($_POST["phone"]);
			$age = esc_textarea($_POST["age"]);
			$cours = sanitize_text_field($_POST["cours-id"]);
			$horraire = "Aucune";
		} elseif (get_post_type(get_the_ID()) == 'yoga') {
			// condition name yoga
			$first_name = sanitize_text_field($_POST["first_name"]);
			$last_name = sanitize_text_field($_POST["last_name"]);
			$phone = sanitize_text_field($_POST["phone"]);
			$age = esc_textarea($_POST["age"]);
			$cours = sanitize_text_field($_POST["cours-id"]);
			$horraire = sanitize_text_field($_POST["horraire"]);
			$abonement = "Aucun";
		} elseif (get_post_type(get_the_ID()) == 'coursparticuliers') {
			// condition name cours particulier
			$first_name = sanitize_text_field($_POST["first_name"]);
			$last_name = sanitize_text_field($_POST["last_name"]);
			$phone = sanitize_text_field($_POST["phone"]);
			$age = esc_textarea($_POST["age"]);
			$cours = sanitize_text_field($_POST["cours-id"]);
			$horraire = "Aucun";
			$abonement = "Aucun";
		} elseif (get_post_type(get_the_ID()) == 'courscollectifs') {
			/// condition name cours collectifs
			$first_name = sanitize_text_field($_POST["first_name"]);
			$last_name = sanitize_text_field($_POST["last_name"]);
			$phone = sanitize_text_field($_POST["phone"]);
			$age = esc_textarea($_POST["age"]);
			$cours = sanitize_text_field($_POST["cours-id"]);
			$horraire = sanitize_text_field($_POST["horraire"]);
			$abonement = "Aucun";
		}

		// var_dump($horraire);
		if ($first_name != '' && $last_name != '' && $phone  != '' && $age  != '' && $cours  != '') {
			global $wpdb;

			$table_name = $wpdb->prefix . 'reservation_events';


			if (get_post_type(get_the_ID()) == 'sallemusculation') {
				// condition name sallemusculation
				$wpdb->insert(
					$table_name,
					array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'phone' => $phone,
						'age' => $age,
						'cours' => $cours,
						'info' => $abonement,
						'horraire' => $horraire,
					)

				);
			} elseif (get_post_type(get_the_ID()) == 'yoga') {
				// condition name yoga
				$wpdb->insert(
					$table_name,
					array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'phone' => $phone,
						'age' => $age,
						'cours' => $cours,
						'horraire' => $horraire,
						'info' => $abonement,

					)

				);
			} elseif (get_post_type(get_the_ID()) == 'coursparticuliers') {
				// condition name yoga
				$wpdb->insert(
					$table_name,
					array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'phone' => $phone,
						'age' => $age,
						'cours' => $cours,
						'horraire' => $horraire,
						'info' => $abonement,

					)

				);
			} elseif (get_post_type(get_the_ID()) == 'courscollectifs') {
				// condition name yoga
				$wpdb->insert(
					$table_name,
					array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'phone' => $phone,
						'age' => $age,
						'cours' => $cours,
						'horraire' => $horraire,
						'info' => $abonement,

					)

				);
			}





			echo "<h4>Merci! Vous êtes inscrit à ce cours.</h4>";
		}
	}

	echo "<form class='col-8 mx-auto' method='POST'>";
	echo "<h5> <strong>Inscription au:</strong> " . get_the_title() . " </h5>";
	echo "<div class='input-group mb-3'>";
	echo "<span class='input-group-text'>Prénom</span>";
	echo "<input class='form-control' type='text' name='first_name' placeholder='Prénom' required>";
	echo "</div>";
	echo "<div class='input-group mb-3'>";
	if (get_post_type(get_the_ID()) == 'yoga') {
		//if is true
		echo "<select class='form-select p-2 mb-3' aria-label='Default select example' name='horraire'>
				<option selected>Choisie ton crénaux horaire</option>
				<option value='10h à 12h'>10h à 12h</option>
				<option value='13h à 15h'>13h à 15h</option>
				<option value='16h à 18h'>16h à 18h</option>
			</select>";
	} elseif (get_post_type(get_the_ID()) == 'sallemusculation') {
		//if is true
		echo "<select class='form-select p-2 mb-3' aria-label='Default select example' name='abonement'>
					<option selected>Choisie ton abonement</option>
					<option value='9000/m'>9000 cfp / mois</option>
					<option value='110000/a'>110000 cfp / mois</option
				</select>";
	} elseif (get_post_type(get_the_ID()) == 'coursparticuliers') {
		echo "<input class='form-control'  type='text' name='place' placeholder='' value='10' required disabled>";
		echo "<span class='input-group-text'>Nombre de place</span>";
	} elseif (get_post_type(get_the_ID()) == 'courscollectifs') {
		echo "<select class='form-select p-2 mb-3' aria-label='Default select example' name='horraire'>
				<option selected>Choisie ton crénaux horaire</option>
				<option value='10h à 12h'>10h à 12h</option>
				<option value='13h à 15h'>13h à 15h</option>
				<option value='16h à 18h'>16h à 18h</option>
			</select>";
	}
	echo "<input class='form-control'  type='text' name='last_name' placeholder='Nom de famille' required>";
	echo "<span class='input-group-text'>Nom</span>";
	echo "</div>";
	echo "<div class='input-group mb-3'>";
	echo "<span class='input-group-text'>Téléphone</span>";
	echo "<input class='form-control'  type='tel' name='phone' placeholder='' required>";
	echo "</div>";
	echo "<div class='input-group mb-3'>";
	echo "<input class='form-control'  name='age' placeholder='Âge' required>";
	echo "<span class='input-group-text'>Âge</span>";
	echo "</div>";
	echo "<input class='form-control'  type='hidden' name='cours-id' value='" . get_the_title() . "' required>";
	echo "<button class='btn btn-light' type='submit' name='fabreservations' value='Envoyez'>Envoyez</button>";
	echo "</form>";

	return ob_get_clean();
}

add_shortcode('fabreservations', 'reservation_form');

function resaformPage()
{
	global $wpdb;
	ob_start();
	$table_namePost = $wpdb->prefix . 'posts';
	$eventsPoststypes = $wpdb->get_results("SELECT * FROM $table_namePost WHERE post_type = 'yoga' OR post_type = 'sallemusculation' OR post_type = 'courscollectifs' OR post_type = 'coursparticuliers'  AND post_type != 'revision'", ARRAY_A);
// var_dump($eventsPoststypes);
	if (isset($_POST['fabreservation'])) {

		$first_name = sanitize_text_field($_POST["first_name"]);
		$last_name = sanitize_text_field($_POST["last_name"]);
		$phone = sanitize_text_field($_POST["phone"]);
		$age = esc_textarea($_POST["age"]);
		$eventsName = $_POST["evenement"];
		$abonement = "A définir avec le client";
		$horraire = "A définir avec le client";

		if ($first_name != '' && $last_name != '' && $phone  != '' && $age  != '') {
			global $wpdb;
			$table_name = $wpdb->prefix . 'reservation_events';
			$wpdb->insert(
				$table_name,
				array(
					'first_name' => $first_name,
					'last_name' => $last_name,
					'phone' => $phone,
					'age' => $age,
					'cours' => $eventsName,
					'horraire' => $horraire,
					'info' => $abonement,
				)
			);

			echo "<h4>Merci! Vous êtes inscrit à ce cours nous reviendrons vers vous.</h4>";
		}
	}

	// resa all    
	echo "<form class='col-8 mx-auto' method='POST' >";
	echo "<h1 class='title text-center'>Faire une réservation pour un événement</h1>";
	echo "<div class='input-group mb-3'>";
	echo "<span class='input-group-text'>Prénom</span>";
	echo "<input class='form-control' type='text' name='first_name' placeholder='Prénom' required>";
	echo "</div>";
	echo "<div class='input-group mb-3'>";
	echo "<input class='form-control'  type='text' name='last_name' placeholder='Nom de famille' required>";
	echo "<span class='input-group-text'>Nom</span>";
	echo "</div>";
	echo "<div class='input-group mb-3'>";
	echo "<span class='input-group-text'>Télèphone</span>";
	echo "<input class='form-control'  type='tel' name='phone' placeholder='' required>";
	echo "</div>";
	echo "<span class='input-group-text'>Age</span>";
	echo "<input class='form-control' type='text' name='age' placeholder='Age' required>";
	echo "<select name='evenement' id='events-select' required>";
	echo "<option value=''>--Please choose an option--</option>";
	foreach ($eventsPoststypes as $eventsPoststype) {
		$postype = $eventsPoststype['post_title'];
		echo "<option value='$postype'>$postype</option>";
	}
	echo "</select>";
	echo "<button class='btn btn-light' type='submit' name='fabreservation' value='Envoyez'>Envoyez</button>";
	echo "</div>";
	echo "</form>";
	// var_dump(ob_get_clean());
	return ob_get_clean();
}

add_shortcode('fabreservationspage', 'resaformPage');
