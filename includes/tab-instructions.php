<?php
/*
	Instructions tab on settings page
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\Icons;

/**
 * Instructions tab.
 */

$tab_instructions_label = esc_html__( 'Instructions', 'azrcrv-i' );
$tab_instructions       = '
<table class="form-table azrcrv-settings">
	
	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="' . esc_attr( PLUGIN_HYPHEN ) . '">' . esc_html__( 'Available Icons', 'azrcrv-i' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .
				sprintf( esc_html__( '%s allows an icon to be displayed in a post or page using the %s shortcode.', 'azrcrv-i' ), 'Icons', '<strong>[icon]</strong>' )

			. '</p>
		
			<p>' .

				sprintf( esc_html__( 'The format of the shortcode is %s to display the %s icon; replace the word after the %s with the name from the available icons.', 'azrcrv-i' ), '<strong>[icon=accept]</strong>', '<strong>accept</strong>', '<strong>=</strong>' )

			. '</p>
		
		</td>
	
	</tr>
	
	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="' . esc_attr( PLUGIN_HYPHEN ) . '">' . esc_html__( 'Settings', 'azrcrv-i' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .

				esc_html__( 'Before using the plugin you should configure the settings.', 'azrcrv-i' )

			. '</p>
		
			<p>' .

				esc_html__( 'The paths in which custom icons are to be uploaded, both the URL and matching folder path, must be provided.', 'azrcrv-i' )

			. '</p>
		
		</td>
	
	</tr>
	
	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="' . esc_attr( PLUGIN_HYPHEN ) . '">' . esc_html__( 'Upload Custom Icon', 'azrcrv-i' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .

				sprintf( esc_html__( 'Custom icons can be uploaded to add to the default set; only %s icons are supported.', 'azrcrv-i' ), 'PNG' )

			. '</p>
		
		</td>
	
	</tr>
	
</table>';
