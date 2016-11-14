"use strict";

jQuery(document).ready(function($) {
    var stepNumber = $('.step-wrapper').length;  
      $('.step-wrapper').each(function(){
        $(this).attr('id','step' + $(this).index());
        $(this).find('.current-step-btn').attr('href','#step' + $(this).index());
        $(this).find('.prev-step-btn').attr('href', '#step' + ($(this).index()-1));
        $(this).find('.next-step-btn').attr('href', '#step' + ($(this).index()+1));
        $(this).find('.stepOrder').append('<span>' + $(this).index() + '</span>/' + stepNumber);        
    });
    
    
    $(window).scroll(function () { 
        if ($('.how-to-make').length) {
        var htm = $('.how-to-make').offset().top;
        var htmHeight = $('.how-to-make').height();
      
        if($(document).scrollTop() > (htm - 100) ) {
          $('.mb-switch-step-btn').show();
        } else {
          $('.mb-switch-step-btn').hide();
        }
        if ($(document).scrollTop() > (htm + htmHeight)){
          $('.mb-switch-step-btn').hide();
        }
      }
    });

    // swipe to switch steps
    var $target = $(".step-wrapper");
    var distance = 0;

    $(window).load(function() {
      var pageY;
      var startTime;
      var distance;

      $target.bind('touchstart', function(e) {
        pageY = window.pageYOffset;
        startTime = +new Date();
      });

      $target.bind('touchend', function(e) {
        var diffY = pageY - window.pageYOffset;
        var absY = Math.abs(diffY);
        var now = +new Date();
        var diffTime = now - startTime;

        if (diffTime < 500 && absY < 200) {
          if (diffY > 0) {
            movePrev();
          } else if (diffY < 0) {
            moveNext();
          }
        } 
      });
    });

    function movePrev() {
      var currentStepHeight;
      var stepWrapper = jQuery('.step-wrapper');
      stepWrapper.removeClass('currentStep');

      var currentStepOffset = 9999,
          scrollTop = $(window).scrollTop();

      stepWrapper.each(function(){
        var elementOffset = jQuery(this).offset().top,
            distance = (elementOffset - scrollTop);
            currentStepOffset = (distance > 0 && distance < currentStepOffset) ? distance : currentStepOffset;   
        if(currentStepOffset == distance) {
          jQuery(this).addClass('currentStep');
          return false;
        }        
      });
        
      jQuery('.currentStep').find('.prev-step-btn').click();
    }

    function moveNext() {
      var currentStepHeight;
      var stepWrapper = jQuery('.step-wrapper');
      stepWrapper.removeClass('currentStep');      

      var currentStepOffset = 9999,
          scrollTop = $(window).scrollTop();

      stepWrapper.each(function(){
        var elementOffset = jQuery(this).offset().top,
            distance = (elementOffset - scrollTop);
            currentStepOffset = (distance > 0 && distance < currentStepOffset) ? distance : currentStepOffset;   
        if(currentStepOffset == distance) {
          jQuery(this).addClass('currentStep');
          return false;
        }               
      });

      jQuery('.currentStep').find('.next-step-btn').click();
    }

    if($('body').hasClass('single')) {
      scrollstep();
    }
    
    document.addEventListener('DOMContentLoaded', scrollstep, false);


    jQuery('.mb-prev-step-btn').on('click', function() {
      var currentStepHeight;
      var stepWrapper = jQuery('.step-wrapper');
      stepWrapper.removeClass('currentStep');

      var currentStepOffset = 9999,
          scrollTop = $(window).scrollTop();

      stepWrapper.each(function(){
        var elementOffset = jQuery(this).offset().top,
            distance = (elementOffset - scrollTop);
            currentStepOffset = (distance > 0 && distance < currentStepOffset) ? distance : currentStepOffset;   
        if(currentStepOffset == distance) {
          jQuery(this).addClass('currentStep');
          return false;
        }    
      });
      
      if(currentStepOffset < 150) {    
        jQuery('.currentStep').find('.prev-step-btn').click();
      } else {
        jQuery('.currentStep').find('.current-step-btn').click();
      }
    });

    jQuery('.mb-next-step-btn').on('click', function() {
      var currentStepHeight;
      var stepWrapper = jQuery('.step-wrapper');
      stepWrapper.removeClass('currentStep');      

      var currentStepOffset = 9999,
          scrollTop = $(window).scrollTop();

      stepWrapper.each(function(){
        var elementOffset = jQuery(this).offset().top,
            distance = (elementOffset - scrollTop);
            currentStepOffset = (distance > 0 && distance < currentStepOffset) ? distance : currentStepOffset;   
        if(currentStepOffset == distance) {
          jQuery(this).addClass('currentStep');
          return false;
        }
      });

      if (currentStepOffset < 150) {
        jQuery('.currentStep').find('.next-step-btn').click();     
      } else {
        jQuery('.currentStep').find('.current-step-btn').click();
      }
    });


    jQuery('.drawer .step-title').each(function(){
        jQuery(this).find('a').prepend('<span>' + (jQuery(this).index()) + '</span>').attr('href', '#step' + (jQuery(this).index()));
    });

    // header menu
    var stepContent = $('.step-content');
    var recipeContent = $('.recipe-content');

    var a = $('.site-header').outerHeight();
    var b = $('.site-header .recipe-content p.title').outerHeight();
    var c = $('.site-header .menu-content p.to-step').outerHeight();
    var d = $('.site-header .menu-content p.to-top-btn').outerHeight();
    var maxHeight = $(window).height() - a - b - c - d + 1;

    var browserwith = window.innerWidth;
    if (browserwith > 800 ) {
      $('.side-menu-content .scroll-wrapper').css('max-height', maxHeight -130 + 'px');
    } else {
      $('.side-menu-content .scroll-wrapper').css('max-height', maxHeight + 'px');
    }

    // scroll then fix the side menu
    var sideMenu = jQuery('.side-menu');
    if (sideMenu.length) {
      if (jQuery('body').hasClass('admin-bar')) {
        var sideMenuTop = sideMenu.offset().top - 42;
      } else {
        var sideMenuTop = sideMenu.offset().top - 10;
      }

      $(window).scroll(function() {
        if ($(window).scrollTop() > sideMenuTop) {
          sideMenu.addClass('fixed');
        } else {
          sideMenu.removeClass('fixed');
        }
      });
    }

    jQuery('#loadmore-button').on('click', function (e) {
      e.preventDefault();

      var num = +jQuery(this).parent().attr("data-click");
      num = num - 1;
      jQuery(this).parent().attr("data-click", num);
      if (num === 0) {
        setTimeout(function(){
          jQuery('#loadmore-button').parent().fadeOut();
          jQuery('.load-more-text').fadeOut();
        }, 500);
      }

      // Load More
      var dgtLoadmoreButton = jQuery('.load-more-button span');
      var infiniteScroll = {
        navSelector: '.loop-pagination', // selector for the paged navigation
        nextSelector: '.loop-pagination .next', // selector for the NEXT link (to page 2)
        itemSelector: '.post-list .row > div', // selector for all items you'll retrieve
        contentSelector: '.post-list .row'
      };
      jQuery(infiniteScroll.contentSelector).infinitescroll(
        infiniteScroll, function () {
          if (dgtLoadmoreButton.hasClass('load-more')) {
            dgtLoadmoreButton.fadeIn(400);
          }
        }
      );
      jQuery(window).unbind('.infscr');
      jQuery('.post-list .row').infinitescroll('retrieve');

    });

    // lazy load
    jQuery(".lazy img").lazyload({
      effect : "fadeIn"
    });
});

