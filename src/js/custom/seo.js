

//В этом фрагменте ваш код будет выполнен, когда страница полностью загрузится.
jQuery(document).ready(function($){





    //__________________________________//


    var $window = $(window),cache = [];
    var startTime = +new Date;

    $window.scroll(function() {

        var timing = +new Date - startTime;


        var docHeight = $(document).height(),
            winHeight = window.innerHeight ? window.innerHeight : $window.height(),
            scrollDistance = $window.scrollTop() + winHeight,
            marks = calculateMarks(docHeight);
        checkMarks(marks, scrollDistance, timing);

    });

    function calculateMarks(docHeight) {
        return {
            '25%' : parseInt(docHeight * 0.25, 10),
            '50%' : parseInt(docHeight * 0.50, 10),
            '75%' : parseInt(docHeight * 0.75, 10),
            '100%': docHeight - 5
        };
    }
    function checkMarks(marks, scrollDistance, timing) {
        // Check each active mark
        $.each(marks, function(key, val) {
            if ( $.inArray(key, cache) === -1 && scrollDistance >= val ) {
                sendEvent('Percentage', key,timing);
                //console.log(key);
                cache.push(key);
            }
        });
    }
    function sendEvent(action, label, timing){

        if (typeof(_gaq) == 'undefined') {
            console.log("Google Analytics is not installed");
            return false;
        }


         _gaq.push(['_trackEvent', 'Scroll Depth', action, label, 1]);
         _gaq.push(['_trackTiming', 'Scroll Depth', action, timing, label, 100]);


    }


});