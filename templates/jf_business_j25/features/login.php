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

class GantryFeatureLogin extends GantryFeature {
    var $_feature_name = 'login';

	function render($position="") {
	    ob_start();
	    $user =& JFactory::getUser();
	    ?>
	    <div class="rt-block loginbutton-block">
			<div id="rt-login-button">
			<?php if ($user->guest) : ?>
				<a id="jf-login" href="#" class="jf-tooltip" rel="rokbox[305 160][module=rt-popuplogin]" title="Login / Register"></a>
			<?php else : ?>
				<a id="jf-logout" href="#" class="jf-tooltip" rel="rokbox[305 160][module=rt-popuplogin]" title="Logout"></a>
			<?php endif; ?>
			</div>
		</div>
		<?php
	    return ob_get_clean();
	}
}