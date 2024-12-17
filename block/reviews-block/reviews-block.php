<?
$reviews_content = get_field('reviews_content');
$heading = $reviews_content['heading'];

?>


<section class="reviews">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html( $heading ); ?></h2>
        <div class="reviews__content">
           <?php echo do_shortcode( ' [grw id=71434] ' ); ?> 
        </div>
    </div>
</section>