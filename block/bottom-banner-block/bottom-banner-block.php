<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */

$banner_content = get_field('banner-content-bottom', 'option');
$textEditor     = $banner_content['text_editor'];
$img_id         = $banner_content['image'];

// Pobranie URL obrazu na podstawie ID
$img_url = wp_get_attachment_image_url($img_id, 'full');
$img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

?>

<div class="banner">
  
        <div class="banner__content">
            <?php if ($img_url) : ?>
                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" />
            <?php endif; ?>

            <div class="banner__texts">
            <?php if ($textEditor) : ?>
                <?php echo wp_kses_post($textEditor); ?>
            <?php endif; ?>
            </div>
        </div>
    
</div>
