<?php
/**
 * The template used for displaying page content
 *
 * @package Balzac
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php do_action('balzac_before_page'); ?>

<article id="page-<?php the_ID(); ?>" <?php post_class('page'); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
	
	<?php do_action('balzac_top_page'); ?>
	
	<?php if (has_post_thumbnail() && !post_password_required()): ?>

		<div class="entry-thumbnail" style='background-image: url(<?php echo balzac_get_post_thumbnail_url(); ?>)'>

			<?php //the_post_thumbnail(); ?>

		</div><!--END .entry-thumbnail-->

	<?php endif; ?>
	
	<div class="wrapper">
	
		<header class="entry-header" >
			
			<?php do_action('balzac_top_header_page'); ?>
				
				<h1 class="entry-title" itemprop="headline">

					<?php the_title(); ?>

				</h1><!--END .entry-title-->
				
			<?php do_action('balzac_bottom_header_page'); ?>
			
		</header><!--END .entry-header-->
		
		<?php do_action('balzac_before_content'); ?>
		
		<div class="entry-content" itemprop="articleBody">
			
			<?php do_action('balzac_top_content'); ?>
			
			<?php the_content(); ?>
			
			<?php do_action('balzac_bottom_content'); ?>
	
		</div><!--END .entry-content-->
		
		<?php do_action('balzac_after_content'); ?>
	
	</div>
	
	<?php do_action('balzac_bottom_page'); ?>
	
</article><!--END .page -->

<?php do_action('balzac_after_post'); ?>