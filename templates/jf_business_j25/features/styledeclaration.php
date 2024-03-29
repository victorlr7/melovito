<?php
/**
 * @package     gantry
 * @subpackage  features
 * @version		3.2.7 July 15, 2011
 * @author		RocketTheme http://www.rockettheme.com
 * @copyright 	Copyright (C) 2007 - 2011 RocketTheme, LLC
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

/**
 * @package     gantry
 * @subpackage  features
 */
class GantryFeatureStyleDeclaration extends GantryFeature {
    var $_feature_name = 'styledeclaration';

    function isEnabled() {
        global $gantry;
        $menu_enabled = $this->get('enabled');

        if (1 == (int)$menu_enabled) return true;
        return false;
    }

	function init() {
        global $gantry;

        //inline css for dynamic stuff
        $css  = 'body {background:'.$gantry->get('bgcolor').';}';
        $css .= 'body a {color:'.$gantry->get('linkcolor').';}';
        $css .= '#rt-bottom .rt-container {background:'.$gantry->get('bottomcolor').';}';
        $css .= '#rt-footer .rt-container, #rt-copyright .rt-container, #rt-menu .rt-container {background:'.$gantry->get('footercolor').';}';
        /* -- START -- */
        $css .= '#rt-header {background:'.$gantry->get('headercolor').';}';
        $css .= '#rt-showcase {background:'.$gantry->get('showcasecolor').';}';
        $css .= '#rt-showcase {border-top:1px solid '.$gantry->get('showcasetopbordercolor').';}';
        $css .= '#rt-feature {background-color:'.$gantry->get('featurecolor').';}';
		/* -- END -- */
        
        $gantry->addInlineStyle($css);

        //style stuff
        $gantry->addStyle($gantry->get('cssstyle').".css");
	}

}