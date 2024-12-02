<?
function display_categories($categories) {
    foreach ($categories as $category) {
        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a> ';
    }
}

function display_tags($tags) {
    foreach ($tags as $tag) {
        echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a> ';
    }
}

?>

<?php get_header(); ?>

<section class="post">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post(); ?>
        
            <div class="post__boxes">
                <div class="post__left">
                    <div class="post__top">
                        <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large'); ?>
                        <?php endif; ?>

                        <div class="post__date">
                        <span class="day">
                                <?php echo esc_html(get_the_date('j')); ?>
                            </span>
                            <span class="month">
                                <?php echo esc_html(get_the_date('M')); ?>
                            </span>
                            <span class="year">
                                <?php echo esc_html(get_the_date('Y')); ?>
                            </span>
            </div>

                        <div class="post__info">

                        <div class="post__meta">
                        <?php if (get_the_category()) : ?>
                            <div class="post__categories">

                                <?php display_categories(get_the_category()); ?>
                                
                            </div>

                            <?php endif; ?>

                            <?php if (get_the_tags()) : ?>
                            <div class="post__tags">

                                <?php display_categories(get_the_tags()); ?>
                                
                            </div>

                            <?php endif; ?>

                        </div>
                            
                            <h1 class="post__title">
                                <?php the_title(); ?>
                            </h1>

                            
                            
                        </div>



                    </div>
                    <div class="post__content">
                        <?php the_content(); ?>
                    </div>
                </div>
                <div class="post__right">
                <div class="post__related">
    <h2>
        <?php esc_html_e('Ostatnie najnowsze wpisy', 'textdomain'); ?>
    </h2>
    <ul class="post__related-items">
        <?php
        $recent_posts = new WP_Query(array(
            'posts_per_page' => 5, // Liczba najnowszych wpisów
            'post_status'    => 'publish', // Tylko opublikowane posty
            'post__not_in'   => array(get_the_ID()), // Wyklucz bieżący post
        ));

        if ($recent_posts->have_posts()) :
            while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                <li class="post__related-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('thumbnail', array('class' => 'post__related-thumbnail')); ?>
                        </a>
                    <?php endif; ?>
                    <div class="post__related-content">
                        <a href="<?php the_permalink(); ?>" class="post__related-title">
                            <?php the_title(); ?>
                        </a>
                        <span class="post__related-date">
                            <?php echo get_the_date(); ?>
                        </span>
                    </div>
                </li>
            <?php endwhile;
            wp_reset_postdata(); // Przywrócenie globalnych danych po WP_Query
        else : ?>
            <li>
                <?php esc_html_e('Brak postów', 'textdomain'); ?>
            </li>
        <?php endif; ?>
    </ul>
</div>


                </div>
            </div>


       
        <?php endwhile;
        else : ?>
        <p>
            <?php esc_html_e('Sorry, no posts matched your criteria.', 'textdomain'); ?>
        </p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>