( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetCTTabsHandler = function( $scope, $ ) {
        $scope.find(".evolt-tabs .evolt-tabs-title .evolt-tab-title, .evolt-tab-form .evolt-tabs-title .evolt-tab-title").on("click", function(e){
            e.preventDefault();
            var target = $(this).data("target");
            var parent = $(this).parents(".evolt-tabs, .evolt-tab-form");
            parent.find(".evolt-tabs-content .evolt-tab-content").slideUp(300).removeClass('active');
            parent.find(".evolt-tabs-title .evolt-tab-title").removeClass('active');
            $(this).addClass("active");
            $(target).slideDown(300).addClass('active');
        });
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/evolt_tabs.default', WidgetCTTabsHandler );
    } );
} )( jQuery );