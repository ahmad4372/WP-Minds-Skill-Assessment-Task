<?php

// Loaded directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'wpmsat_get_setting' ) ) {
    /**
     * Get settings helper function with proper caching.
     * 
     * @param string $setting
     * @return mixed
     */
    function wpmsat_get_setting( $setting ) {
		static $settings = [];
		if ( ! empty( $settings[ $setting ] ) ) {
			return $settings[ $setting ];
		}
		$value = get_option( $setting );
		if ( ! empty( $value ) ) {
			$settings[ $setting ] = $value;

			return $value;
		}
		
		static $default_settings = [];
		if ( empty( $default_settings ) ) {
			$settings_data = \Wp_Minds_Skill_Assessment_Task\Admin\Settings::instance()::get_settings();
			foreach ( $settings_data as $section ) {
				if ( empty( $section['fields'] ) ) {
					continue;
				}
				foreach ( $section['fields'] as $field ) {
					if ( empty( $field['name'] ) ) {
						continue;
					}

					$default_settings[ $field['name'] ] = $field['default'];
				}
			}
		}
		
		return $default_settings[ $setting ] ?? '';
    }
}