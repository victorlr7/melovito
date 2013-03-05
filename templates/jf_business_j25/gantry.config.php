<?php
/**
 * @package 	Gantry Template Framework - RocketTheme
 * @version 	3.2.7 July 18, 2011
 * @author 		RocketTheme http://www.rockettheme.com
 * @copyright	Copyright (C) 2007 - 2011 RocketTheme, LLC
 * @license 	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

$gantry_config_mapping = array(
    'belatedPNG' => 'belatedPNG',
	'ie6Warning' => 'ie6Warning'
);

$gantry_presets = array(
    'presets' => array(
        'blue' => array(
            'name' => 'Blue',
            'cssstyle' => 'style1',
			'bgcolor' => '#ffffff',
			'headercolor' => '#333333',
			'showcasecolor' => '#28555B',
			'showcasetopbordercolor' => '#448A94',
			'featurecolor' => '#EFEFEF',
			'bottomcolor' => '#111111',
			'footercolor' => '#666666',
            'linkcolor' => '#448A94',
            'font-family' => 'Yanone Kaffeesatz'
        ),
        'red' => array(
            'name' => 'Red',
            'cssstyle' => 'style2',
			'bgcolor' => '#ffffff',
			'headercolor' => '#222222',
			'showcasecolor' => '#870000',
			'showcasetopbordercolor' => '#9E0000',
			'featurecolor' => '#EFEFEF',
			'bottomcolor' => '#111111',
			'footercolor' => '#666666',
            'linkcolor' => '#448A94',
            'font-family' => 'Yanone Kaffeesatz'
        ),
        'green' => array(
            'name' => 'Green',
            'cssstyle' => 'style3',
			'bgcolor' => '#ffffff',
			'headercolor' => '#333333',
			'showcasecolor' => '#005226',
			'showcasetopbordercolor' => '#007537',
			'featurecolor' => '#EFEFEF',
			'bottomcolor' => '#111111',
			'footercolor' => '#005226',
            'linkcolor' => '#448A94',
            'font-family' => 'Yanone Kaffeesatz'
        ),
        'black' => array(
            'name' => 'Black',
            'cssstyle' => 'style4',
			'bgcolor' => '#ffffff',
			'headercolor' => '#1A1A1A',
			'showcasecolor' => '#222222',
			'showcasetopbordercolor' => '#333333',
			'featurecolor' => '#EFEFEF',
			'bottomcolor' => '#111111',
			'footercolor' => '#222222',
            'linkcolor' => '#448A94',
            'font-family' => 'Yanone Kaffeesatz'
        )
    )
);

$gantry_browser_params = array(
    'ie6' => array(
        'backgroundlevel' => 'low',
        'bodylevel' => 'low'
    )
);

$gantry_belatedPNG = array('.png','#rt-logo');

$gantry_ie6Warning = "<h3>IE6 DETECTED: Currently Running in Compatibility Mode</h3><h4>This site is compatible with IE6, however your experience will be enhanced with a newer browser</h4><p>Internet Explorer 6 was released in August of 2001, and the latest version of IE6 was released in August of 2004.  By continuing to run Internet Explorer 6 you are open to any and all security vulnerabilities discovered since that date.  In March of 2009, Microsoft released version 8 of Internet Explorer that, in addition to providing greater security, is faster and more standards compliant than both version 6 and 7 that came before it.</p> <br /><a class='external'  href='http://www.microsoft.com/windows/internet-explorer/?ocid=ie8_s_cfa09975-7416-49a5-9e3a-c7a290a656e2'>Download Internet Explorer 8 NOW!</a>";
