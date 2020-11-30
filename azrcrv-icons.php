<?php
/**
 * ------------------------------------------------------------------------------
 * Plugin Name: Icons
 * Description: Allows icons to be added to posts and pages using a shortcode.
 * Version: 1.5.1
 * Author: azurecurve
 * Author URI: https://development.azurecurve.co.uk/classicpress-plugins/
 * Plugin URI: https://development.azurecurve.co.uk/classicpress-plugins/icons/
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
add_action('admin_init', 'azrcrv_create_plugin_menu_i');

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
add_action('admin_enqueue_scripts', 'azrcrv_i_load_admin_style');
add_action('plugins_loaded', 'azrcrv_i_load_languages');
add_action('admin_post_azrcrv_i_save_options', 'azrcrv_i_save_options');
add_action('admin_post_azrcrv_i_upload_image', 'azrcrv_i_upload_image');

// add filters
add_filter('plugin_action_links', 'azrcrv_i_add_plugin_action_link', 10, 2);
add_filter('the_posts', 'azrcrv_i_check_for_shortcode');
add_filter('codepotent_update_manager_image_path', 'azrcrv_i_custom_image_path');
add_filter('codepotent_update_manager_image_url', 'azrcrv_i_custom_image_url');

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
 * Custom plugin image path.
 *
 * @since 1.3.0
 *
 */
function azrcrv_i_custom_image_path($path){
    if (strpos($path, 'azrcrv-icons') !== false){
        $path = plugin_dir_path(__FILE__).'assets/pluginimages';
    }
    return $path;
}

/**
 * Custom plugin image url.
 *
 * @since 1.3.0
 *
 */
function azrcrv_i_custom_image_url($url){
    if (strpos($url, 'azrcrv-icons') !== false){
        $url = plugin_dir_url(__FILE__).'assets/pluginimages';
    }
    return $url;
}

/**
 * Get options including defaults.
 *
 * @since 1.5.0
 *
 */
