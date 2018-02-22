// BASIC STARTER REQUIREMENTS
var lazy = require('jquery-lazy')
require('./vendor/skip-link-focus-fix.js')

// ADDITIONAL 3RD PARTY REQUIREMENTS EXAMPLE
// var slick = require('slick'); // Requires: npm install slick

// Get Viewport Dimensions
function updateViewportDimensions() {
    var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
    return { width:x,height:y };
}

// setting the viewport width
var viewport = updateViewportDimensions();

// David Walsh Debounce
function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    }
}


// Cornerstone Media Namespace
var braid = braid || {};

// utilities
braid.query = function(selector) {
    return document.querySelector(selector);
};

braid.isHome = !!document.getElementsByClassName('home').length;
braid.isFlexible = !!document.getElementsByClassName('page-template-page-flexible').length;
braid.hasForm = !!document.getElementsByClassName('gform_wrapper').length;



// Set up namespace
var braidStarter = braidStarter || {};

(function(ns, $win, $, undefined) {
    var $htmlBody = $('html, body');

    // http://jquery.eisbehr.de/lazy/
    // usage <img class="lazy" data-src="/some-path" alt=""> for img
    // usage <div class="lazy" data-src="/some-path" alt=""> for background image
    function initLazyLoad() {
        $('.lazy').lazy({
            effect: "fadeIn",
            effectTime: 500,
            threshold: 500
        });
    }

    function toggleNavMenu() {
        var $menu = $('.main-navigation');
        $('.burg-wrapper').click(function(){
            $('.burg').toggleClass('active-burg');
            $menu.slideToggle();
        });
    }

    function subMenus() {
        var $navItem = $('.menu-item-has-children');

        $navItem.hover(
            function(){
                var $this = $(this);
                var $subMenu = $this.find('.sub-menu');
                $subMenu.addClass('show-menu');
            },
            function(){
                var $this = $(this);
                var $subMenu = $this.find('.sub-menu');
                $subMenu.removeClass('show-menu');
            }
        );
    }

    function smoothScroll() {
        var $links = $('.smooth-scroll');

        $links.click(function(e){
            e.preventDefault();
            var $this = $(this);
            var $target = $($this.attr('href'));
            $htmlBody.animate({scrollTop: $target.offset().top}, '500', 'swing');
        });
    }


    function contentAccordion() {
        $('.content-accordion').on('click', '.content-accordion--btn', function() {
            var $btn = $(this);
            var $container = $btn.closest('.content-accordion');
            var $content = $container.find('.content-accordion--hidden');
            $content.slideToggle(function(){
                $content.is(':visible') ? $btn.text('See Less') : $btn.text('See More');;
            });
        });
    }





    // ----
    // public methods and variables
    // ----
    ns.init = function() {
        subMenus();
        toggleNavMenu();
        smoothScroll();
        initLazyLoad();
        contentAccordion();
    };

    ns.windowLoadInit = function() {
    };



}(braidStarter = braidStarter || {}, jQuery(window), jQuery));







jQuery(document).ready(function($) {
    braidStarter.init();
});

// jQuery(window).load(function() {
//     // braidStarter.windowLoadInit();
// });