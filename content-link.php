<?php
/**
 * The template for displaying link post formats
 *
 * @package Balzac
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php $link = esc_url(get_post_meta($post->ID, '_balzac_link_meta', true)); ?>

<?php do_action('balzac_before_post'); ?>

<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">

	<?php do_action('balzac_top_post'); ?>

	<div class="entry-link">

		<?php if (is_single()): ?>

			<h1 class="entry-title">

				<a href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>" rel="external" target="_blank">

					<?php echo $link; ?>

				</a>

			</h1><!--END .entry-title-->

		<?php else: ?>

			<h2 class="entry-title">

				<a href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>" rel="external" target="_blank">

					<?php echo $link; ?>

				</a>

			</h2><!--END .entry-title-->

		<?php endif; ?>

	</div><!--END .entry-link-->

	<div class="wrapper">

		<header class="entry-header">

			<?php do_action('balzac_top_header_post'); ?>

			<?php get_template_part('content', 'header'); ?>

			<?php do_action('balzac_bottom_header_post'); ?>

		</header>

		<?php get_template_part('content', 'body'); ?>

		<?php get_template_part('content', 'footer'); ?>

		<?php do_action('balzac_bottom_post'); ?>

	</div><!-- END .wrapper -->

</article><!-- END .post -->

<?php do_action('balzac_after_post'); ?>