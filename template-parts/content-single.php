<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content">

        <?php

        $title_for_top = get_field('title_for_top');

        // check if the flexible content field has rows of data
        if( have_rows('food_more_content') ):?>

            <div class="food-information">

                <?php while ( have_rows('food_more_content') ) : the_row();
                    if( get_row_layout() == 'book_reference' ):
                        $recipe_book_title = get_sub_field('recipe_book_title');
                        $life_icon_color = get_sub_field('life_icon_color');
                    endif;

                    if( get_row_layout() == 'food_information' ):
                        $large_food_image = get_sub_field('large_food_image');

                        if (isset($large_food_image['url'])): ?>
                        <div class="food-info-top clearfix">
                        <?php else: ?>
                        <div class="food-info-top clearfix no-thumb">
                        <?php endif; ?>

                            <div class="image-wrapper">
                                <?php
                                    $large_food_img = wp_get_attachment_image($large_food_image['id'], 'full', false);
                                    echo wp_kses($large_food_img,
                                        array(
                                            'img' => array(
                                                'class' => array(),
                                                'width' => array(),
                                                'height' => array(),
                                                'sizes' => array(),
                                                'srcset' => array(),
                                                'alt' => array(),
                                                'src' => array(),

                                            )
                                        )
                                    );
                                ?>
                            </div>

                            <div class="info-right">
                                <p class="post-title"><?php the_title(); ?></p>
                                <?php if ($recipe_book_title) { ?>
                                    <p class="book-title" style="background-color: <?php echo $life_icon_color; ?>"><?php echo $recipe_book_title; ?></p>
                                <?php }; ?>
                            </div>
                            
                        </div>
                        <!-- /food info top -->

                        <p class="long-desc"><?php the_sub_field('long_description'); ?></p>
                    <?php endif; ?>

                <?php endwhile; ?>
            </div>
            <!-- / food information -->
        <?php endif;

        if( have_rows('food_more_content') ):
             // loop through the rows of data
            while ( have_rows('food_more_content') ) : the_row();
                if( get_row_layout() == 'food_material' ):
                    ?>
                        <div class="food-ingredient-wrapper">
                            <div class="food-ingredient clearfix">

                                <div class="book-material-content">
                                    <?php
                                    // check if the repeater field has rows of data
                                        if( have_rows('food_material_detail') ):
                                            // loop through the rows of data
                                            while ( have_rows('food_material_detail') ) : the_row();
                                                ?>
                                                <div class="material-item">
                                                    <p class="main-material"><?php the_sub_field('main_material'); ?></p>
                                                    <?php
                                                    if( have_rows('material_info') ): ?>
                                                        <ul>
                                                            <?php
                                                            // loop through the rows of data
                                                            while ( have_rows('material_info') ) : the_row(); ?>
                                                                <li class="sub-material"><?php the_sub_field('sub_material'); ?></li>
                                                            <?php endwhile; ?>
                                                        </ul>
                                                    <?php
                                                    endif; ?>
                                                </div>
                                            <?php endwhile;
                                        endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- ./ food-material-wrapper -->
                    <?php
                endif;
            endwhile;
        endif;

        if( have_rows('food_recipe') ): ?>
            <div class="how-to-make">
                <h4 class="title">つくりかた</h4>
                <?php
                // loop through the rows of data
                while ( have_rows('food_recipe') ) : the_row();

                    $step_image = get_sub_field('step_image'); ?>
                    
                    <div class="step-wrapper anchor">
                        <div class="step-image lazy">
                            <?php
                                if ( $step_image ) : ?>
                                    <img src="<?php echo $step_image['url']; ?>" data-original="<?php echo $step_image['url']; ?>" width="<?php echo $step_image['width']; ?>" height="<?php echo $step_image['height']; ?>" alt="<?php echo $step_image['title']; ?>" title="<?php echo $step_image['title']; ?>" />
                                <?php endif;
                            ?>
                            <div class="stepOrder"></div>
                        </div>
                        <p class="step-desc"><?php the_sub_field('step_description'); ?></p>
                        <a href="#" class="prev-step-btn">まえへ</a>
                        <a href="#" class="next-step-btn">つぎへ</a>
                        <a href="#" class="current-step-btn">current</a>
                    </div>

                <?php endwhile; ?>
                <span class="mb-switch-step-btn mb-prev-step-btn">まえへ</span>
                <span class="mb-switch-step-btn mb-next-step-btn">つぎへ</span>
            </div>
        <?php endif; ?>

        <?php if( have_rows('food_more_content') ):

            while ( have_rows('food_more_content') ) : the_row();

                if( get_row_layout() == 'book_reference' ):
                    $recipe_book_title = get_sub_field('recipe_book_title');

                    $book_image = get_sub_field('book_image'); ?>

                    <div class="book-ref-wrapper">
                        <div class="book-ref clearfix">
                            <h4 class="book-title">このレシピは、<?php echo $recipe_book_title; ?>に収録されています。</h4>
                            <div class="book-ref-content">
                                <a href="<?php the_sub_field('book_link'); ?>" class="tag-wrapper">
                                    <?php
                                        $book_ref_img = wp_get_attachment_image($book_image['id'], 'full', false);
                                        echo wp_kses($book_ref_img,
                                            array(
                                                'img' => array(
                                                    'class' => array(),
                                                    'width' => array(),
                                                    'height' => array(),
                                                    'sizes' => array(),
                                                    'srcset' => array(),
                                                    'alt' => array(),
                                                    'src' => array(),

                                                )
                                            )
                                        );
                                    ?>
                                </a>
                                <div class="book-content-right">
                                    <p class="book-desc"><?php the_sub_field('book_desc'); ?></p>
                                    <a class="detail" href="<?php the_sub_field('book_link'); ?>">くわしくはこちら</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif;

            endwhile;

        endif; ?>

        <div class="hbnc-navigation clearfix">
            <?php previous_post_link('%link', 'まえへ', TRUE); ?>
            <a href="<?php echo get_site_url(); ?>/" class="to-home">LIFE RECIPEのトップヘ</a>
            <?php next_post_link('%link', 'つぎへ', TRUE); ?>
            <div>
                <a href="<?php echo get_site_url(); ?>/" class="to-home btn-mb">LIFE RECIPEのトップヘ</a>
            </div>
        </div>

    </div><!-- .entry-content -->
</article><!-- #post-## -->

