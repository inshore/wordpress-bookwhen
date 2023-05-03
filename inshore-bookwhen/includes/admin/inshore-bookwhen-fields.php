<?php
/**
 * RP_Analytics_Fields
 *
 * @package RP_Analytics_Fields
 * @since 1.0.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists ( 'rpress_analytics_callback' ) ) {
  function rpress_analytics_callback( $args ) {
     RP_Analytics_Settings::get_template_part( 'analytics-setting-fields' );
  }
}
