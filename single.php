<?php
/**
 * The template for displaying all single posts and attachments
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

		<main class="main-content  col-1-1" role="main" itemprop="mainContentOfPage">

			<?php

				while (have_posts()) : the_post();

					get_template_part('content', get_post_format());

					balzac_single_post_nav();

					comments_template();

				endwhile;
			?>

		</main><!-- END .main-content -->

		<?php do_action('balzac_bottom_main'); ?>

</section><!-- END .content -->

<?php do_action('balzac_after_main'); ?>

<?php get_footer(); ?>