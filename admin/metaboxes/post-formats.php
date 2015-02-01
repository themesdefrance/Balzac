<?php
/**
 * Balzac post formats metaboxes registering
 *
 * @package Balzac
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Register post formats metaboxes
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('balzac_add_meta_boxes')){
	function balzac_add_meta_boxes(){
		add_meta_box(
					'balzac_link',
					__('Link', 'balzac'),
					'balzac_link_callback',
					 'post',
					 'normal',
					 'high'
					 );
					 
		add_meta_box(
					'balzac_quote',
					__('Quote', 'balzac'),
					'balzac_quote_callback',
					 'post',
					 'normal',
					 'high'
					 );
		
		add_meta_box(
					'balzac_video',
					__('Video', 'balzac'),
					'balzac_video_callback',
					 'post',
					 'normal',
					 'high'
					 );
	}
}
add_action('admin_init', 'balzac_add_meta_boxes');


/**
 * Link format callback functtion using the Cocorico Framework
 *
 * @link 		https://github.com/y-lohse/Cocorico
 * @since 1.0
 * @return void
 */
if(!function_exists('balzac_link_callback')){
	function balzac_link_callback( $post ) {
	
		$form = new Cocorico(BALZAC_COCORICO_PREFIX, false);
		$form->startForm();
		
		$form->setting(array('type'=>'url',
						 'name'=>'_link_meta',
						 'label'=>__('Link to feature', 'balzac'),
						 'description' => __('Add a link to feature for this post. You\'re free to talk about it in the post content.','balzac')
						 )
					  );
		
		$form->endForm();
		$form->render();
	}
}

/**
 * Quote format callback functtion using the Cocorico Framework
 *
 * @link 		https://github.com/y-lohse/Cocorico
 * @since 1.0
 * @return void
 */
if(!function_exists('balzac_quote_callback')){
	function balzac_quote_callback( $post ) {
		
		$form = new Cocorico(BALZAC_COCORICO_PREFIX, false);
		$form->startForm();
		
		$form->setting(array('type'=>'text',
						 'name'=>'_quote_meta',
						 'label'=>__('Quote to feature', 'balzac'),
						 'description' => __('Add some wise words and talk about it in the post content.','balzac')
						 )
					  );
		
		$form->setting(array('type'=>'text',
						 'name'=>'_quote_author_meta',
						 'label'=>__('Quote author (optional)', 'balzac'),
						 'description' => __('Be nice and don\'t forget to credit the quote author.','balzac')
						 )
					  );
		
		$form->endForm();
		$form->render();
		
	}
}

/**
 * Video format callback functtion using the Cocorico Framework
 *
 * @link 		https://github.com/y-lohse/Cocorico
 * @since 1.0
 * @return void
 */
if(!function_exists('balzac_video_callback')){
	function balzac_video_callback( $post ) {
	
		$form = new Cocorico(BALZAC_COCORICO_PREFIX, false);
		$form->startForm();
		
		$form->setting(array('type'=>'url',
						 'name'=>'_video_meta',
						 'label'=>__('Video to feature', 'balzac'),
						 'description' => __('Add a video link from Youtube, Dailymotion or Vimeo.','balzac')
						 )
					  );
		
		$form->endForm();
		$form->render();
	}
}

/**
 * Show the right metabox for each post format
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('balzac_display_metaboxes')){
	function balzac_display_metaboxes() {
	
	    if ( get_post_type() == "post" ){ ?>
	    
	        <script>
	            jQuery(document).ready(function($) {
	            
		            // Set variables
		            var link_radio = $('#post-format-link'),
		            	quote_radio = $('#post-format-quote'),
		            	video_radio = $('#post-format-video'),
		            	link_metabox = $('#balzac_link'),
		            	quote_metabox = $('#balzac_quote'),
		            	video_metabox = $('#balzac_video'),
		            	all_formats = $('#post-formats-select input');
			            
		            hideAllMetaBoxes();
		            
		            all_formats.change( function() {
					    
				        hideAllMetaBoxes();
				
				        if( $(this).val() == 'link' ) {
							link_metabox.show();
						}
						else if( $(this).val() == 'quote' ) {
						    quote_metabox.show();
						} 
						else if( $(this).val() == 'video' ) {
							video_metabox.show();
						} 
				
					});
				
				    if(link_radio.is(':checked'))
				        link_metabox.show();
				
				    if(quote_radio.is(':checked'))
				        quote_metabox.show();
				        
				    if(video_radio.is(':checked'))
						video_metabox.show();
		            
		            
		            function hideAllMetaBoxes(){
			            link_metabox.hide();
			            quote_metabox.hide();
			            video_metabox.hide();
		            }
	            });
	        </script>
	        
	<?php
		}
	}
}
// Add inline js in admin
add_action( 'admin_print_scripts', 'balzac_display_metaboxes',1000);