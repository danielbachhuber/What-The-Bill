<?php

if ( defined( 'WP_CLI' ) && WP_CLI )
	require_once dirname( __FILE__ ) . '/inc/class-what-the-bill-cli.php';

global $content_width;
$content_width = 600;

require_once dirname( __FILE__ ) . '/plugins/custom-metadata/custom_metadata.php'; 

require_once dirname( __FILE__ ) . '/post-types/bill.php';
require_once dirname( __FILE__ ) . '/taxonomies/who.php';
require_once dirname( __FILE__ ) . '/taxonomies/where.php';
require_once dirname( __FILE__ ) . '/taxonomies/reaction.php';

add_filter( 'pre_option_permalink_structure', function(){
	return '%postname%';
});

add_action( 'pre_get_posts', function( $query ) {

	if ( ! $query->is_home() || ! $query->is_main_query() )
		return;

	$query->set( 'post_type', 'bill' );
	$query->set( 'orderby', 'rand' );

});

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script( 'jquery' );
});

add_action( 'wp_head', function() {
?>
<style>
#page {
	width: 600px;
}
.site-content {
	float:none;
	width: 100%;
}
.edit-link {
	display: none;
}
.single-bill h2.bill-summary {
	margin-top: 10px;
	line-height: 1.3em;
}
.single-bill .entry-content h3 {
	margin-bottom: 5px;
}
.single-bill .site-content article {
	border-bottom:none;
}
#secondary, .entry-meta, .comments-link {
	display: none;
}
button.bill-reaction {
	font-size: 1.3em;
	background-color: #EFEFEF;
}
</style>
<?php
});

add_action( 'admin_head', function() {
?>
<style>
	.custom-metadata-field textarea {
		width: 90%;
		min-height: 60px;
	}
</style>
<?php
});

add_filter( 'the_content', function( $content ){

	if ( ! is_home() )
		return $content;

	ob_start(); ?>
	<h2 class="bill-summary"><?php echo get_post_meta( get_the_ID(), 'summary', true ); ?></h2>

	<p><a href="<?php echo the_permalink(); ?>">Learn More</a></p>

	<?php get_template_part( 'reaction-buttons' ); ?>

	<?php return $content . ob_get_clean();	
});

add_action( 'wp_head', function() {
?>
<script>
jQuery(document).ready(function($) {
  $(".bill-reaction").click(function() {
  		var button = $(this);
		var reaction = $(this).attr("data-reaction");
		var post_id = $(this).attr("data-post-id");
		$.get("/wp-admin/admin-ajax.php", {action:'bill_reaction',post_id:post_id, reaction: reaction}, function(response) {
			if ( response.status == 'success' ) {
				button.find('.reaction-count').html( response.message );
			}
		});
	});
});
</script>
<?php
});

add_action( 'wp_ajax_nopriv_bill_reaction', 'wtb_bill_reaction_ajax' );
add_action( 'wp_ajax_bill_reaction', 'wtb_bill_reaction_ajax' );
function wtb_bill_reaction_ajax() {

	$post_id = ( isset( $_GET['post_id'] ) ) ? (int)$_GET['post_id'] : 0;
	$reaction = ( isset( $_GET['reaction'] ) ) ? sanitize_key( $_GET['reaction'] ) : '';

	if ( ! get_post( $post_id ) )
		wtb_do_json_response( 'error', 'Invalid post.' );

	$reaction_key = 'reaction_' . $reaction;
	$reactions = (int)get_post_meta( $post_id, $reaction_key, true );
	$reactions++;
	update_post_meta( $post_id, $reaction_key, $reactions );

	wtb_do_json_response( 'success', $reactions );
	exit;
}

function wtb_do_json_response( $status, $message ) {
	header( "Content-type:application/json;" );
	echo json_encode( array( 'status' => $status, 'message' => $message ) );
	exit;
}