<?php
/**
 * The template for displaying video post formats
 *
 * @package Balzac
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php $video_link = get_post_meta($post->ID, '_balzac_video_meta', true); ?>

<?php do_action('balzac_before_post'); ?>

<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">

	<?php do_action('balzac_top_post'); ?>

		<div class="wrapper-media">

			<div class="entry-video">

				<?php echo wp_oembed_get(esc_url($video_link)); ?>

			</div><!--END .entry-video-->

		</div><!-- END .wrapper -->

		<div class="wrapper">

			<header class="entry-header">

			<?php do_action('balzac_top_header_post'); ?>

			<?php if (is_single()): ?>

				<h1 class="entry-title"><?php the_title(); ?></h1>

			<?php else: ?>

				<h2 class="entry-title">

					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url">

						<?php the_title(); ?>

					</a>

				</h2><!--END .entry-title-->

			<?php endif; ?>

			<?php get_template_part('content', 'header'); ?>

			<?php do_action('balzac_bottom_header_post'); ?>

		</header><!-- END .entry-header -->

		<?php get_template_part('content', 'body'); ?>

		<?php get_template_part('content', 'footer'); ?>

		<?php do_action('balzac_bottom_post'); ?>

	</div><!-- END .wrapper -->

</article><!-- END .post -->

<?php do_action('balzac_after_post'); ?>