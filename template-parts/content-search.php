<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
        
        // check if the flexible content field has rows of data
        if( have_rows('food_more_content') ):

             // loop through the rows of data
            while ( have_rows('food_more_content') ) : the_row();

                if( get_row_layout() == 'book_reference' ):
                    $recipe_book_title = get_sub_field('recipe_book_title');
                    $life_icon_color = get_sub_field('life_icon_color');
                endif;

                if( get_row_layout() == 'food_information' ):
                    $food_image = get_sub_field('food_image');

                    ?>
                        <div class="book-ref-wrapper clearfix">
                            <div class="book-ref-content">
                                <a href="<?php the_permalink() ?>">
                                    <?php
                                        $book_ref_img = wp_get_attachment_image($food_image['id'], 'full', false);
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
                                <?php if ($recipe_book_title) { ?>
                                    <p class="recipe-book-title" style="background-color: <?php echo $life_icon_color; ?>"><?php echo $recipe_book_title; ?></p>
                                <?php } ?>
                                <h4 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                            </div>
                        </div>
                    <?php
                endif;
            endwhile;
        endif;
    ?>

</article><!-- #post-## -->

