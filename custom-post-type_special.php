<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// let's create the function for the custom type
function custom_post_special() {
	// creating (registering) the custom type 
	register_post_type( 'special', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Specials', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Special', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Specials', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Special', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Special', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Special', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Special', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Specials', 'bonestheme' ), /* Search Custom Type Title */
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Specials on sale now at Eddie\'s Tacos', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'special', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'special', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
//			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
			'supports' => array( 'title', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
//	/* this adds your post categories to your custom post type */
//	register_taxonomy_for_object_type( 'category', 'menu_item' );
//
//	/* this adds your post tags to your custom post type */
//	register_taxonomy_for_object_type( 'post_tag', 'menu_item' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_special');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/

add_filter( 'cmb_meta_boxes', 'cmb_special_metaboxes' );
function cmb_special_metaboxes( array $meta_boxes ) {
	$prefix = '_cmb_special_';

	$meta_boxes['special_metabox'] = array(
		'id'         => 'special_metabox',
		'title'      => __( 'Special Metadata', 'cmb' ),
		'pages'      => array( 'special', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Picture', 'cmb' ),
				'desc' => __( 'Upload an image or enter a URL (optional)', 'cmb' ),
				'id'   => $prefix . 'picture',
				'type' => 'file',
			),
			array(
				'name' => __( 'English Description', 'cmb' ),
				'desc' => __( 'description of special in english', 'cmb' ),
				'id'   => $prefix . 'description_en',
				'type' => 'textarea',
				'attributes' => array(
					'required' => 'required'
				)
			),
			array(
				'name' => __( 'Descripción en español', 'cmb' ),
				'desc' => __( 'descripción de especial en español', 'cmb' ),
				'id'   => $prefix . 'description_es',
				'type' => 'textarea',
				'attributes' => array(
					'required' => 'required'
				)
			),
			array(
				'name' => __( 'Price', 'cmb' ),
				'desc' => __( 'price in USD', 'cmb' ),
				'id'   => $prefix . 'price',
				'type' => 'text_money',
				// 'before'     => '£', // override '$' symbol if needed
				// 'repeatable' => true,
				'attributes' => array(
					'required' => 'required'
				)
			),
		)
	);

	return $meta_boxes;
}
