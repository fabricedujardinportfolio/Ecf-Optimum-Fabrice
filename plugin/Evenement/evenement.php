<?php
/*
Plugin Name: Events
Description: Ceci est un plugin événementiel pour ECF de la CCI fait par jonathan
Author: Jonathan
Version: 1.0
*/
// Rajouter post type 'events'
// Add post type 'events'

function events_init()
{
	$args = array(
		'labels' => array(
			'name' => __('Events'),
			'singular_name' => __('Event'),
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
		'rewrite' => array("slug" => "events"),
		'supports' => array('thumbnail', 'editor', 'title')
	);

	register_post_type('events', $args);
}

add_action('init', 'events_init');

// Add meta box date to event

function add_event_date_meta_box()
{
	function event_date($post)
	{
		$date = get_post_meta($post->ID, 'event_date', true);

		if (empty($date)) $date = the_date();

		echo '<input type="date" name="event_date" value="' . $date  . '" />';
	}

	add_meta_box('event_date_meta_boxes', 'Date', 'event_date', 'events', 'side', 'default');
}

add_action('add_meta_boxes', 'add_event_date_meta_box');

// Add meta box pnumber of places for the event
function add_event_places_meta_box()
{
	function event_places($post)
	{
		$places = get_post_meta($post->ID, 'event_places', true);
		echo '<input type="date" name="event_date" value="' . $places  . '" />';
	}
	add_meta_box('event_places_meta_box', 'Nombre de places', 'event_places', 'events', 'side', 'default');
}
add_action('add_meta_boxes', 'add_event_places_meta_box');


// Update meta on event post save

function events_post_save_meta($post_id)
{
	if (isset($_POST['event_date']) && $_POST['event_date'] !== "") {
		update_post_meta($post_id, 'event_date', $_POST['event_date']);
	}
}

add_action('save_post', 'events_post_save_meta');

// Add event post type to home and main query

function add_event_post_type($query)
{
	if (is_home() && $query->is_main_query()) {
		$query->set('post_type', array('post', 'yoga'));
		return $query;
	}
}

add_action('pre_get_posts', 'add_event_post_type');

// Short code to display event date meta data

function show_event_date()
{
	ob_start();
	$date = get_post_meta(get_the_ID(), 'event_date', true);
	echo "<date>$date</date>";
	return ob_get_clean();
}

add_shortcode('show_event_date', 'show_event_date');
