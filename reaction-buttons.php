<h3>Your Reaction</h3>
<?php
				$reactions = get_terms( 'reaction', array( 'hide_empty' => false ) );
				foreach( $reactions as $reaction ) {
					$reaction_count = (int)get_post_meta( get_the_ID(), 'reaction_' . $reaction->slug, true );
					
					$reaction_count = ' (<span class="reaction-count">'.$reaction_count . '</span>)';
?>
<button class="bill-reaction" data-post-id="<?php echo get_the_ID(); ?>" data-reaction="<?php echo esc_attr( $reaction->slug ); ?>"><?php echo esc_html( $reaction->name ); ?><?php echo $reaction_count; ?></button>
<?php
				}
?>