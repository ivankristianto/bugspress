<?php

function ticket_init() {
	register_post_type( 'ticket', array(
		'labels'            => array(
			'name'                => __( 'Ticket', 'bugspress' ),
			'singular_name'       => __( 'Ticket', 'bugspress' ),
			'all_items'           => __( 'All Ticket', 'bugspress' ),
			'new_item'            => __( 'New Ticket', 'bugspress' ),
			'add_new'             => __( 'Add New', 'bugspress' ),
			'add_new_item'        => __( 'Add New Ticket', 'bugspress' ),
			'edit_item'           => __( 'Edit Ticket', 'bugspress' ),
			'view_item'           => __( 'View Ticket', 'bugspress' ),
			'search_items'        => __( 'Search Ticket', 'bugspress' ),
			'not_found'           => __( 'No Ticket found', 'bugspress' ),
			'not_found_in_trash'  => __( 'No Ticket found in trash', 'bugspress' ),
			'parent_item_colon'   => __( 'Parent Ticket', 'bugspress' ),
			'menu_name'           => __( 'Ticket', 'bugspress' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'author', 'thumbnail', 'editor', 'excerpt' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-admin-post',
		'show_in_rest'      => true,
		'rest_base'         => 'ticket',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'ticket_init' );

function ticket_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['ticket'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Ticket updated. <a target="_blank" href="%s">View Ticket</a>', 'bugspress'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'bugspress'),
		3 => __('Custom field deleted.', 'bugspress'),
		4 => __('Ticket updated.', 'bugspress'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Ticket restored to revision from %s', 'bugspress'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Ticket published. <a href="%s">View Ticket</a>', 'bugspress'), esc_url( $permalink ) ),
		7 => __('Ticket saved.', 'bugspress'),
		8 => sprintf( __('Ticket submitted. <a target="_blank" href="%s">Preview Ticket</a>', 'bugspress'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Ticket scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Ticket</a>', 'bugspress'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Ticket draft updated. <a target="_blank" href="%s">Preview Ticket</a>', 'bugspress'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'ticket_updated_messages' );
