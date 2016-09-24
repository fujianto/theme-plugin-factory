<?php
/**
 * Plugin Name:       KodePixel Theme Factory
 * Plugin URI:        http://septianfujianto.com/plugin/theme-factory
 * Description:       Easily manage Themes collection for WordPress Developer.
 * Version:           0.1.3
 * Author:            Septian Ahmad Fujianto
 * Author URI:        http://septianfujianto.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tp-factory
 * Domain Path:       /languages
 * GitHub plugin URI: https://github.com/fujianto/theme-plugin-factory
 * GitHub branch: master
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

function tpf_check_required_plugins(){
    /* Add built-in Carbonfields if carbon-fields plugin isn't active */
    if( !is_plugin_active('carbon-fields/carbon-fields-plugin.php')){
        require_once FACTORY_DIR. '/admin/carbon-fields/carbon-fields-plugin.php';
    }
}

add_action( 'admin_init', 'tpf_check_required_plugins' );

 /* Add required files  */
require_once FACTORY_DIR. '/admin/cpt-factory-themes.php';

/*-------------------------------------------------------------------------------
	Custom Columns on All Themes page Dashboard
-------------------------------------------------------------------------------*/

// GET FEATURED IMAGE
function tpf_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');

        return $post_thumbnail_img[0];
    }
}

// ADD NEW COLUMN
function tpf_columns_head($defaults) {
    $defaults['featured_image'] = __('Screenshot' , 'tp-factory');
    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function tpf_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = tpf_get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img style="max-width: 100%; height: auto;"  src="' . $post_featured_image . '" />';
        }
    }
}

add_filter('manage_posts_columns', 'tpf_columns_head');
add_action('manage_posts_custom_column', 'tpf_columns_content', 10, 2);