jQuery(function () {
  // scroll body to 0px on click
  jQuery(".site-header .to-top-btn").click(function () {
    hideMobileMenu(function(){
      setTimeout(function(){
        jQuery("body,html").animate({
          scrollTop: 0
        }, 800);
        return false;
      }, 100);
    });
  });

  jQuery(".side-menu-content .to-top-btn").click(function () {
    jQuery("body,html").animate({
      scrollTop: 0
    }, 800);
    return false;
  });
});

// smooth scroll
jQuery(function() {
  jQuery('.anchor a').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = jQuery(this.hash);
      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        jQuery('html, body').animate({
          scrollTop: target.offset().top - 85
        }, {duration: 500, easing: 'easeOutQuart'});
        return false;
      }
    }
  });
});

// mCustomScrollbar
(function($){
  var ww = $(window).outerWidth();
  if(ww > 1023) {
    $(window).on("load",function(){
      $(".side-menu-content .scroll-wrapper").mCustomScrollbar({
        autoHideScrollbar:true
      });
    });
  }
})(jQuery);


// Menu
// side menu on mobile
jQuery(function($){  
  var entry = $('.site').children('.site-inner'),
      menu = $('.drawer .menu-content'),
      recipe = $('.drawer .recipe-content'),
      step = $('.drawer .step-content');

  // click on recipe icon
  $('body').on('click', '.site-header .to-step', function () {
    recipe.removeClass('show');
    step.toggleClass('show');    
    if(!menu.hasClass('show')) {
      entry.removeClass('entry-content_active');
      $('html,body').removeClass('noScroll');
    } else {
      $('html,body').addClass('noScroll');
    }
  });

  $('body').on('click', '.drawer .to-step', function () {
    recipe.removeClass('show');
    step.toggleClass('show');    
    if(!menu.hasClass('show')) {
      entry.removeClass('entry-content_active');
      $('html,body').removeClass('noScroll');
    } else {
      $('html,body').addClass('noScroll');
    }
  });

  // click on step icon
  $('body').on('click', '.site-header .to-recipe', function () {
    step.removeClass('show');
    recipe.toggleClass('show');
    if(!menu.hasClass('show')) {
      entry.removeClass('entry-content_active');
      $('html,body').removeClass('noScroll');
    } else {
      $('html,body').addClass('noScroll');
    }
  });

  $('body').on('click', '.drawer .to-recipe', function () {
    step.removeClass('show');
    recipe.toggleClass('show');
    if(!menu.hasClass('show')) {
      entry.removeClass('entry-content_active');
      $('html,body').removeClass('noScroll');
    } else {
      $('html,body').addClass('noScroll');
    }
  });

  // click on close icon
  $('.drawer .close-icon').on('click', function(){
    jQuery('.drawer .menu-content').removeClass('show');
    entry.removeClass('entry-content_active');
    $('html,body').removeClass('noScroll');
  });

  // hide the menu when click on step title
  $(".drawer .step-title a").click(function(){
    var target = $(this.hash);

    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    hideMobileMenu(function(){
      setTimeout(function(){
        $('html, body').animate({
          scrollTop: target.offset().top - 53
        }, 800);
        return false;
      }, 150);
    });
  });

  var sideMenu = $('.side-menu-content .menu-content'),
      sideRecipe = $('.side-menu-content .recipe-content'),
      sideStep = $('.side-menu-content .step-content');

  // Side menu desktop

  $('.side-menu .to-step').on('click', function(){
    if (sideStep.hasClass('menu_show')){
      sideMenu.removeClass('menu_show').animate({right:'-320px'},0);
      sideStep.removeClass('menu_show').stop().animate({right:'-320px'},200);
      $('#page').removeClass('entry-content_active');
      $('#side-mn').removeClass('side-menu_active');
    } else {
      sideMenu.removeClass('menu_show').animate({right:'-320px'},0);
      sideStep.addClass('menu_show').stop().animate({right:'0'},200);
      $('#page').addClass('entry-content_active');
      $('#side-mn').addClass('side-menu_active');
    }
  });

  $('.side-menu-content .to-step').on('click', function(){
    if (sideStep.hasClass('menu_show')){
      sideMenu.removeClass('menu_show').animate({right:'-320px'},0);
      sideStep.removeClass('menu_show').stop().animate({right:'-320px'},200);
      $('#page').removeClass('entry-content_active');
      $('#side-mn').removeClass('side-menu_active');
    } else {
      sideMenu.removeClass('menu_show').animate({right:'-320px'},0);
      sideStep.addClass('menu_show').stop().animate({right:'0'},200);
      $('#page').addClass('entry-content_active');
      $('#side-mn').addClass('side-menu_active');
    }
  });

  $('.side-menu .to-recipe').on('click', function(){
    if (sideRecipe.hasClass('menu_show')){
      sideMenu.removeClass('menu_show').animate({right:'-320px'},0);
      sideRecipe.removeClass('menu_show').stop().animate({right:'-320px'},200);
      $('#page').removeClass('entry-content_active');
      $('#side-mn').removeClass('side-menu_active');
    } else {
      sideMenu.removeClass('menu_show').animate({right:'-320px'},0);
      sideRecipe.addClass('menu_show').stop().animate({right:'0'},200);
      $('#page').addClass('entry-content_active');
      $('#side-mn').addClass('side-menu_active');
    }
  });

  $('.side-menu-content .to-recipe').on('click', function(){
    if (sideRecipe.hasClass('menu_show')){
      sideMenu.removeClass('menu_show').animate({right:'-320px'},0);
      sideRecipe.removeClass('menu_show').stop().animate({right:'-320px'},200);
      $('#page').removeClass('entry-content_active');
      $('#side-mn').removeClass('side-menu_active');
    } else {
      sideMenu.removeClass('menu_show').animate({right:'-320px'},0);
      sideRecipe.addClass('menu_show').stop().animate({right:'0'},200);
      $('#page').addClass('entry-content_active');
      $('#side-mn').addClass('side-menu_active');
    }
  });

  $('.side-menu-content .close-icon').on('click', function(){
    sideMenu.animate({right:'-320px'},200).removeClass('menu_show');
    $('#page').removeClass('entry-content_active');
    $('#side-mn').removeClass('side-menu_active');
  });
});