function azrcrv_i_get_option($option_name){
	
	$upload_dir = wp_upload_dir();
 
	$defaults = array(
						'folder' => trailingslashit($upload_dir['basedir']).'icons/',
						'url' => trailingslashit($upload_dir['baseurl']).'icons/',
					);

	$options = get_option($option_name, $defaults);

	$options = wp_parse_args($options, $defaults);

	return $options;

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
		$settings_link = '<a href="'.admin_url('admin.php?page=azrcrv-i').'"><img src="'.plugins_url('/pluginmenu/images/Favicon-16x16.png', __FILE__).'" style="padding-top: 2px; margin-right: -5px; height: 16px; width: 16px;" alt="azurecurve" />'.esc_html__('Settings' ,'icons').'</a>';
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
 * Load css and jquery for icons.
 *
 * @since 1.5.0
 *
 */
function azrcrv_i_load_admin_style(){
    wp_register_style('icons-css', plugins_url('assets/css/admin.css', __FILE__), false, '1.0.0');
    wp_enqueue_style( 'icons-css' );
	
	wp_enqueue_script("icons-admin-js", plugins_url('assets/jquery/jquery.js', __FILE__), array('jquery', 'jquery-ui-core', 'jquery-ui-tabs'));
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
	
	$options = azrcrv_i_get_option('azrcrv-i');
	$saved_options = get_option('azrcrv-i');
	
	echo '<div id="azrcrv-i-general" class="wrap">';
	
		echo '<h1>'.esc_html(get_admin_page_title()).'</h1>';
		
		if(isset($_GET['settings-updated'])){
			echo '<div class="notice notice-success is-dismissible"><p><strong>'.esc_html__('Settings have been saved.', 'icons').'</strong></p></div>';
		}else if(isset($_GET['upload-successful'])){
			echo '<div class="notice notice-success is-dismissible"><p><strong>'.esc_html__('Upload successful.', 'icons').'</strong></p></div>';
		}else if (isset($_GET['invalid-upload-request'])){
			echo '<div class="notice notice-error is-dismissible"><p><strong>'.esc_html__('Invaluid upload request; upload failed.', 'icons').'</strong></p></div>';
		}else if (isset($_GET['settings-updated'])){
			echo '<div class="notice notice-error is-dismissible"><p><strong>'.esc_html__('Upload failed.', 'icons').'</strong></p></div>';
		}
		
		if (isset($saved_options['folder'])){
			$showsettings = false;
		}else{
			$showsettings = true;
		}
		
		?>

		<label for="explanation">
				<p><?php esc_html_e('Icons allows a 16x16 icon to be displayed in a post or page using the [icon] shortcode.', 'icons'); ?></p>
				<p><?php esc_html_e('Format of shortcode is [icon=accept] to display the accept icon.', 'icons'); ?></p>
				<p><?php printf(esc_html__('Included icons are from the famfamfam Silk icon set 1.3 by Mark James (%s).', 'icons'), '<a href="http://www.famfamfam.com/lab/icons/silk/">http://www.famfamfam.com/lab/icons/silk/</a>'); ?></p>
			</label>
		</label>
		
		<h2 class="nav-tab-wrapper nav-tab-wrapper-azrcrv-i">
			<a class="nav-tab <?php if ($showsettings == true){ echo 'nav-tab-active'; } ?>" data-item=".tabs-1" href="#tabs-1"><?php _e('Default Settings', 'icons') ?></a>
			<a class="nav-tab <?php if ($showsettings == false){ echo 'nav-tab-active'; } ?>" data-item=".tabs-2" href="#tabs-2"><?php _e('Available Icons', 'icons') ?></a>
			<?php
			if (isset($saved_options)){
				echo '<a class="nav-tab" data-item=".tabs-3" href="#tabs-3">'.__('Upload Icon', 'icons').'</a>';
			}
			?>
		</h2>

		<div>
			<div class="azrcrv_i_tabs <?php if ($showsettings == false){ echo 'invisible'; } ?> tabs-1">
				<p class="azrcrv_i_horiz">
					<form method="post" action="admin-post.php">
						<input type="hidden" name="action" value="azrcrv_i_save_options" />
						<input name="page_options" type="hidden" value="folder,url" />
						<table class="form-table">
							
							<tr><th scope="row"><label for="folder"><?php esc_html_e('Custom Icon Folder', 'icons'); ?></label></th><td>
								<input name="folder" type="text" id="folder" value="<?php if (strlen($options['folder']) > 0){ echo stripslashes($options['folder']); } ?>" class="large-text" />
								<p class="description" id="folder-description"><?php esc_html_e('Specify the folder where custom icons will be placed; if the folder does not exist, it will be created with 0755 permissions.', 'icons'); ?></p></td>
							</td></tr>
							
							<tr><th scope="row"><label for="url"><?php esc_html_e('Custom Icon URL', 'icons'); ?></label></th><td>
								<input name="url" type="text" id="url" value="<?php if (strlen($options['url']) > 0){ echo stripslashes($options['url']); } ?>" class="large-text" />
								<p class="description" id="url-description"><?php esc_html_e('Specify the URL for the custom icons folder.', 'icons'); ?></p></td>
							</td></tr>
							
						</table>
		
						<?php wp_nonce_field('azrcrv-i', 'azrcrv-i-nonce'); ?>
						<input type="hidden" name="azrcrv_i_data_update" value="yes" />
						<input type="hidden" name="which_button" value="save_settings" class="short-text" />
						<input type="submit" value="Save Changes" class="button-primary"/>
					</form>
				</p>
			</div>
			
			<div class="azrcrv_i_tabs <?php if ($showsettings == true){ echo 'invisible'; } ?> tabs-2">
				<p class="azrcrv_i_horiz">
		
				<?php esc_html_e('Available icons are:', 'icons');
					$icons = azrcrv_i_get_icons();
					
					foreach ($icons as $icon_id => $icon){
						
						if ($icon['type'] == 'standard'){
							$folder = plugin_dir_url(__FILE__).'assets/images/';
						}else{
							$folder = $options['url'];
						}
						
						echo '<div style="width: 180px; display: inline-block;">';
							echo '<img style="width: 16px;" src="'.esc_attr($folder).esc_attr($icon_id).'.png'.'" class="azrcrv-i" alt="'.esc_attr($icon_id).'" /> '.esc_attr($icon_id);
						echo '</div>';
					}
					
					?>
				</p>
			</div>
			
			<div class="azrcrv_i_tabs invisible tabs-3">
				<p class="azrcrv_i_horiz">
					<form method="post" action="admin-post.php" enctype="multipart/form-data">
					<input type="hidden" name="action" value="azrcrv_i_upload_image" />
						<table class="form-table">
						
							<tr><th scope="row" colspan="2"><?php printf(esc_html__('Upload files must have an extension of %s', 'icons'), '<strong>svg</strong>'); ?></th></tr>
							
							<tr><th scope="row"><?php esc_html_e('Select image to upload:', 'icons'); ?></th><td>
								<input type="file" name="fileToUpload" id="fileToUpload">
							</td></tr>
							
						</table>
						
						<input type="hidden" name="which_button" value="upload_image" class="short-text" />
						<?php wp_nonce_field('azrcrv-i-image', 'azrcrv-i-image-nonce'); ?>
						<input type="hidden" name="azrcrv_i_data_update" value="yes" />
						<input type="submit" value="Upload Image" class="button-primary">
						
					</form>
				</p>
			</div>
		</div>
	</div>
	
	<div>
		<p>
			<label for="additional-plugins">
				azurecurve <?php esc_html_e('has the following plugins which allow shortcodes to be used in comments and widgets:', 'icons'); ?>
			</label>
			<ul class='azrcrv-plugin-index'>
				<li>
					<?php
					if (azrcrv_i_is_plugin_active('azrcrv-shortcodes-in-comments/azrcrv-shortcodes-in-comments.php')){
						echo "<a href='admin.php?page=azrcrv-sic' class='azrcrv-plugin-index'>Shortcodes in Comments</a>";
					}else{
						echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-comments/' class='azrcrv-plugin-index'>Shortcodes in Comments</a>";
					}
					?>
				</li>
				<li>
					<?php
					if (azrcrv_i_is_plugin_active('azrcrv-shortcodes-in-widgets/azrcrv-shortcodes-in-widgets.php')){
						echo "<a href='admin.php?page=azrcrv-siw' class='azrcrv-plugin-index'>Shortcodes in Widgets</a>";
					}else{
						echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-widgets/' class='azrcrv-plugin-index'>Shortcodes in Widgets</a>";
					}
					?>
				</li>
			</ul>
		</p>
	</div>
	
	<?php
}

/**
 * Save settings.
 *
 * @since 1.5.0
 *
 */
function azrcrv_i_save_options(){
	// Check that user has proper security level
	if (!current_user_can('manage_options')){
		wp_die(esc_html__('You do not have permissions to perform this action', 'icons'));
	}
	
	// Check that nonce field created in configuration form is present
	if (! empty($_POST) && check_admin_referer('azrcrv-i', 'azrcrv-i-nonce')){
	
		// Retrieve original plugin options array
		$options = get_option('azrcrv-i');
			
		$option_name = 'folder';
		if (isset($_POST[$option_name])){
			$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		}
		if (!file_exists(sanitize_text_field($_POST[$option_name]))){
			mkdir(sanitize_text_field($_POST[$option_name]), 0755, true);
		}
			
		$option_name = 'url';
		if (isset($_POST[$option_name])){
			$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		}
		
		// Store updated options array to database
		update_option('azrcrv-i', $options);
		
		// set response
		$response = 'settings-updated';
		
		// Redirect the page to the configuration form that was processed
		wp_redirect(add_query_arg('page', 'azrcrv-i&'.$response, admin_url('admin.php')));
		exit;
	}
}

/**
 * Save settings.
 *
 * @since 1.5.0
 *
 */
function azrcrv_i_upload_image(){
	// Check that user has proper security level
	if (!current_user_can('manage_options')){
		wp_die(esc_html__('You do not have permissions to perform this action', 'icons'));
	}
	
	// Check that nonce field created in configuration form is present
	if (! empty($_POST) && check_admin_referer('azrcrv-i-image', 'azrcrv-i-image-nonce')){
	
		// Retrieve original plugin options array
		$options = get_option('azrcrv-i');
		
		$target_dir = $options['folder'];
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$valid = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		// check file size
		if ($_FILES["fileToUpload"]["size"] > 500000){
			$valid = 0;
		}

		// only png allowed
		if ($imageFileType != "png"){
		  $valid = 0;
		}
		$image_info = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		$width = $image_info[0];
		$height = $image_info[0];
		$mime = $image_info['mime'];
		
		if ($width == 0 OR $height == 0 OR $width > 32 OR $height > 32 OR $mime != 'image/png'){
		  $valid = 0;
		}
		
		// check if upload valid
		if ($valid == 0){
			$response = "invalid-upload-request";
		}else{
			// upload file
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$response = "upload-successful";
			} else {
				$response = "upload-failed";
			}
		}
		
		// Redirect the page to the configuration form that was processed
		wp_redirect(add_query_arg('page', 'azrcrv-i&'.$response, admin_url('admin.php')));
		exit;
	}
}

