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

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$field_option_name  = $args['name'];
$field_option_value = get_option( $field_option_name, $args['default'] );
$field_option_value = empty( $field_option_value ) ? $args['default'] : $field_option_value;
// phpcs:enable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
?>
<input type="text" class="regular-text" name="<?php echo esc_attr( $field_option_name ); ?>" value="<?php echo esc_attr( $field_option_value ); ?>">
<?php 
if ( ! empty( $args['desc'] ) ) {
    ?>
    <p class="description"><?php echo esc_html( $args['desc'] ); ?></p>
    <?php
}