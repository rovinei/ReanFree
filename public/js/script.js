(function(){

    // Toggle menu
    $('#toggleMenu').on('click', function(e){
        e.preventDefault();
        $(this).toggleClass('active');
        $('.navigation-wrapper').toggleClass('active');
        $('body').eq(0).toggleClass('responsive-nav__open');
    });

    $(window).scroll(function(){
       var top = $(window).scrollTop();
       if(top > 100){
            $('.site_logo').addClass('scaleIn');
       }else{
            $('.site_logo').removeClass('scaleIn');
       }
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
