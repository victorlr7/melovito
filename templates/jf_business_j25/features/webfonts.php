<?php
/**
 * @package     gantry
 * @subpackage  features
 * @version		3.2.2 April 1, 2011
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
class GantryFeatureWebFonts extends GantryFeature {

    var $_feature_name = 'webfonts';

    var $_google_fonts = array("Allan", "Allerta", "Allerta Stencil", "Anonymous Pro", "Arimo", "Arvo", "Bentham", "Buda", "Cabin", "Calligraffitti", "Cantarell", "Cardo", "Cherry Cream Soda", "Chewy", "Coda", "Coming Soon", "Copse", "Corben", "Cousine", "Covered By Your Grace", "Crafty Girls", "Crimson Text", "Crushed", "Cuprum", "Droid Sans", "Droid Sans Mono", "Droid Serif", "Fontdiner Swanky", "Geo", "Gruppo", "Homemade Apple", "IM Fell", "Inconsolata", "Irish Growler", "Josefin Sans", "Josefin Slab", "Just Another Hand", "Just Me Again Down Here", "Kenia", "Kranky", "Kristi", "Lato", "Lekton", "Lobster", "Luckiest Guy", "Merriweather", "Molengo", "Mountains of Christmas", "Neucha", "Neuton", "Nobile", "OFL Sorts Mill Goudy TT", "Old Standard TT", "Orbitron", "PT Sans", "Permanent Marker", "Philosopher", "Puritan", "Raleway", "Reenie Beanie", "Rock Salt", "Schoolbell", "Slackey", "Sniglet", "Sunshiney", "Syncopate", "Tangerine", "Tinos", "Ubuntu", "UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Vibur", "Vollkorn", "Walter Turncoat", "Yanone Kaffeesatz");

    function init() {
        global $gantry;

        $font_family = $gantry->get('font-family');

        // Only Google at this point
        if ($this->get('source') == "google" && in_array($font_family,$this->_google_fonts)) {
            $gantry->addStyle('http://fonts.googleapis.com/css?family='.str_replace(" ","+",$font_family));
			$css = 'h1, h2 { font-family: "'.$font_family.'", "Helvetica", arial, serif !important; font-weight:normal; }';
			$css .= '.rt-fusionmenu { font-family: "'.$font_family.'", "Helvetica", arial, serif; }';
			$css .= '.menutop ul li > .item { font-family: "'.$font_family.'", "Helvetica", arial, serif; }';
			$css .= '.phoneNr { font-family: "'.$font_family.'", "Helvetica", arial, serif; }';
			$css .= '.tooltipTop { font-family: "'.$font_family.'", "Helvetica", arial, serif; }';
			$css .= '.slide-title {font-family: "'.$font_family.'", "Helvetica", arial, serif;}';
			$css .= '.hometitle h3 {font-family: "'.$font_family.'", "Helvetica", arial, serif;}';
			$css .= '.findoutmore a {font-family: "'.$font_family.'", "Helvetica", arial, serif;}';
			$css .= 'a.readmore {font-family: "'.$font_family.'", "Helvetica", arial, serif;}';
			$css .= '.latestPosts h4.nspHeader {font-family: "'.$font_family.'", "Helvetica", arial, serif;}';
			$css .= '.pageheader {font-family: "'.$font_family.'", "Helvetica", arial, serif;}';
			$css .= '.portfolio-menu ul.menu li a {font-family: "'.$font_family.'", "Helvetica", arial, serif;}'; 
			$css .= '#gantry-totop {font-family: "'.$font_family.'", "Helvetica", arial, serif;}';

			$css .= '';
			$css .= '';
			
			
			
			
			
            $gantry->addInlineStyle($css);
        }



    }

}