<?php
/**
 * Text field view
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( empty( $args ) ) {
    return;
}

$option_name = $args['name'];
$option_value = get_option( $option_name, $args['default'] );
$option_value = empty( $option_value ) ? $args['default'] : $option_value;
?>
<input type="text" class="regular-text" name="<?php echo esc_attr( $option_name ); ?>" value="<?php echo esc_attr( $option_value ); ?>">
<?php 
if ( ! empty( $args['desc'] ) ) {
    ?>
    <p class="description"><?php echo esc_html( $args['desc'] ); ?></p>
    <?php
}