<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */


$partners_content = get_field('partners-content');
$heading      = $partners_content['heading'];
$section_btn = $partners_content['section-btn'];
$section_link = $partners_content['section-link'];


?>

<section class="partners">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html($heading) ?></h2>
<?php 
if( $partners_content && isset($partners_content['partner']) ): ?>
    <div class="partners__boxes">
        <?php foreach( $partners_content['partner'] as $partner ): 
            $partner_img_id = $partner['partner-img']; 
            $partner_link = $partner['partner-link'];
            $partner_img_url = wp_get_attachment_image_url( $partner_img_id, 'full' );
            $partner_img_alt = get_post_meta( $partner_img_id, '_wp_attachment_image_alt', true );
        ?>
            
                <a class="partners__box"  href="<?php echo esc_url($partner_link); ?>" target="_blank">
                    <img src="<?php echo esc_url($partner_img_url); ?>" alt="<?php echo esc_attr($partner_img_alt); ?>">
                </a>
           
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<a href="<?php echo esc_html( $section_link ); ?>" class="section-btn"><?php echo esc_html( $section_btn ); ?></a>
</div>




</section>