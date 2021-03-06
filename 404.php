<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Balzac
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php get_header(); ?>

<?php do_action('balzac_before_main'); ?>

<section class="content">

		<?php do_action('balzac_top_main'); ?>

		<main class="main-content col-1-1" role="main" itemprop="mainContentOfPage">

			<?php do_action('balzac_before_post'); ?>

			<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">

				<?php do_action('balzac_top_post'); ?>

				<header class="entry-header">

					<?php do_action('balzac_top_header_post'); ?>

					<h1 class="entry-title" itemprop="headline">

						<?php _e('Oops, there is nothing here...', 'balzac'); ?>

					</h1><!--END .entry-title-->

					<?php do_action('balzac_bottom_header_post'); ?>

				</header><!--END .entry-header-->

				<div class="wrapper">

				<?php do_action('balzac_before_content'); ?>

				<div class="entry-content" itemprop="articleBody">

					<?php do_action('balzac_top_content'); ?>

					<p>
						<?php printf(__("The page you requested does not seem to exist. You can go back to <a href=\"%s\">the home page</a> or browse the archives :", 'balzac'), home_url()); ?>
					</p>

					<ul class="balzac-archives">

						<?php echo balzac_archives(); ?>

					</ul>

					<?php do_action('balzac_bottom_content'); ?>

				</div><!--END .entry-content-->

				<?php do_action('balzac_after_content'); ?>

				<?php do_action('balzac_bottom_post'); ?>

				</div><!-- END .wrapper -->

			</article><!-- END .post -->

			<?php do_action('balzac_after_post'); ?>

		</main><!-- END .main-content -->

		<?php do_action('balzac_bottom_main'); ?>

</section><!-- END .content -->

<?php do_action('balzac_after_main'); ?>

<?php get_footer(); ?>