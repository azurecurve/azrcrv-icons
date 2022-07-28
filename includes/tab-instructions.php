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

if ( is_plugin_active( 'azrcrv-shortcodes-in-comments/azrcrv-shortcodes-in-comments.php' ) ) {
	$plugin_comment = '<a href="admin.php?page=azrcrv-sic" class="azrcrv-plugin-index">Shortcodes in Comments</a>';
} else {
	$plugin_comment = '<a href="https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-comments/" class="azrcrv-plugin-index">Shortcodes in Comments</a>';
}
if ( is_plugin_active( 'azrcrv-shortcodes-in-widgets/azrcrv-shortcodes-in-widgets.php' ) ) {
	$plugin_widget = '<a href="admin.php?page=azrcrv-siw" class="azrcrv-plugin-index">Shortcodes in Widgets</a>';
} else {
	$plugin_widget = '<a href="https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-widgets/" class="azrcrv-plugin-index">Shortcodes in Widgets</a>';
}

$plugin_output = '<label for="additional-plugins"><strong>azurecurve | Development</strong> ' . esc_html__( 'has the following plugins which allow shortcodes to be used in comments and widgets:', 'azrcrv-i' ) . '</label>
		<ul class="azrcrv-plugin-index">
			<li>
				' .

				$plugin_comment

				. '
			</li>
			<li>
				' .

				$plugin_widget

				. '
			</li>
		</ul>';

$tab_instructions_label = esc_html__( 'Instructions', 'azrcrv-i' );
$tab_instructions       = '
<table class="form-table azrcrv-settings">

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .
				sprintf( esc_html__( '%1$s allows an icon to be displayed in a post or page using the %2$s shortcode.', 'azrcrv-i' ), 'Icons', '<strong>[icon]</strong>' )

			. '</p>
		
		</td>
	
	</tr>

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .

				sprintf( esc_html__( 'The format of the shortcode is %1$s to display the %2$s icon; replace the word after the %3$s with the name from the available icons.', 'azrcrv-i' ), '<strong>[icon=accept]</strong>', '<strong>accept</strong>', '<strong>=</strong>' )

			. '</p>
		
		</td>
	
	</tr>
	
	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="azrcrv-i">' . esc_html__( 'Compatible Plugins', 'azrcrv-i' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>
				
				' . $plugin_output . '
				
			</p>
		
		</td>
	
	</tr>
	
</table>';
