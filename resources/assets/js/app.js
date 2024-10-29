import PerfectScrollbar from 'perfect-scrollbar';
require('!style-loader!css-loader!perfect-scrollbar/css/perfect-scrollbar.css');

function offcanvasOpen() {
    return jQuery('body').hasClass('offcanvas-open');
}

function openOffcanvas() {
    jQuery('body').addClass('offcanvas-open');
}

function closeOffcanvas() {
    jQuery('body').removeClass('offcanvas-open');
}

function aw_trigger_offcanvas() {
    if (offcanvasOpen()) {
        closeOffcanvas();
    } else {
        openOffcanvas();
    }
}

jQuery(document).ready(() => {

    jQuery('#offcanvas_container').find('a').each(function() {
        var currentLink = jQuery(this);
        var currentListItem = jQuery(this).parent('li');

        if (jQuery(this).next('.sub-menu').length == 0) {
            return;
        }

        jQuery(this).data('clicks', 0);

        jQuery(this).on('click touchstart', (e) => {
            var clickedLink = jQuery(this);
            var clickedListItem = jQuery(this).parent('li');

            if (jQuery(this).data('clicks') == 0) {
                e.preventDefault();

                if (jQuery(this).parent('li').hasClass('visible')) {
                    jQuery(this).parent('li').removeClass('visible');
                    jQuery(this).next('.sub-menu').slideUp();
                } else {
                    jQuery(this).parent('li').addClass('visible');
                    jQuery(this).next('.sub-menu').slideDown();

                    // Schließe alle offenen Submenus, die sich auf gleicher Ebene befinden
                    // Außer das geöffnete
                    jQuery(this).parent('li').parent('ul').children('li').not(clickedListItem).each(function() {
                        jQuery(this).removeClass('visible');
                        jQuery(this).children('.sub-menu').slideUp();
                        jQuery(this).children('a').data('clicks', 0);
                    });
                }

                jQuery(this).data('clicks', jQuery(this).data('clicks') + 1);

                return;
            }

            // Wenn Link ins leere läuft (href ist '#') soll beim zweiten Klick
            // nicht weitergeleitet werden. Stattdessen wird das Menü
            // geschlossen. Auch werden clicks auf 0 zurückgesetzt
            // damit ein Öffnen danach möglich ist.
            if (jQuery(this).attr('href') == '#') {
                e.preventDefault();

                jQuery(this).parent('li').removeClass('visible');
                jQuery(this).next('.sub-menu').slideUp();
                jQuery(this).data('clicks', 0);
            }

            if (e.type == 'touchstart') {
                window.location.href = jQuery(this).attr('href');
                return;
            }
        });
    });

    jQuery('#et-top-navigation .mobile_menu_bar_toggle').click((e) => {
        e.preventDefault();

        var container = document.querySelector('#offcanvas_container');
        window.ps = new PerfectScrollbar(container, { suppressScrollX: true });
        aw_trigger_offcanvas();
        ps.update();
        ps.update();
    });

    jQuery('.close-sidebar-inner, .offcanvas-menu-background').click(function(e) {
        e.preventDefault();
        aw_trigger_offcanvas();
    });

    jQuery(window).resize(function() {
        if (jQuery('#offcanvas_container').data('max') === false) {
            return;
        }

        if (jQuery('#offcanvas_container').data('max') < window.innerWidth &&
            jQuery('#page-container').hasClass('push')
        ) {
            jQuery('#page-container').unbind('click');
            removePushFromPageContainer();
        }
    });
});
