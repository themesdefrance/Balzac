<?php
/**
 * The template for displaying the main content or excerpt
 *
 * @package Balzac
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php do_action('balzac_before_content'); ?>

<div class="entry-content" itemprop="articleBody">

	<?php do_action('balzac_top_content'); ?>

	<?php if (is_single()):
			
			// Display an excerpt on comments page
			if(get_query_var( 'cpage' ) > 0):
				echo balzac_excerpt(50);
			else:
				the_content();
			endif;
		
		elseif(is_category() || is_tax() || is_search()):
	
			echo balzac_excerpt(25);
	
			?>
	
			<p class="readmore">
	
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url"><?php _e('Read more','balzac'); ?></a>
	
			</p>
	
		<?php
	
		elseif(is_tag()):
			// No excerpt for tags archives
			echo balzac_excerpt(0);
	
		else:
	
			echo balzac_excerpt(40);
	
			?>
	
			<p class="readmore">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url"><?php _e('Read more','balzac'); ?></a>
			</p>
	
			<?php
	
		endif; ?>

	<?php do_action('balzac_bottom_content'); ?>

</div><!--END .entry-content -->

<?php do_action('balzac_after_content'); ?>