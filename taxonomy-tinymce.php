<?php
/*
Plugin Name: Taxonomy TinyMCE
Plugin URI: http://www.jaimemartinez.nl/taxonomy-tinymce
Description: Replaces the description textarea with the TinyMCE WYSIWYG.
Version: 2.0
Author: Jaime Martínez
Author URI: http://www.jaimemartinez.nl
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
/*  Copyright 2012  Jaime Martínez (email : jmslbam@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/**
 * Module Name: WooDojo - HTML Term Description
 * Module Description: The WooDojo HTML term description feature adds the ability to use html in term descriptions, as well as a visual editor to make input easier.
 * Module Version: 1.0.2
 *
 * @package WooDojo
 * @subpackage Downloadable
 * @author WooThemes
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


function tt_init_component_loaders(){
	/* Include Class */
	require_once( 'classes/class-woodojo-html-term-description.php' );

	/* Instantiate Class */
	if ( class_exists( 'TT_WooDojo_HTML_Term_Description' ) ) {	
		$woodojo_html_term_description = new TT_WooDojo_HTML_Term_Description();
	}
}
add_action( 'plugins_loaded', 'tt_init_component_loaders' );

