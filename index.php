<?php
/**
 * The main template file
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

			<?php

				if(have_posts()) :

					while (have_posts()) : the_post();

						get_template_part('content', get_post_format());

					endwhile;

				else:

						get_template_part('content', 'none');

				endif;
			?>

			<?php balzac_posts_nav(true, '', '<div class="pagination">', '</div>'); ?>

		</main><!-- END .main-content -->

	<?php do_action('balzac_bottom_main'); ?>

</section><!-- END .content -->

<?php do_action('balzac_after_main'); ?>

<?php get_footer(); ?>