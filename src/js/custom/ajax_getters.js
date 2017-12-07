//В этом фрагменте ваш код будет выполнен, когда страница полностью загрузится.
jQuery(document).ready(function($){


    //Отображение виджетов категорий перенесено в AJAX для уменьшения времени загрузки страницы

    var windowWidth = $(window).width();
    var footerCategoriesExists = false;

    if(windowWidth > 992){

        getCategoriesSidebar();

        getCategoriesFooter();

    }else{

        getCategoriesSidebar();

    }


    $(window).resize(function() {

        var windowCurrentWidth = $(window).width();

        if(windowCurrentWidth > 992 && footerCategoriesExists === false){

            getCategoriesFooter();

        }

    });


    //__________________________________//

    function getCategoriesSidebar() {

        var block = $('.js-sidebar-categories');

        if(block.length < 1){
            return;
        }

        var data = {
            'action': 'categories',
            'cat_outer_class': 'no-gutters collapse show ',
            'cat_outer_id': 'collapseCategories',
            'cat_class': 'sidebar_cat_item col-md-12',
            'cat_link_class': 'justify-content-between',
            'show_numbers': 'true',
        };

        $.ajax({
            url: BLOGDATA.ajaxUrl, // AJAX handler
            data: data,
            type: 'POST',
            beforeSend: function (xhr) {

            },
            success: function (data) {
                if (data) {

                    //Check if it is valid JSON
                    try {
                        JSON.parse(data);
                    } catch (e) {
                        return false;
                    }

                    var response = JSON.parse(data);

                    block.append(response);

                    //console.log('response: ', response);


                } else {
                    // if no data
                }
            }
        });


    }


    function getCategoriesFooter() {

        var block = $('.js-footer-categories');

        if(block.length < 1){
            return;
        }

        if(footerCategoriesExists === true){
            return;
        }

        footerCategoriesExists = true;

        var data = {
            'action': 'categories',
            'cat_outer_class': '',
            'cat_outer_id': 'footer_cat_list',
            'cat_class': 'col-xs-12 col-sm-6',
            'cat_link_class': 'justify-content-start',
            'show_numbers': 'false',
        };

        $.ajax({
            url: BLOGDATA.ajaxUrl, // AJAX handler
            data: data,
            type: 'POST',
            beforeSend: function (xhr) {

            },
            success: function (data) {
                if (data) {
                    //console.log('getCategoriesFooter works! ');
                    //Check if it is valid JSON
                    try {
                        JSON.parse(data);
                    } catch (e) {
                        return false;
                    }

                    var response = JSON.parse(data);

                    block.append(response);



                } else {
                    // if no data
                }
            }
        });


    }


});