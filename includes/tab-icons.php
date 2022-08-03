<?php
/*
	Icons tab on settings page
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\Icons;

/**
 * Icons tab.
 */

$options = get_option_with_defaults( PLUGIN_HYPHEN );

$icons       = get_icons();
$icon_output = '';
foreach ( $icons as $icon_id => $icon ) {
	if ( $icon['type'] == 'standard' ) {
		$folder = plugin_dir_url( __FILE__ ) . '../assets/icons/';
	} else {
		$folder = $options['url'];
	}
	
	// phpcs:ignore.
	$icon_output .= '<div class="azrcrv-i"><img style="width: 16px;" src="' . esc_attr( $folder ) . esc_attr( $icon_id ) . '.png' . '" class="azrcrv-i" alt="' . $icon_id . '" /> <strong>' . esc_attr( $icon_id ) . '</strong></div>';
}
$icon_output  = "<p>$icon_output</p>";
$icon_output .= '<p>' . sprintf( esc_html__( 'Included standard icons are from the famfamfam Silk icon set 1.3 by Mark James at %s.', 'azrcrv-i' ), '<a href="http://www.famfamfam.com/lab/icons/silk/">famfamfam</a>' ) . '</p>';

$tab_icons_label = esc_html__( 'Available Icons', 'azrcrv-i' );
$tab_icons       = '
<table class="form-table azrcrv-settings">

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .

				esc_html__( 'This list of icons includes all standard icons, plus any custom icons you have uploaded.', 'azrcrv-i' )

			. '</p>
		
		</td>
	
	</tr>

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .

				$icon_output

			. '</p>
		
		</td>
	
	</tr>
	
</table>';
