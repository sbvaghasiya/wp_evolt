( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetCustomProgressBarHandler = function( $scope, $ ) {
        elementorFrontend.waypoint($scope.find('.evolt-progress-bar'), function () {
            $(this).progressbar();
        });

    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/evolt_progressbar.default', WidgetCustomProgressBarHandler );
    } );
} )( jQuery );