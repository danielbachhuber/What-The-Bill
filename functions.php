<?php

if ( defined( 'WP_CLI' ) && WP_CLI )
	require_once dirname( __FILE__ ) . '/inc/class-what-the-bill-cli.php';

require_once dirname( __FILE__ ) . '/plugins/custom-metadata/custom_metadata.php'; 

require_once dirname( __FILE__ ) . '/post-types/bill.php';

add_filter( 'pre_option_permalink_structure', function(){
	return '%postname%';
});