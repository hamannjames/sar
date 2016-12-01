$(document).ready(function(){
    var carousel = $('.owl-carousel');
    var searchButton = $('#search-button');
    var searchIcon = $('#search-white');
    var searchBar = $('#searchform');
    var scroll;
    var bannerHeight;
    var width = $(window).width();
    var header = $('#site-header');
    var headerPos = header.offset();
    var headerHeight = header.height();
    var content = $('#site-content');
    var target;
    var nav = $("#site-nav");
    var button = $("#menu-button");
    var unit = $('.post-content.unit');
    var sidebar = $('.sidebar');
    var bttShow = $(window).height();
    var filters = $('.filters-list.blog');
    var tap = ("ontouchstart" in document.documentElement);

    button.on('click', function(){
		$(this).toggleClass('open');
        nav.slideToggle();
	});

    if ($(document).scrollTop() > 200 && width > 768) {
        header.addClass('fixed');
    }

    $(window).resize(function() {
        width = $(window).width();

        if (width > 1200) {
            button.removeClass('open');

            nav.css('display', 'inline-block');
        }

        if (width <= 1183 ){
            if (nav.css('display') === 'inline-block' && !button.hasClass('open')) {
                nav.css('display', 'none');
            }
        }

        if (width <= 768) {
            header.removeClass('fixed');
        }

        if (width > 768 && (headerPos.top < $(document).scrollTop() && !header.hasClass('fixed'))) {
            header.addClass('fixed');
        }
    });

    var backToTop = $('#back-to-top');

    $(document).scroll(function(){
        scroll = $(document).scrollTop();

        if (scroll > bttShow) {
            backToTop.fadeIn();
        }
        else {
            backToTop.fadeOut();
        }

        if ((!headerPos.top == 0 && headerPos.top <= scroll) && width > 768) {
            header.addClass('fixed');
            content.css('padding-top', headerHeight);
        }
        else if ((!headerPos.top == 0 && scroll < headerPos.top) && header.hasClass('fixed')) {
            header.removeClass('fixed');
            content.css('padding-top', 0);
        }
        else if ((headerPos.top == 0 && width > 768) && !header.hasClass('fixed')) {
            bannerHeight = $('.banner').height();
            if (scroll > bannerHeight) {
                header.addClass('fixed');
                content.css('padding-top', headerHeight);
            }
        }
        else if ((headerPos.top == 0 && width > 768) && header.hasClass('fixed')) {
            bannerHeight = $('.banner').height();
            if (scroll < bannerHeight) {
                header.removeClass('fixed');
                content.css('padding-top', 0);
            }
        }
    });

    if (carousel) {
        $.each(carousel, function(){
            if (carousel.is('.half')) {
                carousel.owlCarousel({
                    singleItem: true,
                    dots : true,
                    navigation : true,
                    navigationText : [
                      'Prev',
                      'Next'
                    ]
                });
            }
        });
    }

    $('.gallery-row').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery: {enabled:true}
    });

    if (!tap) {
        searchButton.on('mouseenter', function(){
            searchIcon.fadeIn('300', function(){
                searchIcon.mouseleave(function(){
                    searchIcon.stop();
                });
            });
        });

        searchButton.on('mouseleave', function(){
            searchIcon.fadeOut('300');
        });
    }

    searchBar.on('click', function(e){
        e.stopPropagation();
    });

    $(document).on('click', function(event){
        target = $(event.target);
        if (target.is(searchButton) || target.is(searchButton.children())) {
            event.stopPropagation();
            searchBar.toggleClass('bring-in');
        }
        else {
            searchBar.removeClass('bring-in');
        }
    });


    $(function() {
          $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
              var target = $(this.hash);
              target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
              if (target.length) {
                $('html, body').animate({
                  scrollTop: (target.offset().top - 40)
                }, 1000);
                return false;
              }
            }
          });
    });

    backToTop.on('click', function(){
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });

    if ($(document).scrollTop() > 100) {
        backToTop.fadeIn();
    }

    if (filters) {
        filters.on('click', 'span', function(){
            $(this).toggleClass('active');
            $(this).next().slideToggle('300');
        });
    }

    filters.find('ul').each(function(){
        $(this).children('li').each(function(){
            if ($(this).children('a').attr('href') == window.location.href) {
                $(this).css('font-weight', 'bold').closest('.filter').children('.title').addClass('active').next().show();
            }
        });
    });


    $(".story-content .story-item, .post-item-content .post-item").mCustomScrollbar({
        scrollInertia: 500,
        theme: 'rounded-dark',
        scrollbarPosition: 'outside'
    });
});
