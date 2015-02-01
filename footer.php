<?php
/**
 * The template for displaying the footer
 *
 * @package Balzac
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

			<section class="footer-wrapper">
					
				<div class="wrapper">
				
					<div class="footer-bar">
						
						<?php dynamic_sidebar('footer'); ?>
			
					</div><!-- END .footerbar -->
					
				</div><!-- END .wrapper -->
				
				<footer class="site-footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
					
					<div class="wrapper">
							
						<div class="footnote col-1-2">
							
							<?php
								if(get_option("balzac_footer_left")):
								
									echo strip_tags(get_option("balzac_footer_left"), '<strong><a><em><img>');
									
								else:
									printf(__('<strong>%s</strong> - Balzac by <a href="https://www.themesdefrance.fr/" target="_blank">Themes de France</a>', 'balzac'),date('Y'));
								endif;
							 ?>
						</div><!-- END .footnote .col-1-2 -->
						
						<div class="menu col-1-2">
							<?php
								wp_nav_menu(array(
									'theme_location' => 'footer',
									'menu_class'     => 'top-level-menu',
									'container'      => false,
									'depth'          => 1,
									'fallback_cb'    => ''
								));
							?>
						</div><!-- END .menu .col-1-2 -->
					
					</div><!-- END .wrapper -->
					
				</footer>
				
				<button id="back-to-top" title="<?php _e('Back to the top', 'balzac'); ?>" class="back-to-top typcn typcn-arrow-up-thick"></button>
			
			</section> <!-- END .footer-wrapper -->
		
	</div> <!-- END .site-wrapper -->
	
	<?php wp_footer(); ?>
	
</body>
</html>