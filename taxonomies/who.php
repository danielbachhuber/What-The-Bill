<?php

function who_init() {
	register_taxonomy( 'who', array( 'bill' ), array(
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
			'name'                       =>  __( 'Whos', 'twentytwelve' ),
			'singular_name'              =>  __( 'Who', 'twentytwelve' ),
			'search_items'               =>  __( 'Search whos', 'twentytwelve' ),
			'popular_items'              =>  __( 'Popular whos', 'twentytwelve' ),
			'all_items'                  =>  __( 'All whos', 'twentytwelve' ),
			'parent_item'                =>  __( 'Parent who', 'twentytwelve' ),
			'parent_item_colon'          =>  __( 'Parent who:', 'twentytwelve' ),
			'edit_item'                  =>  __( 'Edit who', 'twentytwelve' ),
			'update_item'                =>  __( 'Update who', 'twentytwelve' ),
			'add_new_item'               =>  __( 'New who', 'twentytwelve' ),
			'new_item_name'              =>  __( 'New who', 'twentytwelve' ),
			'separate_items_with_commas' =>  __( 'Whos separated by comma', 'twentytwelve' ),
			'add_or_remove_items'        =>  __( 'Add or remove whos', 'twentytwelve' ),
			'choose_from_most_used'      =>  __( 'Choose from the most used whos', 'twentytwelve' ),
			'menu_name'                  =>  __( 'Whos', 'twentytwelve' ),
		),
	) );

}
add_action( 'init', 'who_init' );
