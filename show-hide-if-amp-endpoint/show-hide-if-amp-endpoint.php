<?php
/**
 * @package Show/Hide your content if it is an amp endpoint.
 * @version 1.0.0
 */
/*
Plugin Name: Show/Hide If Amp Endpoint
Description: Show/Hide content if it is an amp page. Usage [if_amp_endpoint show="true"]...[/if_amp_endpoint] or [if_amp_endpoint show="false"]...[/if_amp_endpoint]
Author: Selahattin Toprak
Version: 1.0.0
Author URI: https://selahattin.dev
*/

function check_is_amp_endpoint() {
    return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
}
function if_amp_endpoint_shortcode( $atts, $content ) {
    $atts = (array) $atts;
    if ( array_key_exists( "show", $atts ) && $atts['show'] == "true" && check_is_amp_endpoint()) {
        return $content;
    } 
    elseif ( array_key_exists( "show", $atts ) && $atts['show'] == "false" && !check_is_amp_endpoint()){
        return $content;
    } 
    else {
        return "";
    }
}
add_shortcode( 'if_amp_endpoint', 'if_amp_endpoint_shortcode' );