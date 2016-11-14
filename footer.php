<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

        </div><!-- /site-content -->

        <?php if ( is_active_sidebar( 'hbnc-bottom' ) ) : ?>
            <?php dynamic_sidebar( 'hbnc-bottom' ); ?>
        <?php endif; ?>
    </div><!-- /site-inner -->

</div><!-- .site -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <?php if ( has_nav_menu( 'primary' ) ) : ?>
        <nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'twentysixteen' ); ?>">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'primary-menu',
                 ) );
            ?>
        </nav><!-- /main-navigation -->
    <?php endif; ?>

    <?php if ( has_nav_menu( 'social' ) ) : ?>
        <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'social',
                    'menu_class'     => 'social-links-menu',
                    'depth'          => 1,
                    'link_before'    => '<span class="screen-reader-text">',
                    'link_after'     => '</span>',
                ) );
            ?>
        </nav><!-- /social-navigation -->
    <?php endif; ?>

    <div class="site-inner">
        <div class="footer-top clearfix">
            <?php if ( is_active_sidebar( 'hbnc-footer' ) ) : ?>
                <?php dynamic_sidebar( 'hbnc-footer' ); ?>
            <?php endif; ?>

            <div class="link-wrapper left-links clearfix">
                <div class="link-item hbnc-link">
                    <a href="<?php echo get_site_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/icon-abc.png" alt=""></a>
                    <a href="<?php echo get_site_url(); ?>">ほぼ日ホームヘ</a>
                </div>
                <div class="link-item">
                    <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/icons/icon-email.png" alt=""></a>
                    <a href="mailto:postman@1101.com?subject=飯島奈美%20LIFE">感想を送る</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; Hobo nikkan itoi shinbun</span>
        </div>
    </div>
</footer><!-- /site-footer -->

<!-- side menu -->
<?php if(is_single()) : ?>
    <div id='side-mn' class="side-menu">
        <span class="recipe-btn to-recipe"></span>
        <span class="step-btn to-step"></span>
    </div>
<?php endif; ?>
<!-- /side menu -->

<?php if(is_single()) : ?>
    <?php if( have_rows('food_more_content') ):

        while ( have_rows('food_more_content') ) : the_row();

            if( get_row_layout() == 'food_information' ): ?>

                <!-- side menu -->
                <div class="side-menu-content anchor">
                    <!-- recipe content -->
                    <div class="menu-content recipe-content side">
                        <span class="close-icon"></span>
                        <p class="title">材料</p>
            <?php endif;
        endwhile; ?>

        <?php while ( have_rows('food_more_content') ) : the_row();
            if( get_row_layout() == 'food_material' ):
                if( have_rows('food_material_detail') ): ?>

                        <div class="book-material-content scroll-wrapper">

                            <?php while ( have_rows('food_material_detail') ) : the_row(); ?>
                                <div class="material-item">
                                    <p class="main-material"><?php the_sub_field('main_material'); ?></p>
                                    <?php if( have_rows('material_info') ): ?>
                                        <ul>
                                            <?php while ( have_rows('material_info') ) : the_row(); ?>
                                                <li class="sub-material"><?php the_sub_field('sub_material'); ?></li>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>

                        </div>

                <?php endif;
            endif;
        endwhile; ?>

        <?php while ( have_rows('food_more_content') ) : the_row();
            if( get_row_layout() == 'food_information' ): ?>

                        <p class="to-step">つくりかた</p>
                        <p class="to-top-btn">LIFE RECIPE の トップヘ</p>
                    </div>
                    <!-- /recipe content -->
                    <!-- menu content -->
                    <div class="menu-content step-content side">
                        <span class="close-icon"></span>
                        <p class="title">つくりかた</p>

                        <?php if( have_rows('food_recipe') ) : ?>
                            <div class="steps-wrapper scroll-wrapper">
                                <?php while ( have_rows('food_recipe') ) : the_row(); ?>

                                    <a href="#" class="step-title"><?php the_sub_field('step_title'); ?></a>

                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>

                        <p class="to-recipe">材料を見る</p>
                        <p class="to-top-btn">LIFE RECIPE の トップヘ</p>
                    </div>
                    <!-- /menu content -->
                </div>
                <!-- /side menu -->

            <?php endif;
        endwhile;
    endif; ?>

<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>

