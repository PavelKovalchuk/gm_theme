//В этом фрагменте ваш код будет выполнен, когда страница полностью загрузится.
jQuery(document).ready(function($){

    var windowWidth = $(window).width();


    if(windowWidth > 575){

        getFeaturedProd('start');

        initFeaturedProdEvent();


    }else{

    }

   /* $(window).resize(function() {

        var windowCurrentWidth = $(window).width();

        if(windowCurrentWidth > 575){

            getFeaturedProd('start');

            initFeaturedProdEvent();

        }

    });*/




    //__________________________________//


    function initFeaturedProdEvent(){

        $('.products-slider-nav-img.prev').click(function(event){
            getFeaturedProd('prev');

        });
        $('.products-slider-nav-img.next').click(function(event){
            getFeaturedProd('next');

        });

    }

    function getFeaturedProd(direct){

        var slider = $('.js-product-slider');

        if(slider.length == 0){

            return;

        }

        var productsData = BLOGDATA.productsPost;
        var itemsBlock = $('.products-slider-items');


        var products_id = '';
        if(productsData.length > 0){
            products_id = JSON.stringify({'products_id' : productsData});
        }

        var postId = slider.attr('data-post-id');
        var prodShowedNow;
        if(direct != 'start'){
            prodShowedNow = $("#fp4pr-cont").serializeArray();
        }else{
            prodShowedNow = '';
        }
        jQuery.ajax({

            //url: '//www.greenmarket.com.ua/' + 'get_featured_prod.php?direct=' + direct+ '&target=blog&recProdId=' + products_id,
            url: mainSiteBasePath + 'get_featured_prod.php?direct=' + direct+ '&target=blog&recProdId=' + products_id,
            async: true,
            type: 'POST',
            data: prodShowedNow,
            success: function(msg){
                if(msg){

                    slider.addClass('slider-ready');

                    itemsBlock.imagesLoaded()
                        .always( function( instance ) {

                            //console.log('all images loaded');

                            itemsBlock.removeClass('scale-up-center');

                            slider.show();

                            itemsBlock.html(msg).addClass('scale-up-center');



                        })
                        .done( function( instance ) {
                            //console.log('all images successfully loaded');
                        })
                        .fail( function() {
                            console.log('all images loaded, at least one is broken');
                        });




                }
            }
        });
    }




});