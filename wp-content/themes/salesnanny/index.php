<?php
/**
 * Fallback template for WordPress-managed content (pages / posts that are not
 * part of the Mahathi route table). Rendered inside the regular site chrome.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main class="mh-content container py-5" style="min-height: 50vh;">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
		<?php endwhile; ?>
	<?php endif; ?>
</main>
<?php
get_footer();
