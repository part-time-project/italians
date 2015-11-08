<?php

/**
 * Template Name: Test
 */

get_header(); ?>

<body class="home page page-id-4 page-parent page-template-default logged-in admin-bar masthead-fixed full-width grid customize-support">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
</body>
<?php get_footer(); ?>
