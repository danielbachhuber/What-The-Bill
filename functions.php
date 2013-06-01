<?php

if ( defined( 'WP_CLI' ) && WP_CLI )
	require_once dirname( __FILE__ ) . '/inc/class-what-the-bill-cli.php';

require_once dirname( __FILE__ ) . '/plugins/custom-metadata/custom_metadata.php'; 

require_once dirname( __FILE__ ) . '/post-types/bill.php';
require_once dirname( __FILE__ ) . '/taxonomies/who.php';
require_once dirname( __FILE__ ) . '/taxonomies/where.php';
require_once dirname( __FILE__ ) . '/taxonomies/reaction.php';

add_filter( 'pre_option_permalink_structure', function(){
	return '%postname%';
});

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script( 'jquery' );
});

add_action( 'wp_head', function() {
?>
<script>
jQuery(document).ready(function($) {
  $(".bill-reaction").click(function() {
		var reaction = $(this).attr("data-reaction");
		var post_id = $(this).attr("data-post-id");
		$.get("/wp-admin/admin-ajax.php", {action:'bill_reaction',post_id:post_id, reaction: reaction}, function(reply) {
			console.log(reply);
		});
	});
});
</script>
<?php
});

add_action( 'wp_ajax_bill_reaction', 'wtb_bill_reaction_ajax' );
function wtb_bill_reaction_ajax() {

	$post_id = ( isset( $_GET['post_id'] ) ) ? (int)$_GET['post_id'] : 0;
	$reaction = ( isset( $_GET['reaction'] ) ) ? sanitize_key( $_GET['reaction'] ) : '';

	if ( ! get_post( $post_id ) )
		wtb_do_json_response( 'error', 'Invalid post.' );

	$reactions = get_terms( 'reaction', array( 'hide_empty' => true ) );


	wp_get_current_user_id();



	wtb_do_json_response( 'success', $message );
	exit;
}

function wtb_do_json_response( $status, $message ) {
	echo json_encode( array( 'status' => $status, 'message' => $message ) );
	exit;
}