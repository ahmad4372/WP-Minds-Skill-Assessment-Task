<?php
/**
 * Reviews shortcode view
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$reviews = get_posts( [
    'post_type'      => 'reviews',
    'posts_per_page' => $atts['per_page'],
    'fields'         => 'ids',
] );

if ( empty( $reviews ) ) {
    ?>
    <p>
		<?php
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$reviews_post_type_title = wpmsat_get_setting( 'reviews_post_type_title' );
		// translators: %s: Reviews post type title
		echo sprintf( esc_html__( 'No %s found', 'wp-minds-skill-assessment-task' ), esc_html( $reviews_post_type_title ) );
		?>
	</p>
    <?php
    
    return;
}

wp_enqueue_style( 'wpmsat-reviews-styles' );
if ( $atts['style'] === 'slider' ) {
	wp_enqueue_script( 'wpmsat-reviews-script' );
}

?>
<div class="wpmsat-reviews-container <?php echo esc_attr( $atts['style'] === 'slider' ? 'wpmsat-reviews-slider' : 'wpmsat-reviews-grid' ); ?>" data-slides-per-view="<?php echo esc_attr( $atts['grid'] ); ?>" style="--wpmsat-reviews-grid-columns: <?php echo esc_attr( $atts['grid'] ); ?>;">
    <div class="wpmsat-reviews">
        <?php
		// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
        foreach ( $reviews as $review_id ) {
			$review_content = get_post_meta( $review_id, '_content', true );
			$review_author  = get_post_meta( $review_id, '_author_name', true );
			$review_tagline = get_post_meta( $review_id, '_author_tagline', true );
			$icon_types     = [ 'retro', 'robohash', 'monsterid', 'wavatar', 'identicon', 'mystery', 'mm', 'mysteryman' ];
			$icon_type 		= $icon_types[ wp_rand( 0, count( $icon_types ) - 1 ) ];
            ?>
            <div class="wpmsat-review">
                <div class="wpmsat-review-author">
					<?php echo get_avatar( $review_id, 48, $icon_type ); ?>
					<div>
						<h4><?php echo esc_html( $review_author ); ?></h4>
						<p><?php echo esc_textarea( $review_tagline ); ?></p>
					</div>
				</div>
				<h3 class="wpmsat-review-title"><?php echo esc_html( get_the_title( $review_id ) ); ?></h3>
                <div class="wpmsat-review-content">
                    <?php echo esc_textarea( $review_content ); ?>
                </div>
            </div>
            <?php 
        }
		// phpcs:enable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
        ?>
    </div>
	<?php 
	if ( $atts['style'] === 'slider' ) {
		?>
		<div class="wpmsat-reviews-navigation">
			<button class="wpmsat-reviews-prev"><?php esc_html_e( 'Previous', 'wp-minds-skill-assessment-task' ); ?></button>
			<button class="wpmsat-reviews-next"><?php esc_html_e( 'Next', 'wp-minds-skill-assessment-task' ); ?></button>
		</div>
		<?php
	}
	?>
</div>