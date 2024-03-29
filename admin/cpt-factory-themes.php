<?php
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
} else {
	if( !is_plugin_active('carbon-fields/carbon-fields-plugin.php')){
		require_once FACTORY_DIR. '/admin/carbon-fields/carbon-fields-plugin.php';
	}
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

if ( ! function_exists('tpf_register_cpt_themes') ) {

	// Register Custom Post Type
	function tpf_register_cpt_themes() {

		$labels = array(
			'name'                  => _x( 'Themes', 'Post Type General Name', 'tp-factory' ),
			'singular_name'         => _x( 'Theme', 'Post Type Singular Name', 'tp-factory' ),
			'menu_name'             => __( 'Themes', 'tp-factory' ),
			'name_admin_bar'        => __( 'Themes', 'tp-factory' ),
			'archives'              => __( 'Theme Archives', 'tp-factory' ),
			'parent_item_colon'     => __( 'Parent Theme:', 'tp-factory' ),
			'all_items'             => __( 'All Themes', 'tp-factory' ),
			'add_new_item'          => __( 'Add New Themes', 'tp-factory' ),
			'add_new'               => __( 'Add New', 'tp-factory' ),
			'new_item'              => __( 'New Theme', 'tp-factory' ),
			'edit_item'             => __( 'Edit Theme', 'tp-factory' ),
			'update_item'           => __( 'Update Theme', 'tp-factory' ),
			'view_item'             => __( 'View Theme', 'tp-factory' ),
			'search_items'          => __( 'Search Theme', 'tp-factory' ),
			'not_found'             => __( 'Not found', 'tp-factory' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'tp-factory' ),
			'featured_image'        => __( 'Screenshot', 'tp-factory' ),
			'set_featured_image'    => __( 'Set screenshot', 'tp-factory' ),
			'remove_featured_image' => __( 'Remove screenshot', 'tp-factory' ),
			'use_featured_image'    => __( 'Use as screenshot', 'tp-factory' ),
			'insert_into_item'      => __( 'Insert into Theme', 'tp-factory' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Theme', 'tp-factory' ),
			'items_list'            => __( 'Themes list', 'tp-factory' ),
			'items_list_navigation' => __( 'Themes list navigation', 'tp-factory' ),
			'filter_items_list'     => __( 'Filter Themes list', 'tp-factory' ),
		);

		$rewrite = array(
			'slug'                  => 'themes',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);

		$args = array(
			'label'                 => __( 'Themes', 'tp-factory' ),
			'description'           => __( 'Check out Our best WordPress Themes here.', 'tp-factory' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'comments'),
			'taxonomies'            => array( 'tpf-theme-types', 'tpf-theme-features'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-welcome-widgets-menus',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => 'themes',
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'show_in_rest' => true,
			'capability_type'       => 'post',
		);

		register_post_type( 'tpf-themes', $args );
		flush_rewrite_rules();
	}

	add_action( 'init', 'tpf_register_cpt_themes', 0 );
}

if ( ! function_exists( 'tpf_register_tax_theme_type' ) ) {

	// Register Custom Taxonomy
	function tpf_register_tax_theme_type() {

		$labels = array(
			'name'                       => _x( 'Types', 'Taxonomy General Name', 'tp-factory' ),
			'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'tp-factory' ),
			'menu_name'                  => __( 'Type', 'tp-factory' ),
			'all_items'                  => __( 'All Types', 'tp-factory' ),
			'parent_item'                => __( 'Parent Type', 'tp-factory' ),
			'parent_item_colon'          => __( 'Parent Type:', 'tp-factory' ),
			'new_item_name'              => __( 'New Type Name', 'tp-factory' ),
			'add_new_item'               => __( 'Add New Type', 'tp-factory' ),
			'edit_item'                  => __( 'Edit Type', 'tp-factory' ),
			'update_item'                => __( 'Update Type', 'tp-factory' ),
			'view_item'                  => __( 'View Type', 'tp-factory' ),
			'separate_items_with_commas' => __( 'Separate types with commas', 'tp-factory' ),
			'add_or_remove_items'        => __( 'Add or remove types', 'tp-factory' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'tp-factory' ),
			'popular_items'              => __( 'Popular types', 'tp-factory' ),
			'search_items'               => __( 'Search types', 'tp-factory' ),
			'not_found'                  => __( 'Not Found', 'tp-factory' ),
			'no_terms'                   => __( 'No types', 'tp-factory' ),
			'items_list'                 => __( 'types list', 'tp-factory' ),
			'items_list_navigation'      => __( 'types list navigation', 'tp-factory' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest' => true,
		);

		register_taxonomy( 'tpf-theme-types', array( 'tpf-themes' ), $args );

	}

	add_action( 'init', 'tpf_register_tax_theme_type', 0 );

}

if ( ! function_exists( 'tpf_register_tax_theme_feature' ) ) {

	// Register Custom Taxonomy
	function tpf_register_tax_theme_feature() {

		$labels = array(
			'name'                       => _x( 'Features', 'Taxonomy General Name', 'tp-factory' ),
			'singular_name'              => _x( 'Feature', 'Taxonomy Singular Name', 'tp-factory' ),
			'menu_name'                  => __( 'Feature', 'tp-factory' ),
			'all_items'                  => __( 'All Features', 'tp-factory' ),
			'parent_item'                => __( 'Parent Feature', 'tp-factory' ),
			'parent_item_colon'          => __( 'Parent Feature:', 'tp-factory' ),
			'new_item_name'              => __( 'New Feature Name', 'tp-factory' ),
			'add_new_item'               => __( 'Add New Feature', 'tp-factory' ),
			'edit_item'                  => __( 'Edit Feature', 'tp-factory' ),
			'update_item'                => __( 'Update Feature', 'tp-factory' ),
			'view_item'                  => __( 'View Feature', 'tp-factory' ),
			'separate_items_with_commas' => __( 'Separate features with commas', 'tp-factory' ),
			'add_or_remove_items'        => __( 'Add or remove features', 'tp-factory' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'tp-factory' ),
			'popular_items'              => __( 'Popular features', 'tp-factory' ),
			'search_items'               => __( 'Search features', 'tp-factory' ),
			'not_found'                  => __( 'Not Found', 'tp-factory' ),
			'no_terms'                   => __( 'No features', 'tp-factory' ),
			'items_list'                 => __( 'features list', 'tp-factory' ),
			'items_list_navigation'      => __( 'features list navigation', 'tp-factory' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest' => true,
		);

		register_taxonomy( 'tpf-theme-features', array( 'tpf-themes' ), $args );
	}

	add_action( 'init', 'tpf_register_tax_theme_feature', 0 );
}

/* Register all metabox to tpf-themes rest api */
add_action( 'rest_api_init', 'tpf_register_metabox_rest');

function tpf_register_metabox_rest() {
	function tpf_get_all_post_meta($post) {
		$current_meta = get_post_meta($post['id']);
		$meta_data = [];

		foreach($current_meta as $key => $obj){
			$meta_data[$key] = $obj[0];
		}
		
		return $meta_data;
	}

	function tpf_get_all_custom_taxonomy() {
		$term_features = get_the_terms(get_the_ID(),  'tpf-theme-features');
		$term_types = get_the_terms(get_the_ID(),  'tpf-theme-types');
		$term_features_data = [];
		$term_types_data = [];

		foreach($term_features as $key => $obj){
			 $term_features_data[$term_features[$key]->slug] =$term_features[$key];
		}

		foreach($term_types as $key => $obj){
			 $term_types_data[$term_types[$key]->slug] =$term_types[$key];
		}

		return array( 'tpf-theme-features' => $term_features_data, 'tpf-theme-types' => $term_types_data);
	}

	function tpf_get_rest_featured_image( $object, $field_name, $request ) {
		if( $object['featured_media'] ){
				$img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
				return $img[0];
		}

		return false;
	}

	register_rest_field( 'tpf-themes', 'post_meta', array(
			'show_in_rest' => true,
			'get_callback' => 'tpf_get_all_post_meta',
	));

	register_rest_field( 'tpf-themes', 'post_terms', array(
			'show_in_rest' => true,
			'get_callback' => 'tpf_get_all_custom_taxonomy',
	));

	register_rest_field( 'tpf-themes', 'featured_image', array(
			'show_in_rest' => true,
			'get_callback' => 'tpf_get_rest_featured_image',
	));
}

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );

function crb_attach_theme_options() {
    /*-------------------------------------------------------------------------------
    Create Metabox For Theme Detail
    -------------------------------------------------------------------------------*/
    $prefix = '_tpf_meta_';

    Container::make('post_meta', __('Theme Detail', 'tp-factory'))
        ->show_on_post_type( 'tpf-themes' )
        ->add_tab(__('General', 'tp-factory'), array(
            Field::make('text', $prefix.'slug', __( 'Theme Slug', 'tp-factory' ))
							->set_visible_in_rest_api( $visible = true ),
            Field::make('rich_text', $prefix.'description', __( 'Description', 'tp-factory' ))
							->set_visible_in_rest_api( $visible = true ),
            Field::make('text', $prefix.'version', __( 'Version', 'tp-factory' ))
							->set_visible_in_rest_api( $visible = true )
							->help_text(__( 'The theme current version', 'tp-factory' )),
            // Parent Theme
            Field::make('text', $prefix.'parent', __( 'Parent Theme', 'tp-factory' ))
							->set_visible_in_rest_api( $visible = true )
							->help_text(__( 'Enter parent theme slug', 'tp-factory' )),
        ))
        ->add_tab(__('Links'), array(
            Field::make('text', $prefix.'download_url', __( 'Download URL', 'tp-factory' ))
								->set_visible_in_rest_api( $visible = true )
                ->help_text(__( 'URL to ZIP / theme files', 'tp-factory' )),
            Field::make('text', $prefix.'demo_url', __( 'Demo URL', 'tp-factory' ))
                ->set_visible_in_rest_api( $visible = true )
								->help_text(__( 'URL to theme demo site', 'tp-factory' )),
            Field::make('text', $prefix.'demo_mask_url', __( 'Demo Mask URL', 'tp-factory' ))
                ->set_visible_in_rest_api( $visible = true )
								->help_text(__( 'Masked URL to theme demo site', 'tp-factory' )),
            Field::make('text', $prefix.'repo_url', __( 'Repository URL', 'tp-factory' ))
                ->set_visible_in_rest_api( $visible = true )
								->help_text(__( 'URL to github or other repository', 'tp-factory' )),
            Field::make('text', $prefix.'purchase_url', __( 'Purchase URL', 'tp-factory' ))
                ->set_visible_in_rest_api( $visible = true )
								->help_text(__( 'URL to where theme can be purcashed', 'tp-factory' )),
            Field::make('text', $prefix.'support_url', __( 'Support URL', 'tp-factory' ))
                ->set_visible_in_rest_api( $visible = true )
								->help_text(__( 'URL to Theme support', 'tp-factory' )),
            Field::make('text', $prefix.'translation_url', __( 'Translation URL', 'tp-factory' ))
                ->set_visible_in_rest_api( $visible = true )
								->help_text(__( 'URL to Theme translation', 'tp-factory' )),
            Field::make('text', $prefix.'documentation_url', __( 'Documentation URL', 'tp-factory' ))
                ->set_visible_in_rest_api( $visible = true )
								->help_text(__( 'URL to Theme translation', 'tp-factory' )),
        ));
}