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

        $('#searchform').addClass('closed');

        $('.search-toggle').click(function(e) {
            e.preventDefault();
            $('#searchform').toggleClass('closed');
            $('#s').focus();
        });
        
        // Directs focus from anchor links to appropriate areas. Example modified from
        // https://webaim.org code.
        
      	if (document.location.hash) {
      		var myAnchor = document.location.hash;
      		$(myAnchor).attr('tabindex', -1).on('blur focusout', function () {
      			$(this).removeAttr('tabindex');
      		}).focus();
      	}

      	$(window).bind('hashchange', function() {
      		var hash = "#"+window.location.hash.replace(/^#/,'');
      		if (hash!="#") {
      			$(hash).attr('tabindex', -1).on('blur focusout', function () {
      				$(this).removeAttr('tabindex');
      			}).focus();
      		}
      		else {
      			$("#headcontainer").attr('tabindex', -1).on('blur focusout', function () {
      				$(this).removeAttr('tabindex');
      			}).focus();
      		}
      	});
    });
})(jQuery)