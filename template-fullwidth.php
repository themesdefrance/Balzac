<?php
/**
 * The template for displaying pages without sidebar
 *
 * @package Balzac
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php
/*
Template Name: Fullwidth
*/
__('Fullwidth','balzac');
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php get_header(); ?>

<?php do_action('balzac_before_main'); ?>

<section class="content">

	<?php do_action('balzac_top_main'); ?>

	<main class="main-content col-1-1" role="main" itemprop="mainContentOfPage">

		<?php

			if(have_posts()) :

				while (have_posts()) : the_post();

					get_template_part('content','page');

					endwhile;

			else:

				get_template_part('content', 'none');

			endif;
		?>

	</main>

	<?php balzac_posts_nav(false, '', '<div class="pagination">', '</div>'); ?>

	<?php do_action('balzac_bottom_main'); ?>

</section> <!-- END .content -->

<?php do_action('balzac_after_main'); ?>

<?php get_footer(); ?>