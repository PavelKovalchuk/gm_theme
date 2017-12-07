//Если нужно, чтобы код был выполнен сразу (без ожидания события «ready» в DOM)
(function($) {



    lazyLoadImages();

    //__________________________________//


    function lazyLoadImages(){

        var images = $('.wp-post-image');

        var postImages = $('.img-wrap img');

        if(images.length == 0){
            return;
        }


        $.each( images, function( key, item ) {

            $(item).siLoader(function() {

                $(this).fadeIn();
            });


        });

        if(postImages.length !== 0){
            $.each( postImages, function( key, item ) {

                $(item).siLoader(function() {

                    $(this).fadeIn();
                });


            });
       }

    }

})(jQuery);