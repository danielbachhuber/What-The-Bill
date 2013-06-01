<?php

function bill_init() {
	register_post_type( 'bill', array(
		'hierarchical'        => false,
		'public'              => true,
		'show_in_nav_menus'   => true,
		'show_ui'             => true,
		'supports'            => array( 'title', 'editor' ),
		'has_archive'         => true,
		'query_var'           => true,
		'rewrite'             => true,
		'labels'              => array(
			'name'                => __( 'Bills', 'twentytwelve' ),
			'singular_name'       => __( 'Bill', 'twentytwelve' ),
			'add_new'             => __( 'Add new Bill', 'twentytwelve' ),
			'all_items'           => __( 'Bills', 'twentytwelve' ),
			'add_new_item'        => __( 'Add new Bill', 'twentytwelve' ),
			'edit_item'           => __( 'Edit Bill', 'twentytwelve' ),
			'new_item'            => __( 'New Bill', 'twentytwelve' ),
			'view_item'           => __( 'View Bill', 'twentytwelve' ),
			'search_items'        => __( 'Search Bills', 'twentytwelve' ),
			'not_found'           => __( 'No Bills found', 'twentytwelve' ),
			'not_found_in_trash'  => __( 'No Bills found in trash', 'twentytwelve' ),
			'parent_item_colon'   => __( 'Parent Bill', 'twentytwelve' ),
			'menu_name'           => __( 'Bills', 'twentytwelve' ),
		),
	) );

}
add_action( 'init', 'bill_init' );

function bill_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['bill'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Bill updated. <a target="_blank" href="%s">View Bill</a>', 'twentytwelve'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'twentytwelve'),
		3 => __('Custom field deleted.', 'twentytwelve'),
		4 => __('Bill updated.', 'twentytwelve'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Bill restored to revision from %s', 'twentytwelve'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Bill published. <a href="%s">View Bill</a>', 'twentytwelve'), esc_url( $permalink ) ),
		7 => __('Bill saved.', 'twentytwelve'),
		8 => sprintf( __('Bill submitted. <a target="_blank" href="%s">Preview Bill</a>', 'twentytwelve'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Bill scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Bill</a>', 'twentytwelve'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Bill draft updated. <a target="_blank" href="%s">Preview Bill</a>', 'twentytwelve'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'bill_updated_messages' );
