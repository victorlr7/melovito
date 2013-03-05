<?php
/**
 * @package   Modulus Template - RocketTheme
 * @version   1.6.0 June 1, 2011
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2011 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeaturePopup extends GantryFeature {
    var $_feature_name = 'popup';

	function render($position="") {
	    ob_start();
	    $user =& JFactory::getUser();
	    ?>
	    <div class="rt-block popupbutton-block">
			<div id="rt-popupmodule-button">
			<a id="jf-search" href="#" class="jf-tooltip" rel="rokbox[<?php echo $this->get('width'); ?> <?php echo $this->get('height'); ?>][module=rt-popup]" title="Click to Search"></a>
			</div>
		</div>
		<?php
	    return ob_get_clean();
	}
}