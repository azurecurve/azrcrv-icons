<?php
/*
	plugin functionality
*/

/**
 * Declare the Namespace.
 *
 * @since 1.0.0
 */
namespace azurecurve\Icons;

/**
 * Get all flags (both custom and standard).
 *
 * @since 1.9.0
 */
function get_icons() {

	$options = get_option_with_defaults( PLUGIN_HYPHEN );

	$dir   = $options['folder'];
	$icons = array();
	if ( is_dir( $dir ) ) {
		if ( $directory = opendir( $dir ) ) {
			// phpcs:ignore.
			while ( ( $file = readdir( $directory ) ) !== false ) {
				// echo $file;
				if ( substr( $file, -3 ) == 'png' ) {
					$filewithoutext           = preg_replace( '/\\.[^.\\s]{3,4}$/', '', $file );
					$icons[ $filewithoutext ] = array(
						'type' => 'custom',
					);
				}
			}
			closedir( $directory );
		}
	}

	$dir = plugin_dir_path( __FILE__ ) . '../assets/icons';
	if ( is_dir( $dir ) ) {
		if ( $directory = opendir( $dir ) ) {
			// phpcs:ignore.
			while ( ( $file = readdir( $directory ) ) !== false ) {
				// echo $file;
				if ( substr( $file, -3 ) == 'png' ) {
					$filewithoutext = preg_replace( '/\\.[^.\\s]{3,4}$/', '', $file );
					if ( ! array_key_exists( $filewithoutext, $icons ) ) {
						$icons[ $filewithoutext ] = array(
							'type' => 'standard',
						);
					}
				}
			}
			closedir( $directory );
		}
	}

	ksort( $icons );

	return $icons;
}


/**
 * Shortcode display icon.
 *
 * @since 1.0.0
 */
function shortcode_display_icon( $atts, $content = null ) {

	$options = get_option_with_defaults( PLUGIN_HYPHEN );

	if ( empty( $atts ) ) {
		$icon = 'none';
	} else {
		$attribs = implode( '', $atts );
		$icon    = trim( trim( trim( trim( trim( $attribs, '=' ), '"' ), "'" ), '&#8217;' ), '&#8221;' );
	}

	if ( file_exists( trailingslashit( esc_attr( $options['folder'] ) ) . esc_attr( $icon ) . '.png' ) ) {
		$src = esc_attr( $options['url'] ) . esc_attr( $icon ) . '.png';
	} else {
		$src = plugin_dir_url( __FILE__ ) . '../assets/icons/' . esc_attr( $icon ) . '.png';
	}

	// phpcs:ignore.
	if ( @getimagesize( $src ) ) {
		$return = "<img class='azrcrv-i' src='$src' alt= '" . esc_html( $icon ) . "' />";
	} else {
		$return = '';
	}

	return $return;

}
