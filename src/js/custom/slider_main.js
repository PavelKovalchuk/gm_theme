//В этом фрагменте ваш код будет выполнен, когда страница полностью загрузится.
jQuery(document).ready(function($){

    var windowWidth = $(window).width();

    var mainSliderExists = false;


    if(windowWidth > 575){

        getMainSlider();


    }else{

    }

    $(window).resize(function() {

        var windowCurrentWidth = $(window).width();

        if(windowCurrentWidth > 575 && mainSliderExists === false){

            getMainSlider();

        }

    });




    //__________________________________//




    function getMainSlider(){

        var slider = $('.js-main-slider');

        if(slider.length == 0){

            return;

        }

        if(mainSliderExists === true){
            return;
        }

        mainSliderExists = true;

        jQuery.ajax({

            url: mainSiteBasePath + 'blog_actions_ajax.php',
            async: true,
            type: 'POST',
            data: {slider: 'getSliderData', path: ''},
            beforeSend: function (xhr) {

            },
            success: function (data) {
                if (data) {
                    //console.log('getMainSlider works! ');

                    //Check if it is valid JSON
                    try {
                        JSON.parse(data);
                    } catch (e) {
                        return false;
                    }

                    var response = JSON.parse(data);

                    slider.append(response);

                    slider.addClass('slider-ready');

                    initCustomSlider(slider);



                } else {
                    // if no data
                }
            }
        });
    }

    function initCustomSlider(slider){

        var intervalDelay = 5000;
        var changingSpeed = 1200;
        var intervalId = null;
        var activeCardIndex = 0;
        var $cardsHolder = slider;
        var $cards = $cardsHolder.find('.slider-card');

        $cardsHolder.on('activeCardChanged', function(event, $newCard) {

            $cards.stop();
            $cards.not($newCard).fadeOut(changingSpeed);
            $($newCard).fadeIn(changingSpeed);


            if (intervalId) {
                clearInterval(intervalId);
                intervalId = null;
            }
            intervalId = setTimeout(activateNextCard, intervalDelay);
        });

        $(window).scroll(function() {
            if ($(this).scrollTop() > 540) {
                if (intervalId) {
                    clearInterval(intervalId);
                    intervalId = null;
                }
            } else {
                if (!intervalId) {
                    intervalId = setTimeout(activateNextCard, intervalDelay);
                }
            }
        });

        function activateNextCard() {
            var nextCardIndex = activeCardIndex + 1;
            if (nextCardIndex >= $cards.length) {
                nextCardIndex = 0;
            }
            var $nextCard = $($cards.get(nextCardIndex));
            activeCardIndex = nextCardIndex;
            $cardsHolder.trigger('activeCardChanged', $nextCard);
        }
        $cardsHolder.trigger('activeCardChanged', $($cards.get(activeCardIndex)));

    }




});