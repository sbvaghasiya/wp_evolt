( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetCTAlertHandler = function( $scope, $ ) {
        $scope.find(".evolt-alert .evolt-alert-dismiss").on("click", function(e){
            $(this).parents(".evolt-alert").fadeOut(400);
        });
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/evolt_alert.default', WidgetCTAlertHandler );
    } );
} )( jQuery );