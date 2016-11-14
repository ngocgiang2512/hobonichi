<?php
/**
* The template for displaying the header
*
* Displays all of the head element and everything up until the "site-content" div.
*
* @package WordPress
* @subpackage Twenty_Sixteen
* @since Twenty Sixteen 1.0
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <title><?php wp_title(''); ?></title>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php endif; ?>
  <meta name="keywords" content="ほぼ日,飯島奈美,かもめ食堂,ライフ,ＬＩＦＥ,レシピ,いいじまなみ,定番料理,ごちそうさん">
  <meta name="description" content="フードスタイリスト飯島奈美さん×ほぼ日刊イトイ新聞の料理コンテンツ『ＬＩＦＥ』。みんながいちばん好きなものを、いちばんおいしいかたちで。">
  <meta property="og:description" content="フードスタイリスト飯島奈美さん×ほぼ日刊イトイ新聞の料理コンテンツ『ＬＩＦＥ』。みんながいちばん好きなものを、いちばんおいしいかたちで。">
  <meta property="og:title" content="ほぼ日のダイアローグ特集">
  <meta property="og:type" content="article">
  <meta property="og:url" content="http://www.1101.com/life/">
  <meta property="og:image" content="http://www.1101.com/life/">
  <meta property="og:site_name" content="ほぼ日刊イトイ新聞">
  <meta property="fb:app_id" content="372204566174325">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

  <header id="masthead" class="site-header" role="banner">
    <div class="site-header-main">
      <div class="site-branding">
        <div class="site-inner">
          <?php if ( is_single() ) {
              echo '<a href="' . get_site_url() . '/" class="to-home">LIFE RECIPE トップヘ</a>';
              echo '<a href="' . get_site_url() . '/" class="go-back"><img src="' . get_bloginfo('template_directory') .'/images/icons/back-ico.png"><span>もどる</span></a>';
              echo '<span class="header-recipe-icon to-step"><img src="' . get_bloginfo('template_directory') .'/images/icons/carrot-ico.png"><span>材料</span></span>';
              echo '<span class="border-dashed"></span>';
              echo '<span class="header-step-icon to-recipe "><img src="' . get_bloginfo('template_directory') .'/images/icons/menu-bar-ico.png"><span>作り方</span></span>';
          ?>
          <?php } 
          twentysixteen_the_custom_logo(); ?>
        </div>
      </div><!-- .site-branding -->
    </div><!-- .site-header-main -->
  </header><!-- .site-header -->
  
  <nav role="drawer" class="drawer">
    <?php if ( is_single() ) {
      echo '<div class="menu-content recipe-content" id="iscroll-step">';
      // check if the repeater field has rows of data
      if( have_rows('food_recipe') ) : ?>
          <div class="steps-wrapper scroll-wrapper" >
              <ul>
                  <li><p class="title">つくりかた</p><span class="close-icon"></span></li>
                  <?php while ( have_rows('food_recipe') ) : the_row(); ?>
                      <li class="step-title">
                          <a href="#"><?php the_sub_field('step_title'); ?></a>
                      </li>
                  <?php endwhile; ?>
                  <li><p class="to-step">材料</p></li>
                  <li><p class="to-top-btn">LIFE RECIPE の トップヘ</p></li>
              </ul>
          </div>
      <?php endif;
      echo '</div>';

      echo '<div class="menu-content step-content" id="iscroll-recipe">';
      // check if the flexible content field has rows of data
      if( have_rows('food_more_content') ):
           // loop through the rows of data
        while ( have_rows('food_more_content') ) : the_row();
          if( get_row_layout() == 'food_material' ): ?>
            <div class="book-material-content scroll-wrapper">
            <ul>
              <li><p class="title">材料</p><span class="close-icon"></span></li>
              <?php
              // check if the repeater field has rows of data
              if( have_rows('food_material_detail') ):
                  // loop through the rows of data
                  while ( have_rows('food_material_detail') ) : the_row();
                      ?>
                    <li>
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
                    </li>
                  <?php endwhile;
              endif; ?>
                <li><p class="to-recipe">つくりかた</p></li>
                <li><p class="to-top-btn">LIFE RECIPE の トップヘ</p></li>
              </ul>
            </div>
          <?php endif;
        endwhile;
      endif; ?>
      </div>
    <?php } ?>
  </nav>
  <div class="site-inner">
      <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>

      <div id="content" class="site-content">
