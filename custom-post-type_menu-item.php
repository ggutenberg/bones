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
function custom_post_menu_item() {
	// creating (registering) the custom type 
	register_post_type( 'menu_item', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Menu Items', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Menu Item', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Menu Items', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Menu Item', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Menu Items', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Menu Item', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Menu Item', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Menu Items', 'bonestheme' ), /* Search Custom Type Title */
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Menu items for sale at Eddie\'s Tacos', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'menu-item', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'menu_item', /* you can rename the slug here */
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
	add_action( 'init', 'custom_post_menu_item');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'category_menu',
		array('menu_item', 'special'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Menu Sections', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Menu Section', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Menu Sections', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Menu Sections', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Menu Sections', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Menu Section:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Menu Section', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Menu Section', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Menu Section', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Menu Section Name', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'section' ),
		)
	);
	
	// now let's add custom tags (these act like categories)
	register_taxonomy( 'tag_menu',
		array('menu_item'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => false,    /* if this is false, it acts like tags */
			'labels' => array(
				'name' => __( 'Custom Tags', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Custom Tag', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Custom Tags', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Custom Tags', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Custom Tag', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Custom Tag:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Custom Tag', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Custom Tag', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Custom Tag', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Custom Tag Name', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
		)
	);
	
	/*
		looking for custom meta boxes?
		check out this fantastic tool:
		https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
	*/
add_filter( 'cmb_meta_boxes', 'cmb_menu_item_metaboxes' );
function cmb_menu_item_metaboxes( array $meta_boxes ) {
	$prefix = '_cmb_menu_item_';

	$meta_boxes['menu_item_metabox'] = array(
		'id'         => 'menu_item_metabox',
		'title'      => __( 'Menu Item Metadata', 'cmb' ),
		'pages'      => array( 'menu_item', ), // Post type
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
				'desc' => __( 'description of menu item in english', 'cmb' ),
				'id'   => $prefix . 'description_en',
				'type' => 'textarea',
				'attributes' => array(
					'required' => 'required'
				)
			),
			array(
				'name' => __( 'Descripción en español', 'cmb' ),
				'desc' => __( 'descripción del elemento de menú en español', 'cmb' ),
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
