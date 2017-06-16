(function(){
    // Toggle menu
    $('.header-nav__type .toggle_menu').on('click', function(e){
        e.preventDefault();
        if($(this).hasClass('active') ){
            return;
        }
        toggleMenu('.navigation-wrapper', $(this), 'active');
    });

    $('.header-nav__category .toggle_menu').on('click', function(e){
        e.preventDefault();
        if($(this).hasClass('active') ){
            return;
        }

        $('#main-body').addClass('responsive-nav__open');
        toggleMenu('.responsive-navigation', $(this), 'active');
    });

    function toggleMenu(parent, element, cls){
        var target = $(element).attr('data-toggle');
        $(element).parents('.header-nav__left').find('.'+cls).removeClass(cls);
        $(parent+' .category_menu.active').removeClass(cls);
        $(element).addClass(cls);
        $(parent+' '+target).addClass(cls);
    }

    // toggle visibility of responsive menu
    $('#closeMenu').on('click', function(){
        $('.header-nav__category .toggle_menu.active').removeClass('active');
        $('.responsive-navigation .category_menu.active').removeClass('active');
        setTimeout(function(){
            $('#main-body').removeClass('responsive-nav__open');
        }, 150);
    });


    // Prevent default event for element
    $('.preventDefaultElement').on('click submit', function(e){
        e.preventDefault();
    });

    // Move navigation location when responsive breakdown
    $(window).resize(function(){
        var winWidth = $(window).width() || 0,
            winHeight = $(window).height() || 0;
    });
})();
