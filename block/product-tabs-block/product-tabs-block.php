<div class="product__tabs">
    <div class="product__tabs-btns">
        <button class="product__tab" data-target="description">Opis</button>
        <button class="product__tab" data-target="additional">Dodatkowe Informacje</button>
        <button class="product__tab" data-target="specs">Materiały Techniczne</button>
        <button class="product__tab" data-target="help">Pomoc</button>
    </div>

    <!-- Zakładka Opis produktu -->
    <div class="product__tab-content" id="description">
        <div class="product__tab-description">
            <?php if ($product_description): ?>
                <?php echo $product_description; ?>
            <?php else: ?>
                <p>Brak Opisu</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Zakładka Dodatkowe informacje -->
    <div class="product__tab-content" id="additional">
        <div class="product__tab-additional">
            <?php if ($product_additional): ?>
                <?php echo $product_additional; ?>
            <?php else: ?>
                <p>Brak Dodatkowych Informacji</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Zakładka Specyfikacja -->
    <div class="product__tab-content" id="specs">
        <?php if ($specs_box): ?>
            <ul class="product__tab-specs">
                <?php foreach ($specs_box as $spec): ?>
                    <?php
                    $specs_icon_id = $spec['specs_icon'];
                    $specs_file_id = $spec['specs_file'];
                    
                    // Pobierz URL plików na podstawie ich ID
                    $specs_icon_url = wp_get_attachment_url($specs_icon_id);
                    $specs_file_url = wp_get_attachment_url($specs_file_id);
                    ?>
                    <li class="product__tab-item">
                        <?php if ($specs_icon_url): ?>
                            <img src="<?php echo esc_url($specs_icon_url); ?>" alt="Ikona specyfikacji" class="product__tab-icon">
                        <?php endif; ?>
                        <?php if ($specs_file_url): ?>
                            <a href="<?php echo esc_url($specs_file_url); ?>" class="product__tab-file" download>Pobierz Specyfikację</a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Brak Materiałów Technicznych</p>
        <?php endif; ?>
    </div>

    <!-- Zakładka Pomoc -->
    <div class="product__tab-content" id="help">
        <?php if ($help_heading || $help_text): ?>
            <?php if ($help_heading): ?>
                <h3 class="product__tab-heading"><?php echo esc_html($help_heading); ?></h3>
            <?php endif; ?>
            <?php if ($help_text): ?>
                <div class="product__tab-help">
                    <?php echo $help_text; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
