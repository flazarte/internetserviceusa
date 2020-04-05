jQuery(document).ready(function () {
    jQuery('.rt-alert').on('click', '.closebtn', function () {
        jQuery(this).closest('.rt-alert').fadeOut(); //.css('display', 'none');
    });
    jQuery('.rt-notice button.notice-dismiss').text("dismiss");

    jQuery('.rt-boost-label input').on('click', function() { 
        jQuery('.rt-boost').slideToggle();
    });
    jQuery('.rt-backlinks-label input').on('click', function() { 
        jQuery('.rt-backlinks').slideToggle(); 
    });
    jQuery('.rt-mobi-label input').on('click', function() { 
        jQuery('.rt-mobi').slideToggle();
    });
    jQuery('.rt-bigta-label input').on('click', function() { 
        jQuery('.rt-bigta').slideToggle();
    });
    jQuery('.rt-vidseo-label input').on('click', function() { 
        jQuery('.rt-vidseo').slideToggle();
    });
    jQuery('.rt-multisite-label input').on('click', function() { 
        jQuery('.rt-multisite').slideToggle(); 
    });

    jQuery('.rt-growth').masonry({
        // options
        itemSelector: 'ul',
        //horizontalOrder: true
    });

});