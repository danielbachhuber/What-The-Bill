<?php

function where_init() {
	register_taxonomy( 'where', array( 'bill' ), array(
		'hierarchical'            => false,
		'public'                  => true,
		'show_in_nav_menus'       => true,
		'show_ui'                 => true,
		'query_var'               => true,
		'rewrite'                 => true,
		'capabilities'            => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		),
		'labels'                  => array(
			'name'                       =>  __( 'Wheres', 'twentytwelve' ),
			'singular_name'              =>  __( 'Where', 'twentytwelve' ),
			'search_items'               =>  __( 'Search wheres', 'twentytwelve' ),
			'popular_items'              =>  __( 'Popular wheres', 'twentytwelve' ),
			'all_items'                  =>  __( 'All wheres', 'twentytwelve' ),
			'parent_item'                =>  __( 'Parent where', 'twentytwelve' ),
			'parent_item_colon'          =>  __( 'Parent where:', 'twentytwelve' ),
			'edit_item'                  =>  __( 'Edit where', 'twentytwelve' ),
			'update_item'                =>  __( 'Update where', 'twentytwelve' ),
			'add_new_item'               =>  __( 'New where', 'twentytwelve' ),
			'new_item_name'              =>  __( 'New where', 'twentytwelve' ),
			'separate_items_with_commas' =>  __( 'Wheres separated by comma', 'twentytwelve' ),
			'add_or_remove_items'        =>  __( 'Add or remove wheres', 'twentytwelve' ),
			'choose_from_most_used'      =>  __( 'Choose from the most used wheres', 'twentytwelve' ),
			'menu_name'                  =>  __( 'Wheres', 'twentytwelve' ),
		),
	) );

}
add_action( 'init', 'where_init' );
