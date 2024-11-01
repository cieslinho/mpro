<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */

$benefits_content = get_field('benefits_content', 'option');

?>
<div class="product__benefits">
    <?php
if ($benefits_content) : // Sprawdzenie, czy grupa pól jest wypełniona
    foreach ($benefits_content['benefit_box'] as $benefit_box) : // Iteracja po każdym elemencie powtarzalnym
        $benefit_icon_id = $benefit_box['benefit_icon']; // Pobranie ID pliku ikony
        $benefit_text = $benefit_box['benefit_text']; // Pobranie tekstu korzyści

        // Pobranie URL pliku ikony na podstawie ID
        $benefit_icon_url = wp_get_attachment_image_url($benefit_icon_id, 'full'); // Zwraca URL na podstawie ID

        // Wyświetlenie ikony i tekstu
        ?>
        
        <div class="product__benefit">
            <?php if ($benefit_icon_url) : ?>
                <img src="<?php echo esc_url($benefit_icon_url); ?>" alt="<?php echo esc_attr($benefit_text); ?>" class="product__benefit-img" />
            <?php else : ?>
                <p>Brak ikony dla tej korzyści. ID: <?php echo esc_html($benefit_icon_id); ?></p>
            <?php endif; ?>
            <p class="product__benefit-text"><?php echo esc_html($benefit_text); ?></p>
        </div>
        
        <?php
    endforeach;
endif;
?>
</div>
