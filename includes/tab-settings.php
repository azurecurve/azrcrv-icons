<?php
/*
	other plugins tab on settings page
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\Icons;

/**
 * Settings tab.
 */

$options = get_option_with_defaults( PLUGIN_HYPHEN );

$custom_icon_folder_label       = esc_html__( 'Custom Icon Folder', 'azrcrv-i' );
$custom_icon_folder             = esc_attr( $options['folder'] );
$custom_icon_folder_description = sprintf( esc_html__( 'Specify the folder where custom icons will be placed; if the folder does not exist, it will be created with %d permissions.', 'azrcrv-i' ), '0755' );
$custom_icon_url_label          = esc_html__( 'Custom Icon URL', 'azrcrv-i' );
$custom_icon_url                = esc_attr( $options['url'] );
$custom_icon_url_description    = sprintf( esc_html__( 'Specify the URL for the custom icons folder.', 'azrcrv-i' ), '0755' );

$tab_settings_label = esc_html__( 'Settings', 'azrcrv-i' );
$tab_settings       = '
<table class="form-table azrcrv-settings">
	
	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="azrcrv-i">' . esc_html__( 'Locations', 'azrcrv-i' ) . '</h2>
			
		</th>

	</tr>
	
	<tr>
		<th scope="row">
		
			<label for="folder">' . $custom_icon_folder_label . '</label>
			
		</th>
		
		<td>
			
			<input name="folder" type="text" id="folder" value="' . $custom_icon_folder . '" class="large-text" />
			<p class="description" id="folder-description">
				' . $custom_icon_folder_description . '
			</p>
			
		</td>
	</tr>
	
	<tr>
		
		<th scope="row">
			<label for="url">' . $custom_icon_url_label . '</label>
		</th>
		
		<td>
			
			<input name="url" type="text" id="url" value="' . $custom_icon_url . '" class="large-text" />
			<p class="description" id="url-description">
				' . $custom_icon_url_description . '
			</p>
		
		</td>
	</tr>

</table>';
