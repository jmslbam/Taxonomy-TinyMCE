<?php
/*
Plugin Name: Taxonomy TinyMCE
Plugin URI: http://www.jaimemartinez.nl/taxonomy-tinymce
Description: Replaces the description textarea with the TinyMCE WYSIWYG.
Version: 1.0
Author: Jaime Martinez
Author URI: http://www.jaimemartinez.nl
License: GPLv2
*/
/*  Copyright 2012  Jaime Martinez (email : jmslbam@gmail.com)

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

/*
 * Start replacing the description textarea on the edit detail page of a taxonomy (custom or 'category').
 * */

$show_description_column = TRUE;


add_action('init', function(){
	$taxonomies = get_taxonomies();
	foreach($taxonomies as $tax){
		add_filter($tax . '_edit_form_fields', 'taxonomy_tinycme_add_wp_editor_term');
	}
});

function taxonomy_tinycme_add_wp_editor_term($term) { ?>
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
				wp_editor(html_entity_decode($term->description ), 'description2', $settings); ?>	
		</td>	
	</tr> <?php
}

/*
 * Remove the default textarea from the edit detail page.
 * */
add_action('admin_head', 'taxonomy_tinycme_hide_description'); 
function taxonomy_tinycme_hide_description() {
	global $pagenow;
	//only hide on detail not yet on overview page.
	if( ($pagenow == 'edit-tags.php' && isset($_GET['action']) )) : 	
	?>
		<script type="text/javascript">
			jQuery(function($) {
				$('#description, textarea#tag-description').closest('.form-field').hide(); 
	 		}); 
 		</script>
 	<?php 
	endif; 
}

// lets hide the cat description from the category admin page if $show_description_column = FALSE
function manage_my_taxonomy_columns($columns)
{
	global $show_description_column;
	 // only edit the columns on the current taxonomy, this should be a setting.
	if ( $show_description_column)
	 	return $columns;

	// unset the description columns
	if ( $posts = $columns['description'] ){ unset($columns['description']); }
	 
	return $columns;
}
add_filter('manage_edit-post_tag_columns','manage_my_taxonomy_columns');
add_filter('manage_edit-category_columns','manage_my_taxonomy_columns');
