<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pet Care Zone
 */

$pet_care_zone_post_page_title =  get_theme_mod( 'pet_care_zone_post_page_title', 1 );
$pet_care_zone_post_page_thumb =  get_theme_mod( 'pet_care_zone_post_page_thumb', 1 );
$pet_care_zone_post_page_cat =  get_theme_mod( 'pet_care_zone_post_page_cat', 1 );

?>

<div class="col-lg-6 col-md-6 col-sm-6">
    <article id="post-<?php the_ID(); ?>" <?php post_class('article-box'); ?>>
        <?php if ($pet_care_zone_post_page_thumb == 1 ) {?>
            <?php pet_care_zone_post_thumbnail(); ?>
        <?php }?>
        <header class="entry-header">
            <?php if ($pet_care_zone_post_page_title == 1 ) {?>
                <?php the_title('<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>');?>
            <?php }?>
        </header>
        <div class="entry-summary">
            <?php
                the_excerpt();

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'pet-care-zone'),
                    'after' => '</div>',
                ));
            ?>
        </div>
        <?php if ($pet_care_zone_post_page_cat == 1 ) {?>
            <footer class="entry-footer">
                <?php pet_care_zone_entry_footer(); ?>
            </footer>
        <?php }?>
    </article>
</div>