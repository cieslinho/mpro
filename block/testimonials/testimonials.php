<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */


$block_content = get_field( 'block-testimonials' );
$heading       = $block_content['heading'];
?>

<div class="testomonials">
    <div class="testimonials__container">
        <h2 class="testimonials__heading">
            <?php echo esc_html( $heading ); ?>
        </h2>
    </div>
</div>