<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */

$latest_news_content = get_field('latest-news-content');
$heading = esc_html($latest_news_content['heading']);
$subheading = esc_html($latest_news_content['subheading']);

// Funkcja do wyświetlania kategorii
function display_categories($categories) {
    foreach ($categories as $category) {
        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a> ';
    }
}

// Funkcja do wyświetlania tagów
function display_tags($tags) {
    foreach ($tags as $tag) {
        echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a> ';
    }
}
?>

<section class="latest">
    <div class="container">
        <h2 class="section-title section-title-margin">
            <?php echo $heading; ?>
        </h2>
        <h4 class="section-subtitle">
            <?php echo $subheading; ?>
        </h4>

        <?php if ($latest_news_content && isset($latest_news_content['article'])): ?>
        <?php
            $article_ids = $latest_news_content['article'];

            $args = array(
                'post_type' => 'post',
                'post__in' => $article_ids,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'posts_per_page' => -1
            );

            $query = new WP_Query($args);
            if ($query->have_posts()): ?>
        <div class="latest__posts">
            <div class="latest__left">
                <div class="latest__left-item">
                    <?php 
                        $query->the_post(); // Pokaż największy post
                        ?>
                    <div class="latest__categories latest__categories-left">
                        <?php display_categories(get_the_category()); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>">
                        <div class="latest__img latest__img-left">
                            <?php if (has_post_thumbnail()): the_post_thumbnail('large'); endif; ?>
                        </div>
                        <div class="latest__date latest__date-left">
                            <span class="day">
                                <?php echo esc_html(get_the_date('j')); ?>
                            </span>
                            <span class="month">
                                <?php echo esc_html(get_the_date('M')); ?>
                            </span>
                        </div>
                        <div class="latest__content latest__content-left">
                            <h3>
                                <?php the_title(); ?>
                            </h3>
                            <p>
                                <?php the_excerpt(); ?>
                            </p>
                        </div>
                    </a>
                    <div class="latest__tags latest__tags-left">
                        <?php display_tags(get_the_tags()); ?>
                    </div>
                </div>
            </div>

            <div class="latest__right">
                <?php while ($query->have_posts()): $query->the_post(); ?>
                <div class="latest__right-item">
                    <div class="latest__categories latest__categories-right">
                        <?php display_categories(get_the_category()); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()): ?>
                        <div class="latest__img latest__img-right">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                        <?php endif; ?>
                        <div class="latest__date latest__date-right">
                            <span class="day">
                                <?php echo esc_html(get_the_date('j')); ?>
                            </span>
                            <span class="month">
                                <?php echo esc_html(get_the_date('M')); ?>
                            </span>
                        </div>
                        <div class="latest__content latest__content-right">
                            <h3>
                                <?php the_title(); ?>
                            </h3>
                            <button class="latest__btn">Czytaj dalej...</button>
                        </div>
                    </a>
                    <div class="latest__tags latest__tags-right">
                        <?php display_tags(get_the_tags()); ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php else: ?>
        <p>No posts found.</p>
        <?php endif; wp_reset_postdata(); ?>
        <?php else: ?>
        <p>No articles selected.</p>
        <?php endif; ?>
    </div>
</section>