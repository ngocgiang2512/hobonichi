<?php
/**
 * The template for displaying search results pages
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

            <?php if ( have_posts() ) : ?>

                <div class="row">

                    <h2 class="page-title">Search Result</h2>

                    <div class="form-wrapper">
                        <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                            <label>
                                <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
                                <input type="search" class="search-field"
                                    placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
                                    value="<?php echo get_search_query() ?>" name="s"
                                    title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                            </label>
                            <input type="submit" class="search-submit"
                                value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
                        </form>
                    </div>
                    
                    <div class="post-list">

                        <div class="row">

                        <?php while ( have_posts() ) : the_post(); ?>

                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <?php get_template_part( 'template-parts/content', 'search' ); ?>
                                </div>
                                <div class="clear1"></div>

                        <?php endwhile;                            
                            wp_reset_postdata(); 
                        ?>

                        </div>

                    </div>

                </div>
                <!-- ./row -->

            <?php else :
                // If no content, include the "No posts found" template.
                get_template_part( 'template-parts/content', 'none' );

            endif; ?>

        </main><!-- .site-main -->

    </div><!-- .content-area -->

<?php get_footer(); ?>
