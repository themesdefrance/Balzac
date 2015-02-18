<?php
/**
 * The template for displaying the header bar (between the header and the main content)
 *
 * @package Balzac
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php do_action('balzac_before_header_archive'); ?>

<div class="header-archive">
	
	<div class="wrapper">
		
		<?php do_action('balzac_top_header_archive'); ?>
		
		<?php if(is_category()){ ?>
		
			<h1 class="archive-title" itemprop="headline">
				<?php single_cat_title(_e('Posts from ', 'balzac')); ?>
			</h1>
		
		<?php }else if(is_tag()){ ?>
		
			<h1 class="archive-title" itemprop="headline">
				<?php single_tag_title(_e('Posts tagged by ', 'balzac')); ?>
			</h1>
			
		<?php }else if(is_search()){ ?>
		
			<h1 class="archive-title" itemprop="headline">
				<?php printf( __( 'Search results for : %s', 'balzac' ), get_search_query() ); ?>
			</h1>
		
		<?php }else if(is_author()){ ?>
	
			<?php $author = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
			
			<h1 class="archive-title" itemprop="headline">
				<?php printf( __( 'Posts from %s', 'balzac' ), $author->display_name ); ?>
			</h1>
			
		
		<?php }else if(is_archive()){ ?>
			<h1 class="archive-title" itemprop="headline">
				<?php if (is_day()) { 
						_e('Archives from ', 'balzac');
						the_time(get_option('date_format'));
					}
					elseif(is_month()){
						_e('Archives for ', 'balzac');
						the_time('F Y');
					}
					elseif(is_year()){
						_e('Archives for ', 'balzac');
						the_time('Y');
					}
					else{
						_e('Archives', 'balzac');
					}
					?>
			
			</h1>
		
		<?php } ?>
	
		<?php do_action('balzac_bottom_header_archive'); ?>
	
	</div><!--END .wrapper-->

</div><!--END .header-archive-->

<?php do_action('balzac_after_header_archive'); ?>