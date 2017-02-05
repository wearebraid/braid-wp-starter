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
var CM = CM || {};

// utilities
CM.query = function(selector) {
    return document.querySelector(selector);
};

CM.isHome = !!document.getElementsByClassName('home').length;
CM.isFlexible = !!document.getElementsByClassName('page-template-page-flexible').length;
CM.hasForm = !!document.getElementsByClassName('gform_wrapper').length;
CM.isAbout = !!document.getElementsByClassName('team-members').length;
CM.isExpertisePages = (!!document.getElementsByClassName('single-expertise').length ||
                        !!document.getElementsByClassName('pa-expertise-wrap').length);
CM.isNewsSingle = !!document.getElementsByClassName('single-post').length;


// Set up namespace
var PillarAught = PillarAught || {};

(function(ns, $win, $, undefined) {
    var $htmlBody = $('html, body');

    function initLazyLoad() {
        $('.lazy').lazyload({
            effect : "fadeIn",
            threshold : 100
        });
    }

    function initSlider() {
        if (CM.isFlexible) {
            $('.owl-carousel').owlCarousel({
                items: 1,
                autoplay: true,
                autoplayTimeout: 4500,
                autoplaySpeed: 400,
                navSpeed: 400,
                loop: true
                //nav: true
            });
        }
        

        if (CM.isHome ) { 
            $('.owl-carousel').owlCarousel({
                items: 1,
                autoplay: true,
                autoplayTimeout: 4500,
                autoplaySpeed: 400,
                navSpeed: 400,
                loop: true
                //nav: true
            });
        }
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
        var $subMenu = $navItem.find('.sub-menu');

        $navItem.hover(
            function(){
                $subMenu.addClass('show-menu');
            },
            function(){
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


    // active navigation indicators to individual blog posts and single-expertise
    // even though only their parents are in the main navigation
    function activeNav() {
        if (CM.isExpertisePages) {
            $('.menu-expertise').addClass('current-menu-item');
        } else if (CM.isNewsSingle) {
            $('.menu-news-and-events').addClass('current-menu-item');
        }
    }

    // about page
    function leadershipAccordions() {
        if (!CM.isAbout) { return; }

        var $wrapper = $('.team-members');
        var $tiles = $wrapper.find('.team-member--tile');
        var $desktopSlots = $wrapper.find('.desktop-slot');
        var $mobileSlots = $wrapper.find('.mobile-slot');

        $tiles.click(function() {
            viewport = updateViewportDimensions();
            var $this = $(this);
            var dataId = $this.attr('data-id');
            var dataCount = parseInt($this.attr('data-count'));
            var $bio = $this.closest('.team-member').find('.team-member--data');
            var headerHeight = $('.site-header').outerHeight();

            if ($this.hasClass('active')) {
                $this.removeClass('active')
                $desktopSlots.add($mobileSlots).removeAttr('style');
            } else {
                $tiles.removeClass('active');
                $desktopSlots.add($mobileSlots).removeAttr('style');
                $this.addClass('active');

                if (viewport.width > 767) {
                    // desktop
                    $desktopSlots.each(function(){
                        var $this = $(this);
                        var dataMax = parseInt($(this).attr('data-max'));
                        if (dataCount <= dataMax) {
                            $this.empty();
                            $bio.clone().appendTo($this);
                            $this.css('display', 'block');

                            setTimeout(function() {
                                $htmlBody.animate(
                                {scrollTop: $this.offset().top - headerHeight}, 350);
                            }, 301);
                            

                            // break out of jQuery each()
                            return false;
                        }
                    });
                } else {
                    // mobile
                    var $slot = $mobileSlots.filter('[data-slot="' + dataId + '"]');
                    $slot.empty();
                    $bio.clone().appendTo($slot);
                    $slot.css('display', 'block');

                    setTimeout(function() {
                        $htmlBody.animate(
                        {scrollTop: $slot.offset().top - headerHeight}, 350);
                    }, 301);
                }
            }
        });
    }



    // ----
    // public methods and variables
    // ----
    ns.init = function() {
        initSlider();
        subMenus();
        toggleNavMenu();
        smoothScroll();
        initLazyLoad();
        contentAccordion();
        leadershipAccordions();
        activeNav();
    };

    ns.windowLoadInit = function() {
    };



}(PillarAught = PillarAught || {}, jQuery(window), jQuery));







jQuery(document).ready(function($) {
    PillarAught.init();
});


jQuery(window).load(function() {
    PillarAught.windowLoadInit();
});