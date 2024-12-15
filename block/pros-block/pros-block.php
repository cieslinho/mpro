<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */


$pros_content = get_field( 'pros-content' );
$heading = $pros_content['heading'];
$repeater = $pros_content['box-repeater'];


?>

<section class="pros">
    <div class="container">
        <h2 class="section__title"><?php echo esc_html( $heading ); ?></h2>
        <?
            if ($repeater): ?>
        <div class="pros__boxes">
           
                
                    <?php foreach ($repeater as $item):
                        $title = $item['title'] ?? '';
                        $icon_id = $item['icon'] ?? '';
                        $text = $item['text-editor'] ?? '';
                        $icon_url = $icon_id ? wp_get_attachment_image_url($icon_id, 'full') : '';
                    ?>
                        <div class="pros__box">
                           
        
                            <?php if ($title): ?>
                                <h3 class="pros__box-title"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>

                            <?php if ($icon_url): ?>
                                <div class="pros__box-icon">
                                    <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($title); ?>">
                                </div>
                            <?php endif; ?>
        
                            <?php if ($text): ?>
                                <div class="pros__box-text">
                                    <?php echo wp_kses_post($text); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                
        </div>
            <?php endif;
            ?>
    </div>
</section>
