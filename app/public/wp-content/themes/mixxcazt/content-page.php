<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to mixxcazt_page action
	 *
	 * @see mixxcazt_page_header          - 10
	 * @see mixxcazt_page_content         - 20
	 *
	 */
	do_action( 'mixxcazt_page' );
	?>
</article><!-- #post-## -->
