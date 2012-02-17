<?php
/*
Plugin Name: TaxonomyTinymce
Plugin URI: http://www.hoppinger.com
Description: Adds a tinymce enable box to all taxonomy descriptions page.
Version: 1.0
Author: Hoppinger
Author URI: 
License: GPL
*/
/*  Copyright 2012  Hoppinger 

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


remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );
	
// add extra css to display quicktags correctly
add_action( 'admin_print_styles', 'taxonomy_tinycme_admin_head' );
function taxonomy_tinycme_admin_head() { ?>
	<style type="text/css">
		.quicktags-toolbar input{width: 55px !important;}
	</style> <?php
} 
//list all taxonomies
$taxonomy = 'category';

add_filter('edit_tag_form_fields', 'taxonomy_tinycme_add_wp_editor_term');
function taxonomy_tinycme_add_wp_editor_term($tag) { ?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="description"><?php _ex('Description', 'Taxonomy Description'); ?></label></th>
		<td>
			<?php  
				$settings = array(
					'wpautop' => true, 
					'media_buttons' => true, 
					'quicktags' => true, 
					'textarea_rows' => '15', 
					'textarea_name' => 'description' 
				);	
				wp_editor(html_entity_decode($tag->description ), 'description2', $settings); ?>	
		</td>	
	</tr> <?php
}


add_action('admin_head', 'taxonomy_tinycme_hide_description'); 
function taxonomy_tinycme_hide_description() {
	global $pagenow;
	
	if( $pagenow == 'edit-tags.php' && $_GET['action'] == 'edit' ) : ?>
		<script type="text/javascript">
			jQuery(function($) {
				$('#description').parent().parent().hide(); 
	 		}); 
 		</script> 
 		<?php
	endif; 
}