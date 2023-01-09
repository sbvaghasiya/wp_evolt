( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetCTCounterHandler = function( $scope, $ ) {
        elementorFrontend.waypoint($scope.find('.evolt-counter-number-value'), function () {
            var $number = $(this),
                data = $number.data();

            var decimalDigits = data.toValue.toString().match(/\.(.*)/);

            if (decimalDigits) {
                data.rounding = decimalDigits[1].length;
            }

            $number.numerator(data);
        }, {
            offset: '95%',
            triggerOnce: true
        });
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/evolt_counter.default', WidgetCTCounterHandler );
    } );
} )( jQuery );