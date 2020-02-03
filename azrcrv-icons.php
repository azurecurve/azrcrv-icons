<?php
/**
 * ------------------------------------------------------------------------------
 * Plugin Name: Icons
 * Description: Allows icons to be added to posts and pages using a shortcode.
 * Version: 1.2.1
 * Author: azurecurve
 * Author URI: https://development.azurecurve.co.uk/classicpress-plugins/
 * Plugin URI: https://development.azurecurve.co.uk/classicpress-plugins/icons
 * Text Domain: icons
 * Domain Path: /languages
 * ------------------------------------------------------------------------------
 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.html.
 * ------------------------------------------------------------------------------
 */

// Prevent direct access.
if (!defined('ABSPATH')){
	die();
}

// include plugin menu
require_once(dirname( __FILE__).'/pluginmenu/menu.php');
register_activation_hook(__FILE__, 'azrcrv_create_plugin_menu_i');

// include update client
require_once(dirname(__FILE__).'/libraries/updateclient/UpdateClient.class.php');

/**
 * Setup actions, filters and shortcodes.
 *
 * @since 1.0.0
 *
 */
// add actions
add_action('admin_menu', 'azrcrv_i_create_admin_menu');
add_action('wp_enqueue_scripts', 'azrcrv_i_load_css');
//add_action('the_posts', 'azrcrv_i_check_for_shortcode');
add_action('plugins_loaded', 'azrcrv_i_load_languages');

// add filters
add_filter('plugin_action_links', 'azrcrv_i_add_plugin_action_link', 10, 2);

// add shortcodes
add_shortcode('icon', 'azrcrv_i_icon');
add_shortcode('ICON', 'azrcrv_i_icon');

/**
 * Load language files.
 *
 * @since 1.0.0
 *
 */
function azrcrv_i_load_languages() {
    $plugin_rel_path = basename(dirname(__FILE__)).'/languages';
    load_plugin_textdomain('icons', false, $plugin_rel_path);
}

/**
 * Check if shortcode on current page and then load css and jqeury.
 *
 * @since 1.0.0
 *
 */
function azrcrv_i_check_for_shortcode($posts){
    if (empty($posts)){
        return $posts;
	}
	
	
	// array of shortcodes to search for
	$shortcodes = array(
						'icon','ICON'
						);
	
    // loop through posts
    $found = false;
    foreach ($posts as $post){
		// loop through shortcodes
		foreach ($shortcodes as $shortcode){
			// check the post content for the shortcode
			if (has_shortcode($post->post_content, $shortcode)){
				$found = true;
				// break loop as shortcode found in page content
				break 2;
			}
		}
	}
 
    if ($found){
		// as shortcode found call functions to load css and jquery
        azrcrv_i_load_css();
    }
    return $posts;
}
	
/**
 * Load plugin css.
 *
 * @since 1.0.0
 *
	 */
function azrcrv_i_load_css(){
	wp_enqueue_style('azrcrv-i', plugins_url('assets/css/style.css', __FILE__));
}

/**
 * Add Icons action link on plugins page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_i_add_plugin_action_link($links, $file){
	static $this_plugin;

	if (!$this_plugin){
		$this_plugin = plugin_basename(__FILE__);
	}

	if ($file == $this_plugin){
		$settings_link = '<a href="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=azrcrv-i">'.esc_html__('Settings' ,'icons').'</a>';
		array_unshift($links, $settings_link);
	}

	return $links;
}

/**
 * Add Icon menu to plugin menu.
 *
 * @since 1.0.0
 *
 */
function azrcrv_i_create_admin_menu(){
	//global $admin_page_hooks;
	
	add_submenu_page("azrcrv-plugin-menu"
						,esc_html__("Icons Settings", "icons")
						,esc_html__("Icons", "icons")
						,'manage_options'
						,'azrcrv-i'
						,'azrcrv_i_settings');
}

