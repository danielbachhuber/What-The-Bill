<?php get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">
						<?php the_post_thumbnail(); ?>
						<?php if ( is_single() ) : ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php else : ?>
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h1>
						<?php endif; // is_single() ?>
					</header><!-- .entry-header -->

					<?php if ( is_search() ) : // Only display Excerpts for Search ?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
					<?php else : ?>
					<div class="entry-content">
						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
						<?php echo wpautop( get_post_meta( get_the_ID(), 'summary', true ) ); ?>
					</div><!-- .entry-content -->
					<?php endif; ?>

				</article><!-- #post -->

				<footer>
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
				</footer>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>