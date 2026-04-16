<?php

namespace Wp_Minds_Skill_Assessment_Task\Shortcodes;

use Wp_Minds_Skill_Assessment_Task\Core\Singleton;

// Prevent direct access
if (! defined('ABSPATH')) {
	exit;
}

/**
 * Reviews class
 *
 * @package Wp_Minds_Skill_Assessment_Task\Shortcodes
 */
class Reviews extends Singleton {
	/**
	 * Initializes the class execution flow.
	 * 
	 * @return void
	 */
	protected function __run() {
		add_shortcode( 'wpmsat_reviews', array( $this, 'render_reviews' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );
	}

	/**
	 * Enqueue assets
	 * 
	 * @return void
	 */
	public function assets() {
		wp_register_style( 'wpmsat-reviews-styles', WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_URL . 'assets/css/shortcode-reviews-styles.css', [], WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_VERSION );
		wp_register_script( 'wpmsat-reviews-script', WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_URL . 'assets/js/shortcode-reviews-script.js', array( 'jquery' ), WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_VERSION, true );
	}

	/**
	 * Render reviews
	 * 
	 * @return string
	 */
	public function render_reviews( $atts ) {
		$atts = shortcode_atts( array(
			'style'    => 'slider', // slider or list
			'grid'     => 3, // number of columns for slider
			'per_page' => 10, // number of reviews to display
		), $atts );
		
		if ( $atts['per_page'] < 1 ) {
			$atts['per_page'] = -1;
		}
		
		if ( $atts['grid'] < 1 ) {
			$atts['grid'] = 3;
		}
		
		if ( $atts['grid'] > 6 ) {
			$atts['grid'] = 6;
		}

		ob_start();

		include WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_DIR . 'views/shortcodes/reviews.php';

		return ob_get_clean();
	}
}
