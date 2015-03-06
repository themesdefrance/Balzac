<?php
/**
 * The template for displaying the footer
 *
 * @package Balzac
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; ?>

			<section class="footer-wrapper">

				<footer class="site-footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

					<div class="wrapper">

						<div class="footnote">

							<?php
								if(get_option("balzac_footer_left")):

									echo strip_tags(get_option("balzac_footer_left"), '<strong><a><em><img>');

								else:
									printf(__('<strong>%s</strong> - Balzac by <a href="https://www.themesdefrance.fr/" target="_blank">Themes de France</a>', 'balzac'),date('Y'));
								endif;
							 ?>
						</div><!-- END .footnote -->

						<div class="footmenu">
							<?php
								wp_nav_menu(array(
									'theme_location' => 'footer',
									'menu_class'     => 'footer-menu',
									'container'      => false,
									'depth'          => 1,
									'fallback_cb'    => ''
								));
							?>
						</div><!-- END .menu -->

					</div><!-- END .wrapper -->

				</footer>

				<button id="back-to-top" title="<?php _e('Back to the top', 'balzac'); ?>" class="back-to-top typcn typcn-chevron-right"></button>

			</section> <!-- END .footer-wrapper -->
		
	</div> <!-- END .page-wrapper -->

	<?php get_sidebar(); ?>
	
	<?php wp_footer(); ?>

</body>
</html>