/**
 * Display Settings page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_i_settings(){
	if (!current_user_can('manage_options')){
		$error = new WP_Error('not_found', esc_html__('You do not have sufficient permissions to access this page.' , 'icons'), array('response' => '200'));
		if(is_wp_error($error)){
			wp_die($error, '', $error->get_error_data());
		}
	}
	?>
	<div id="azrcrv-i-general" class="wrap">
		<h1><?php echo esc_html(get_admin_page_title()); ?></h1>

		<label for="explanation">
				<p><?php esc_html_e('Icons allows a 16x16 icon to be displayed in a post or page using the [icon] shortcode.', 'icons'); ?></p>
				<p><?php esc_html_e('Format of shortcode is [icon=accept] to display the accept icon.', 'icons'); ?></p>
				<p><?php printf(esc_html__("Included icons are from the famfamfam Silk icon set 1.3 by Mark James (%s). Extra icons can be added by simply placing them in PNG format into the /images folder; the filename, without the extension, is the shortcode parameter.", "icons"), "<a href='http://www.famfamfam.com/lab/icons/silk/'>http://www.famfamfam.com/lab/icons/silk/</a>"); ?></p>
			</label>
		</label>
		
		<p>
		<?php esc_html_e('Available icons are:', 'icons');
			
			$dir = plugin_dir_path(__FILE__).'/images';
			$images = array();
			if (is_dir($dir)){
				if ($directory = opendir($dir)){
					while (($file = readdir($directory)) !== false){
						if ($file != '.' and $file != '..' and $file != 'Thumbs.db' and $file != 'index.php'){
							$filewithoutext = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);
							$images[] = $filewithoutext;
						}
					}
					closedir($directory);
				}
				asort($images);
				
				if ($directory = opendir($dir)){
					foreach ($images as $image){
						echo "<div style='width: 180px; display: inline-block;'><img src='";
						echo plugin_dir_url(__FILE__)."images/".esc_html($image).".png' alt='".esc_html($image)."' />&nbsp;<em>".esc_html($image)."</em></div>";
					}
				}
			}
			?>
		</p>
		
		<label for="additional-plugins">
			azurecurve <?php esc_html_e('has the following plugins which allow shortcodes to be used in comments and widgets:', 'icons'); ?>
		</label>
		<ul class='azrcrv-plugin-index'>
			<li>
				<?php
				if (azrcrv_i_is_plugin_active('azrcrv-shortcodes-in-comments/azrcrv-shortcodes-in-comments.php')){
					echo "<a href='admin.php?page=azrcrv-sic' class='azrcrv-plugin-index'>Shortcodes in Comments</a>";
				}else{
					echo "<a href='https://plugins.classicpress.org/shortcodes-in-comments/' class='azrcrv-plugin-index'>Shortcodes in Comments</a>";
				}
				?>
			</li>
			<li>
				<?php
				if (azrcrv_i_is_plugin_active('azrcrv-shortcodes-in-widgets/azrcrv-shortcodes-in-widgets.php')){
					echo "<a href='admin.php?page=azrcrv-siw' class='azrcrv-plugin-index'>Shortcodes in Widgets</a>";
				}else{
					echo "<a href='https://plugins.classicpress.org/shortcodes-in-widgets/' class='azrcrv-plugin-index'>Shortcodes in Widgets</a>";
				}
				?>
			</li>
		</ul>
	</div><?php
}

/**
 * Check if function active (included due to standard function failing due to order of load).
 *
 * @since 1.0.0
 *
 */
function azrcrv_i_is_plugin_active($plugin){
    return in_array($plugin, (array) get_option('active_plugins', array()));
}

/**
 * Icon shortcode.
 *
 * @since 1.0.0
 *
	 */
function azrcrv_i_icon($atts, $content = null)
{
	if (empty($atts)){
		$icon = 'none';
	}else{
		$attribs = implode('',$atts);
		$icon = trim (trim (trim (trim (trim ($attribs , '=') , '"') , "'") , '&#8217;') , "&#8221;");
	}
	return "<img class='azrcrv-i' src='".plugin_dir_url(__FILE__)."images/".esc_html($icon).".png' alt= '".esc_html($icon)."' />";
}

?>