# Taxonomy TinyMCE

Contributors: ypraise, jmslbam
Tags: taxonomy description, category description, tinyMCE, wp_editor, taxonomy, category
Requires at least: 3.3
Tested up to: 3.3
Stable tag: 1.0

This plugins replaces the the description textarea with the TinyMCE WYSIWYG.

## Description
---------------------

This plugins replaces the description textarea with the TinyMCE WYSIWYG.

**Contributors**:

* Kevin Heath of ypraise [ypraise.com](http://ypraise.com/2012/01/wordpress-plugin-categorytinymce/) )
* Jaime Martinez ( [@jmslbam](http://twitter.com/jmslbam ) / [jaimemartinez.nl](http://www.jaimemartinez.nl/) )


## Notes

- This plugin needs at least WordPress 3.3 to work as it uses the new wp_editor call introduced in WP 3.3.
- This plugin is a inspired by [CategoryTinyMCE](http://wordpress.org/extend/plugins/categorytinymce/).
- Kevin please use this code to update your, because I realy don't have a clue yet how the who WordPress repo's work...
- Or just hook on github and you publish this on WordPress SVN  

## Installation

1. Upload Taxonomy-TinyMCE folder to the /wp-content/plugins/ directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to your custom taxonomy edit pages and start to write!

## Frequently Asked Questions

### Why not use Category TincyMCE

I want to, but had to make to much changes to still call it CategoryTinyMCE. Hope we can combine powers.
Also a category is buildin [custom taxonomy](http://codex.wordpress.org/Taxonomies).

## Changelog

= 1.0 =
* Migrated from Category TinyMCE to Taxonomy TinyMCE

## To Do
- Show tiny_mce on overview page 'edit-tag' page, but it needs some change in the core or Wordpress.
inline-edit-tags.js needs to have .live() to work with TinyMCE.
I was thinking about so submiting a request to add this, but I first have to learn my way in to WP svn / ideas / trac etc. Any help?
- Implement