function hideMobileMenu(callback) {
  jQuery('body').removeClass('hidden');
  jQuery('.drawer .menu-content').removeClass('show');
  jQuery('.site').children('.site-inner').removeClass('entry-content_active');
  jQuery('html,body').removeClass('noScroll');
  callback();
}

jQuery(document).on( 'submit', '.search-form', function(e) {
  e.preventDefault();
  var isMobile = (jQuery(window).width() < 415 ) ? true : false;
  var $form = jQuery(this);
  var $input = isMobile ? $form.find('.mb-show') : $form.find('.mb-hide');
  var query = $input.val();
  var $content = jQuery('.post-list');

  var data = "action=load_search_results&query="+query; 

  var request = new XMLHttpRequest();
  request.open('POST', hobonichiParams.ajaxUrl, true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  jQuery('body').addClass('loading'); 
  request.onload = function() {
    if (request.status >= 200 && request.status < 400) {
      // Success!
      var result = request.responseText;
      $content.html(result);
      jQuery('.load-more-text').html('');
      jQuery('.load-more-button').html('');
      jQuery('body').removeClass('loading');
    } else {
      console.log('else');
      // We reached our target server, but it returned an error      
    }
  };

  request.onerror = function() {
    console.log('error');
    // There was a connection error of some sort
  };

  request.send(data);

  // jQuery.ajax({ 
  //   url: hobonichiParams.ajaxUrl, // that's where wordpress handles ajax requests.
  //   type:'POST',
  //   data:{   
  //     action: 'load_search_results', 
  //     query: query
  //   },
  //   beforeSend: function() {
  //     jQuery('body').addClass('loading'); 
  //   },
  //   success:function(result){
  //     console.log(typeof result);
  //     $content.html(result);
  //     jQuery('.load-more-text').html('');
  //     jQuery('.load-more-button').html('');
  //     jQuery('body').removeClass('loading');
  //   }
  // });
})

function scrollstep() {
  var scrollstep = new IScroll('#iscroll-step', {
    mouseWheel: true,
    click: true,
    probeType: 3
  });
  var scrollstep = new IScroll('#iscroll-recipe', {
    mouseWheel: true,
    click: true,
    probeType: 3
  });
    
};

(function($,sr){
  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
    var timeout;

    return function debounced () {
      var obj = this, args = arguments;
      function delayed () {
          if (!execAsap)
              func.apply(obj, args);
          timeout = null;
      };

      if (timeout)
          clearTimeout(timeout);
      else if (execAsap)
          func.apply(obj, args);

      timeout = setTimeout(delayed, threshold || 100);
    };
  }
  // smartresize
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');