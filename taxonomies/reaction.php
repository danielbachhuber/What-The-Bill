<?php

function reaction_init() {
	register_taxonomy( 'reaction', array( 'bill' ), array(
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
			'name'                       =>  __( 'Reactions', 'twentytwelve' ),
			'singular_name'              =>  __( 'Reaction', 'twentytwelve' ),
			'search_items'               =>  __( 'Search reactions', 'twentytwelve' ),
			'popular_items'              =>  __( 'Popular reactions', 'twentytwelve' ),
			'all_items'                  =>  __( 'All reactions', 'twentytwelve' ),
			'parent_item'                =>  __( 'Parent reaction', 'twentytwelve' ),
			'parent_item_colon'          =>  __( 'Parent reaction:', 'twentytwelve' ),
			'edit_item'                  =>  __( 'Edit reaction', 'twentytwelve' ),
			'update_item'                =>  __( 'Update reaction', 'twentytwelve' ),
			'add_new_item'               =>  __( 'New reaction', 'twentytwelve' ),
			'new_item_name'              =>  __( 'New reaction', 'twentytwelve' ),
			'separate_items_with_commas' =>  __( 'Reactions separated by comma', 'twentytwelve' ),
			'add_or_remove_items'        =>  __( 'Add or remove reactions', 'twentytwelve' ),
			'choose_from_most_used'      =>  __( 'Choose from the most used reactions', 'twentytwelve' ),
			'menu_name'                  =>  __( 'Reactions', 'twentytwelve' ),
		),
	) );

}
add_action( 'init', 'reaction_init' );
