(function($) {
    wp.customize('aw_offcanvas_background_color_setting', function(value) {
        value.bind(function(newval) {
            jQuery('#offcanvas_container').css({'background-color': newval});

            jQuery('#offcanvas_menu_inner > li.menu-item > ul > li.menu-item > ul').css({'background-color': newval});
        });
    });

    wp.customize('aw_offcanvas_border_right_color_setting', function(value) {
        value.bind(function(newval) {
            jQuery('#offcanvas_container .ps__rail-y').css({'background-color': newval});
        });
    });

    wp.customize('aw_offcanvas_border_color_setting', function(value) {
        value.bind(function(newval) {
            jQuery('#offcanvas_container li.menu-item').children('a').css({'border-bottom-color': newval});
            jQuery('#offcanvas_container .close-sidebar-inner').css({'border-bottom-color': newval});
        });
    });

    wp.customize('aw_offcanvas_font_color_setting', function(value) {
        value.bind(function(newval) {
            jQuery('#offcanvas_container li.menu-item').children('a').css({'color': newval});
            jQuery('#offcanvas_container .close-sidebar-inner').children('span').eq(0).css({color: newval});
        });
    });

    wp.customize('aw_offcanvas_open_font_setting', function(value) {
        value.bind(function(newval) {
            jQuery('#offcanvas_container li.menu-item.visible').children('a').css({'color': newval});
        });
    });

    wp.customize('aw_offcanvas_open_background_setting', function(value) {
        value.bind(function(newval) {
            jQuery('#offcanvas_container li.menu-item.visible').children('a').css({'background-color': newval});
        });
    });

    wp.customize('aw_offcanvas_close_background_setting', function(value) {
        value.bind(function(newval) {
            jQuery('#offcanvas_container .close-sidebar-inner').css({'background-color': newval});
        });
    });

    wp.customize('aw_offcanvas_close_color_setting', function(value) {
        value.bind(function(newval) {
            jQuery('#offcanvas_container .close-sidebar-inner span').css({'color': newval});
            jQuery('#offcanvas_container .close-sidebar-inner .fa').css({'color': newval});

            if (document.getElementById('aw-offcanvas-close-style')) {
                document.getElementById('aw-offcanvas-close-style').remove();
            }

            var css = document.createElement("style");
            css.setAttribute('id', 'aw-offcanvas-close-style');
            css.type = "text/css";
            css.innerHTML = "#offcanvas_container .close-sidebar-inner .fa:before { background-color: "+newval+" } #offcanvas_container .close-sidebar-inner .fa:after { background-color: "+newval+" }";
            document.body.appendChild(css);
        });
    });
})(jQuery);
