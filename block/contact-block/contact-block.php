<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */


$contact_content = get_field( 'contact-content' );
$heading      = $contact_content['heading'];
$text_editor = $contact_content['text-editor'];
$img = $contact_content['img'];


?>

<section class="contact">
    <div class="container">

        <div class="contact__boxes">
            <div class="contact__info">
                
                 <h2 class="contact__title"><?php echo esc_html( $heading ); ?></h2>
                 <div class="contact__text">
                     <?php echo ( $text_editor ); ?>
                 </div>
                <?php if ( $img ): ?>
                    
                        <img class="contact__img" src="<?php echo esc_url( wp_get_attachment_image_url( $img, 'full' ) ); ?>" alt="<?php echo esc_attr( get_post_meta( $img, '_wp_attachment_image_alt', true ) ); ?>">
                    
                <?php endif; ?>

               
            </div>
            <div class="contact__form">
                [contact-form-7 id="d122af3" title="formularz kontaktowy"]
            </div>
        </div>
    </div>
</section>

