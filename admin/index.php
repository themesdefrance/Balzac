<?php
/**
 * The template for displaying theme options using the Cocorico Framework
 *
 * @package Balzac
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @link 		https://github.com/y-lohse/Cocorico
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; ?>

<h2 style="font-size: 23px;font-weight: 400;padding: 9px 15px 4px 0px;line-height: 29px;">
	<?php _e('Balzac Settings', 'balzac'); ?>
</h2>

<?php

// Create a new set of options
$form = new Cocorico(BALZAC_COCORICO_PREFIX);

// Registering tabs
$form->groupHeader(array('general'=>__('General', 'balzac'),
						 'addons'=>__('Addons', 'balzac')));

// General tab
$form->startWrapper('tab', 'general');

	$form->startForm();

		$form->setting(array('type'=>'text',
					 'name'=>substr(BALZAC_LICENSE_KEY, strlen(BALZAC_COCORICO_PREFIX)),
					 'label'=>__("License", 'balzac'),
					 'description'=>__("Enter your licence key in order to receive Balzac updates. You'll find it in the confirmation email we sent you after your purchase.", 'balzac')));


		$form->setting(array('type'=>'color',
					 'name'=>'color',
					 'options'=>array(
					 	'default'=>'#3ab2a0'
					 ),
					 'label'=>__("Main color", 'balzac'),
					 'description'=>__('This color will be used across your website for buttons, links, etc.', 'balzac')));

		$form->setting(array('type'=>'upload',
					 'name'=>'logo',
					 'label'=>__('Logo', 'balzac'),
					 'description'=>__("Upload a logo to display in the header (if you don't have a logo, the name of your website will be displayed instead).", 'balzac')));

		$form->setting(array('type'=>'textarea',
					 'name'=>'footer_left',
					 'label'=>__("Footer", 'balzac'),
					 'description'=>__('Left footer content. The following HTML tags are allowed : &lt;a href=&quot;LINK&quot;&gt;TEXT_LINK&lt;/a&gt;, &lt;strong&gt;BOLD_TEXT&lt;/strong&gt;, &lt;em&gt;ITALIC_TEXT&lt;/em&gt;, &lt;img src=&quot;IMAGE_URL&quot;&gt;.', 'balzac'),
					 'options'=>array(
					 	'default'=>sprintf(__('<strong>%s</strong> - Balzac by <a href="https://www.themesdefrance.fr/" target="_blank">Themes de France</a>', 'balzac'),date('Y'))
					 	)));

		$form->setting(array('type'=>'textarea',
					 'name'=>'custom_css',
					 'label'=>__('Additionnal CSS', 'balzac'),
					 'description'=>__('CSS rules added in this field will be added to your site. If you have too many updates, you should download and install the Balzac child theme from', 'balzac') . ' <a href="https://www.themesdefrance.fr/" target="_blank">' . __('your Themes de France account', 'balzac') . '</a>.'));

	$form->endForm();

$form->endWrapper('tab');

// Addons tab
$form->startWrapper('tab', 'addons');

	$form->startForm();

		$form->startWrapper('td');

			$form->component('raw', __('Do you know that Balzac can be extended with addons ? Check the addons available below :', 'balzac'));

		$form->endWrapper('td');

	$form->endForm();

	$form->startForm();

		// Action to hook from addons
		do_action('balzac_addons_tab', $form);

	$form->endForm();

$form->endWrapper('tab');

$form->component('submit', 'submit', array('value'=>__('Save changes', 'balzac')));

$form->render();

?>

<div style="margin-top:20px;">
	<?php
		_e('Any questions on Balzac ? Go to the','balzac'); ?> <a href="https://www.themesdefrance.fr/support/?utm_source=theme&utm_medium=supportlink&utm_campaign=balzac" target="_blank"><?php _e('Themes de France support page.','balzac'); ?></a>
	<?php
		 _e('If you like Balzac, you should','balzac'); ?> <a href="https://www.facebook.com/ThemesDeFrance" target="_blank"><?php _e('follow us on Facebook','balzac'); ?></a>.

</div>