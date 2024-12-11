<?php

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
/**
 * @package MPro
 */
get_header();
?>

<section class="posts">
    <div class="container">
    <div class="posts__posts">
    <?php 
    $query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 10, // Liczba wpisów na stronie
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    ));

    
    if ($query->have_posts()) : 
        while ($query->have_posts()) : $query->the_post(); 
    ?>
    
        <article id="post-<?php the_ID(); ?>" class="posts__post">
            
            
            
           <div class="posts__top">
            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium', array('class' => 'posts__thumbnail')); ?>
                </a>
            <?php endif; ?>
            </div>
            
            

            <div class="posts__bottom">
            <div class="posts__meta">
            <?php if (get_the_category()) : ?>
                <div class="posts__categories">
                 <?php display_categories(get_the_category()); ?>
                 </div>
            <?php endif; ?>

          
            <?php if (get_the_tags()) : ?>
                <div class="posts__tags">
                <?php display_tags(get_the_tags()); ?>
                </div>
            <?php endif; ?>
            </div>

            <h2 class="posts__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        
            <div class="posts__date">
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
            </div>
          
           
         
        </article>
        
    <?php 
        endwhile; 
        // Paginacja
?>
    </div>
        <?php the_posts_pagination();
    else : 
    ?>
        <p>Brak wpisów do wyświetlenia.</p>
    <?php endif; wp_reset_postdata(); ?>
    </div>
</section>

<?php
get_footer();
?>
