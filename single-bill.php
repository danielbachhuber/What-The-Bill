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
						<h2 class="bill-summary"><?php echo get_post_meta( get_the_ID(), 'summary', true ); ?></h2>
					</header><!-- .entry-header -->

					<?php if ( is_search() ) : // Only display Excerpts for Search ?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
					<?php else : ?>
					<div class="entry-content">
						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>

						<h3>What</h3>
						<p><em>What is this bill really about?</em></p>
						<?php echo wpautop( get_post_meta( get_the_ID(), 'what', true ) ); ?>

						<h3>Who</h3>
						<p><em>What type of person will this most affect?</em></p>
						<?php if ( $who = wp_get_object_terms( get_the_ID(), 'who', array( 'fields' => 'names' ) ) ) : ?>
						<?php echo wpautop( implode( ', ', $who ) ); ?>
						<?php else: ?>
						<p>Help us out by doing some research!</p>
						<?php endif; ?>

						<h3>Where</h3>
						<p><em>Which part of Oregon will this bill impact most?</em></p>
						<?php if ( $where = wp_get_object_terms( get_the_ID(), 'where', array( 'fields' => 'names' ) ) ) : ?>
						<?php echo wpautop( implode( ', ', $where ) ); ?>
						<?php else: ?>
						<p>Help us out by doing some research!</p>
						<?php endif; ?>

						<h3>Your Reaction</h3>
						<?php get_template_part( 'reaction-buttons' ); ?>
					</div><!-- .entry-content -->
					<?php endif; ?>

				</article><!-- #post -->

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>