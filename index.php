<?php
/**
 * Theme Name: Hobonichi Theme
 *
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="section-top clearfix">

                <div class="top-left">
                    <div class="image-wrapper">
                        <img src="<?php bloginfo('template_directory'); ?>/images/top1.jpg"  alt="life-recipe" width="170" height="170">
                    </div>
                    <div class="image-wrapper">
                        <img src="<?php bloginfo('template_directory'); ?>/images/top2.jpg"  alt="life-recipe" width="170" height="170">
                    </div>
                    <div class="image-wrapper">
                        <img src="<?php bloginfo('template_directory'); ?>/images/top3.jpg"  alt="life-recipe" width="170" height="170">
                    </div>
                </div>

                <div class="top-middle">
                    <img src="<?php bloginfo('template_directory'); ?>/images/life-recipe.png" alt="">
                    <h2 class="page-title"><?php echo get_theme_mod( 'page_title', 'No page title information has been saved yet.' ); ?></h2>
                    <div class="mb-image mb-show clearfix">
                        <div class="image-wrapper">
                            <img src="<?php bloginfo('template_directory'); ?>/images/top1.jpg" alt="life-recipe" width="170" height="170">
                        </div>
                        <div class="image-wrapper">
                            <img src="<?php bloginfo('template_directory'); ?>/images/top2.jpg" alt="life-recipe" width="170" height="170">
                        </div>
                        <div class="image-wrapper">
                            <img src="<?php bloginfo('template_directory'); ?>/images/top3.jpg" alt="life-recipe" width="170" height="170">
                        </div>
                        <div class="image-wrapper">
                            <img src="<?php bloginfo('template_directory'); ?>/images/top4.jpg" alt="life-recipe" width="170" height="170">
                        </div>
                    </div>
                    <p class="page-desc"><?php echo get_theme_mod( 'page_desc', '' ); ?></p>
                </div>

                <div class="top-right">
                    <div class="image-wrapper">
                        <img src="<?php bloginfo('template_directory'); ?>/images/top4.jpg"  alt="life-recipe" width="170" height="170">
                    </div>
                    <div class="image-wrapper">
                        <img src="<?php bloginfo('template_directory'); ?>/images/top5.jpg"  alt="life-recipe" width="170" height="170">
                    </div>
                    <div class="image-wrapper">
                        <img src="<?php bloginfo('template_directory'); ?>/images/top6.jpg"  alt="life-recipe" width="170" height="170">
                    </div>
                </div>

            </div>
            
            <div class="form-wrapper">
                <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                    <label>
                        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
                        <input type="search" class="search-field mb-hide"
                            placeholder="<?php echo esc_attr_x( '材料名・料理名からも探すことができます。', 'placeholder' ) ?>"
                            value="<?php echo get_search_query() ?>" name="s"
                            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                        <input type="search" class="search-field mb-show"
                            placeholder="<?php echo esc_attr_x( '材料名・料理名', 'placeholder' ) ?>"
                            value="<?php echo get_search_query() ?>" name="s"
                            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                    </label>
                    <input type="submit" class="search-submit"
                        value="<?php echo esc_attr_x( '', 'submit button' ) ?>" />
                </form>
            </div>

        <?php
            $args = array(
                'post_type' => 'post',
                'paged' => ( get_query_var('paged') ) ? get_query_var('paged') : 1
            );

            $loop = new WP_Query($args);
            $ppp = get_option('posts_per_page');

            echo '<div class="post-list">';

                if ( $loop->have_posts() ) :

                    echo '<div class="row">';

                        // Start the loop.
                        while ( $loop->have_posts() ) : $loop->the_post();
                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            ?>

                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                            </div>
                            <div class="clear1"></div>
                        <?php

                        endwhile; // End the loop.

                        global $wp_query;
                        $wp_query_org = $wp_query;
                        $wp_query = $loop;

                        $wp_query = $wp_query_org;
                        wp_reset_postdata();

                    echo '</div>';

                    $count_posts = (int)wp_count_posts()->publish;

                else :
                    get_template_part( 'template-parts/content', 'none' );
                endif;

            echo '</div>';

            $click = round( $count_posts/$ppp, 0, PHP_ROUND_HALF_EVEN) - 1;
            echo '<p class="load-more-text"><span>ぜんぶで' . $count_posts . '件のレシピがあります。</span></p>';
            echo '<p class="load-more-button" data-click="' . $click . '"><span id="loadmore-button" class="load-more">つぎへ</span></p>';

            twentyfourteen_paging_nav();
        ?>

        </main><!-- .site-main -->

    </div><!-- .content-area -->

<?php get_footer(); ?>
