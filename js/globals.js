(function($) {
    $(document).ready(function() {
        var header = $('header');
        var headerHeight = header.css('height');
        headerHeight = headerHeight.substr(0, headerHeight.length -2);
        var body = $('body');

        $(window).scroll(function() {
            if ($(window).scrollTop() > (headerHeight/2)) {
                body.addClass('small');
            } else {
                body.removeClass('small');
            }
        });

        $('.mobile-toggle').click(function(e) {
            e.preventDefault();
            $('#menu-top-nav, body').toggleClass('open');
        });
    });
})(jQuery)