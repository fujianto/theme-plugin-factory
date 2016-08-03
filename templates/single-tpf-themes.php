<?php get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?>>

	<div class="row">
		<div class="content-wrapper clearfix">

			<?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>

			<div class="entry-wrapper content-area">

				<?php if ( have_posts() ) : // Checks if any posts were found. ?>

					<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

						<?php the_post(); // Loads the post data. ?>
							
						<h1>FROM PLUGIN</h1>
						<?php the_title(); ?>

					<?php endwhile; // End found posts loop. ?>
					
					<!-- Pagination for older / newer post -->

					<?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>
			
				<?php else : // If no posts were found. ?>

					<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>

				<?php endif; // End check for posts. ?>
			</div>

		</div>
		<!-- / .content-wrapper -->
	</div>
</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>