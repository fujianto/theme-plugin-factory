<?php
/**
 * Plugin Name:       BlitzardStudio Theme Plugin Factory
 * Plugin URI:        http://themevulkan.com/truffle-box/
 * Description:       Easily manage Themes and Plugin for WordPress Developer.
 * Version:           0.1.1
 * Author:            Septian Ahmad Fujianto
 * Author URI:        http://BlitzardStudio.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tp-factory
 * Domain Path:       /languages
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
   exit;
}

$extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
$extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $extension_dir ) );

/* Define necessary constant */
define('FACTORY_DIR'     , $extension_dir);
define('FACTORY_DIR_URI' , $extension_url);

/* Carbonfields */
require_once FACTORY_DIR. '/admin/carbon-fields/carbon-fields-plugin.php';

/* Add required files  */
require_once FACTORY_DIR. '/admin/cpt-factory-themes.php';
require_once FACTORY_DIR. '/admin/cpt-factory-plugins.php';

/*-------------------------------------------------------------------------------
	Custom Columns on All Themes page
-------------------------------------------------------------------------------*/

// GET FEATURED IMAGE
function tp_factory_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');

        return $post_thumbnail_img[0];
    }
}

// ADD NEW COLUMN
function tp_factory_columns_head($defaults) {
    $defaults['featured_image'] = __('Screenshot' , 'tp-factory');
    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function tp_factory_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = tp_factory_get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img style="max-width: 100%; height: auto;"  src="' . $post_featured_image . '" />';
        }
    }
}

add_filter('manage_posts_columns', 'tp_factory_columns_head');
add_action('manage_posts_custom_column', 'tp_factory_columns_content', 10, 2);