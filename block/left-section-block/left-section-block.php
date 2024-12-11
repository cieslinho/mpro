<?php

$group = get_field( 'group' );
$heading = $group['heading'];
$text_editor = $group['text_editor'];
$img = $group['img'];

?>


<section class="left section">
    <div class="container">
        <div class="section__boxes">
            <div class="section__info">
                <h2 class="section__title"><?php echo esc_html( $heading ); ?></h2>
                <div class="section__text">
                    <?php echo ( $text_editor ); ?>
                </div>
            </div>
            <div class="section__img">
            <?php if ( $img ): ?>
                    
                    <img src="<?php echo esc_url( wp_get_attachment_image_url( $img, 'full' ) ); ?>" alt="<?php echo esc_attr( get_post_meta( $img, '_wp_attachment_image_alt', true ) ); ?>">
                
            <?php endif; ?>
            </div>

        </div>
    </div>
</section>