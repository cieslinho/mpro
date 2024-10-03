<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */


$block_content = get_field( 'block-text-image' );
$heading       = $block_content['heading'];
$subheading    = $block_content['subheading'];
$content       = $block_content['content'];
$image         = $block_content['image'];

?>

<section class="text-image">
    <div class="text-image__container">
        <div class="text-image__left-side">
            <div class="text-image__heading-wrapper">
                <h2 class="text-image__heading">
                    <?php echo esc_html( $heading ); ?>
                </h2>
                <p class="text-image__subheading">
                    <?php echo esc_html( $subheading ); ?>
                </p>
                <div class="text-image__content">
                    <?php echo wp_kses_post( $content ); ?>
                </div>
            </div>
        </div>
        <div class="text-image__right-side">
            <div class="text-image__image">
                <?php echo wp_get_attachment_image( $image, 'full', false, ['loading' => 'lazy'] ); ?>
            </div>
        </div>
    </div>
</section>
