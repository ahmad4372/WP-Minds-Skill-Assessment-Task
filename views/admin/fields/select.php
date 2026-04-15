<?php
/**
 * Select field view
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
<select class="regular-text" name="<?php echo esc_attr( $option_name ); ?>">
    <?php foreach ( $args['options'] as $option => $option_label ) : ?>
        <option value="<?php echo esc_attr( $option ); ?>" <?php selected( $option_value, $option ); ?>><?php echo esc_html( $option_label ); ?></option>
    <?php endforeach; ?>
</select>
<?php 
if ( ! empty( $args['desc'] ) ) {
    ?>
    <p class="description"><?php echo esc_html( $args['desc'] ); ?></p>
    <?php
}