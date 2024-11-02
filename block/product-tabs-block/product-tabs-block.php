<?php
// Pobierz grupę główną 'tabs_content'
$tabs_content = get_field('tabs_content');

// Pobierz dane z grupy description_content, jeśli istnieje
$description_content = $tabs_content['description_content'] ?? null;
$product_description = $description_content['product_description'] ?? null;

// Pobierz dane z grupy additional_content, jeśli istnieje
$additional_content = $tabs_content['additional_content'] ?? null;
$product_additional = $additional_content['product_additional'] ?? null;

// Pobierz dane z grupy specs_content, jeśli istnieje
$specs_content = $tabs_content['specs_content'] ?? null;
$specs_box = $specs_content['specs_box'] ?? null;

// Pobierz dane z grupy help_content, jeśli istnieje
$help_content = $tabs_content['help_content'] ?? null;
$help_heading = $help_content['help_heading'] ?? null;
$help_text = $help_content['help_text'] ?? null;

$review_count = get_comments_number();
?>

<div class="product__tabs">
    <div class="product__tabs-btns">
        <button class="product__tab active" data-target="description">Opis</button>
        <button class="product__tab" data-target="additional">Dodatkowe Informacje</button>
        <button class="product__tab" data-target="specs">Materiały Techniczne</button>
        <button class="product__tab" data-target="reviews"><?echo sprintf(__('Opinie <span>(%d)</span>', 'woocommerce'), $review_count);?></button>
        <button class="product__tab" data-target="help">Pomoc</button>
    </div>

    <div class="product__tabs-content" style="display: block;" id="description">
        <div class="product__tab-description">
            <?php if ($product_description): ?>
                <?php echo $product_description; ?>
            <?php else: ?>
                <p>Brak Opisu</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="product__tabs-content" id="additional">
        <div class="product__tab-additional">
            <?php if ($product_additional): ?>
                <?php echo $product_additional; ?>
            <?php else: ?>
                <p>Brak Dodatkowych Informacji</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="product__tabs-content" id="specs">
        <?php if ($specs_box): ?>
            <ul class="product__tab-specs">
                <?php foreach ($specs_box as $spec): ?>
                    <?php
                    $specs_icon_id = $spec['specs_icon'] ?? null;
                    $specs_file_id = $spec['specs_file'] ?? null;

                    $specs_icon_url = $specs_icon_id ? wp_get_attachment_url($specs_icon_id) : null;
                    $specs_file_url = $specs_file_id ? wp_get_attachment_url($specs_file_id) : null;
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

   
    <div class="product__tabs-content" id="help">
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
    <div class="product__tabs-content" id="reviews">
    <?php
if (class_exists('WooCommerce') && comments_open()) :

    $review_count = get_comments_number();
   

    $comments = get_comments(array(
        'post_id' => get_the_ID(),
        'status' => 'approve',
    ));

    if ($comments) {
        echo '<ul class="product__tab-reviews">';
        foreach ($comments as $comment) {
            $rating = get_comment_meta($comment->comment_ID, 'rating', true);
            ?>
            <li class="product__comment" id="comment-<?php comment_ID(); ?>">
                <div class="product__comment-content">
                    
                <div class="product__comment-top">
                <div class="product__stars" aria-label="<?php echo esc_attr($rating . ' z 5 gwiazdek'); ?>">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="product__star <?php echo $i <= $rating ? 'product__star-filled' : ''; ?>">&starf;</span>
                        <?php endfor; ?>
                    </div>
                    <div class="product__comment-meta comment-meta">
                        <strong><?php echo get_comment_author($comment); ?></strong> - <?php echo get_comment_date(); ?>
                    </div>
                </div>
                    <div class="product__comment-text comment-text">
                        <?php comment_text(); ?>
                    </div>
                </div>
            </li>
            <?php
        }
        echo '</ul>';
    } else {
        echo '<p>' . __('Brak komentarzy.', 'woocommerce') . '</p>';
    }

    
    $comment_form_args = array(
        'title_reply' => __('Dodaj opinię', 'woocommerce'),
        'comment_notes_after' => '',
        'label_submit' => __('Wyślij opinię', 'woocommerce'),
        'fields' => array(
            'author' => '<p class="comment-form-author">
                            <label for="author">' . __('Twoje imię', 'woocommerce') . '</label>
                            <input id="author" name="author" type="text" required />
                        </p>',
            'email' => '<p class="comment-form-email">
                            <label for="email">' . __('Twój e-mail', 'woocommerce') . '</label>
                            <input id="email" name="email" type="email" required />
                        </p>',
            'rating' => '<p class="comment-form-rating">
                            <label for="rating">' . __('Twoja ocena', 'woocommerce') . '</label>
                            <select name="rating" id="rating" required>
                                <option value="">' . __('Wybierz ocenę', 'woocommerce') . '</option>
                                <option value="5">' . __('5 gwiazdek', 'woocommerce') . '</option>
                                <option value="4">' . __('4 gwiazdki', 'woocommerce') . '</option>
                                <option value="3">' . __('3 gwiazdki', 'woocommerce') . '</option>
                                <option value="2">' . __('2 gwiazdki', 'woocommerce') . '</option>
                                <option value="1">' . __('1 gwiazdka', 'woocommerce') . '</option>
                            </select>
                        </p>',
        ),
        'comment_field' => '<p class="comment-form-comment">
                                <label for="comment">' . __('Treść recenzji', 'woocommerce') . '</label>
                                <textarea id="comment" name="comment" cols="45" rows="8" required></textarea>
                            </p>',
    );

    comment_form($comment_form_args);
else :
    echo '<p>' . __('Recenzje są wyłączone dla tego produktu.', 'woocommerce') . '</p>';
endif;
?>





    </div>
</div>
