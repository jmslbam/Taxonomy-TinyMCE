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
add_action( 'admin_print_styles', 'taxonomytinycme__admin_head' );
function taxonomytinycme__admin_head() { ?>
	<style type="text/css">
		.quicktags-toolbar input{width: 55px !important;}
	</style> <?php
} 

$taxonomy = 'expertise';

/*
 * turned the editor for the overview screen off because of ajax problems with core wordpress
 */

//add_action( $taxonomy.'_add_form_fields', 'taxonomytinycme_add_wp_editor');
function taxonomytinycme_add_wp_editor() { ?> 
	<div class="form-field">
		<label for="description"><?php _ex('Description', 'Taxonomy Description'); ?></label>
		
			<?php  
				$settings = array(
					'wpautop' => true, 
					'media_buttons' => true, 
					'quicktags' => true, 
					'textarea_rows' => '15', 
					'textarea_name' => 'description',
					'tinymce' => array(
						'theme_advanced_buttons1' => 'bold,italic,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,|,link,unlink,wp_more,fullscreen,',
						'theme_advanced_buttons2' => 'formatselect,underline,justifyfull,|,pastetext,pasteword,|,removeformat,charmap,code',
					)
				);
				wp_editor('', 'description1', $settings); ?>	
		
	</div> 
	<a id="clickors">click me</a>
	<?php
}


add_filter('edit_tag_form_fields', 'taxonomytinycme_add_wp_editor_term');
function taxonomytinycme_add_wp_editor_term($tag) { ?>
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


add_action('admin_head', 'taxonomytinycme_hide_description'); 
function taxonomytinycme_hide_description() {
	global $pagenow;
	
	if( $pagenow == 'edit-tags.php' && $_GET['action'] == 'edit' ) : ?>
		<script type="text/javascript">
			jQuery(function($) {
				$('#description').parent().parent().hide(); 
	 		}); 
 		</script> 
 		<?php
 	/*elseif ($pagenow == 'edit-tags.php') :
 		wp_dequeue_script('inline-edit-tax');
 		
 		$plugin_directory = plugin_dir_path( __FILE__ );
		wp_enqueue_script( 
			'inline-edit-tags-live',
			$plugin_directory . '/inline-edit-tag-live.js',
			false,
			false 
		);

 		?>
 		<script type="text/javascript">
			jQuery(function($) {
				$('#tag-description').parent().live().remove();
		 	}); 
 		</script> <?php */
	endif; 
} 





/*
function taxonomytinycme_manage_my_category_columns($columns)
{
 // only edit the columns on the current taxonomy
 if ( !isset($_GET['taxonomy']) || $_GET['taxonomy'] != 'category' )
 return $columns;
 
 // unset the description columns
 if ( $posts = $columns['description'] ){ unset($columns['description']); }
 
 return $columns;
}
add_filter('manage_edit-category_columns','manage_my_category_columns');

function taxonomytinycme_manage_my_tag_columns($columns)
{
 // only edit the columns on the current taxonomy
 if ( !isset($_GET['taxonomy']) || $_GET['taxonomy'] != 'post_tag' )
 return $columns;
 
 // unset the description columns
 if ( $posts = $columns['description'] ){ unset($columns['description']); }
 
 return $columns;
}
add_filter('manage_edit-post_tag_columns','manage_my_tag_columns');


// when a category is removed delete the new box

add_filter('deleted_term_taxonomy', 'remove_Category_Extras');
function taxonomytinycme_remove_Category_Extras($term_id) {
  if($_POST['taxonomy'] == 'category'):
    $tag_extra_fields = get_option(Category_Extras);
    unset($tag_extra_fields[$term_id]);
    update_option(Category_Extras, $tag_extra_fields);
  endif;
}*/