/**
 * Check if function active (included due to standard function failing due to order of load).
 *
 * @since 1.4.0
 *
 */
function azrcrv_i_get_icons(){
	
	$options = azrcrv_i_get_option('azrcrv-i');
	
	$dir = $options['folder'];
	$icons = array();
	if (is_dir($dir)){
		if ($directory = opendir($dir)){
			while (($file = readdir($directory)) !== false){
				//echo $file;
				if (substr($file, -3) == 'png'){
					$filewithoutext = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);
					$icons[$filewithoutext] = array(
														'type' => 'custom',
													);
				}
			}
			closedir($directory);
		}
	}
	
	$dir = plugin_dir_path(__FILE__).'assets/images';
	if (is_dir($dir)){
		if ($directory = opendir($dir)){
			while (($file = readdir($directory)) !== false){
				//echo $file;
				if (substr($file, -3) == 'png'){
					$filewithoutext = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);
					if (!array_key_exists($filewithoutext, $icons)){
						$icons[$filewithoutext] = array(
															'type' => 'standard',
														);
					}
				}
			}
			closedir($directory);
		}
	}
	
	ksort($icons);
	
	return $icons;
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
function azrcrv_i_icon($atts, $content = null){
	
	$options = azrcrv_i_get_option('azrcrv-i');
	
	if (empty($atts)){
		$icon = 'none';
	}else{
		$attribs = implode('',$atts);
		$icon = trim (trim (trim (trim (trim ($attribs , '=') , '"') , "'") , '&#8217;') , "&#8221;");
	}
	
	if (file_exists(trailingslashit(esc_attr($options['folder'])).esc_attr($icon).'.png')){
		$src = esc_attr($options['url']).esc_attr($icon).'.png';
	}else{
		$src = plugin_dir_url(__FILE__).'assets/images/'.esc_attr($icon).'.png';
	}

	if (@getimagesize($src)) {
		$return = "<img class='azrcrv-i' src='$src' alt= '".esc_html($icon)."' />";
	}else{
		$return = '';
	}
		
	return $return;
}

?>