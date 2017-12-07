//В этом фрагменте ваш код будет выполнен, когда страница полностью загрузится.
jQuery(document).ready(function($){

    initSubscribeEvent();

    getCallBackForm();



    //__________________________________//


    function initSubscribeEvent(){

        var form = $('form.js-subscribe');

        if(form.length == 0){
            return;
        }

        $.each( form, function( key, value ) {

            __performSubscribe(value);

        });


    }

    function __performSubscribe(formElement){

        var form = $(formElement);

        form.submit(function() {

            event.preventDefault();

            var fdata = form.serializeArray();

            if(fdata[0].name == 'subscribe_name' && fdata[0].value.length < 1){
                return false;
            }

            if(fdata[1].name == 'subscribe_email' && fdata[1].value.length < 1){
                return false;
            }

            jQuery.ajax({
                url: mainSiteBasePath + 'dialogs/subscribe' + '?blog=blog',
                async: true,
                data: fdata,
                type: 'POST',
                success: function(msg){

                    $('#js-modal-form-content').html(msg);
                    //$('.modal-body').append('<div class="btn-outer btn-outer-center"><button class="btn btn-gm " data-dismiss="modal" id="js-btn-callback-finish">Продолжить</button></div>');

                    $('#js-modal-form').modal({
                        keyboard: true,
                        show: true
                    });
                }
            });


        });

    }


    // Work with forms START
    function getCallBackForm(){

        var btn = $("#js-btn-callback");

        if(btn.length > 0){

            btn.on('click', function(){
                __getConnectFormHTML('callback');
            });

        }

    }

    //jQuery('.call-back-but').click(function(){getConnectBox('callback');});

    function __getConnectFormHTML(act, target){
        var actMain = act || 'callback', targetMain = target || 'dialog';
        $.ajax({
            url: ['/dialogs', actMain, targetMain].filter(function(elem) {
                return !!elem;
            }).join('/'),
            async: true,
            type: 'GET',
            success: function(msg){
                $('#js-modal-form-content').html(msg);
               // $('.connect-box-foot').append('<button class="btn btn-gm " id="js-btn-callback-send">Отправить</button>');
                $('#connect-box-inp table').addClass('table table-responsive-md');
                $('#js-modal-form').modal({
                    keyboard: true,
                    show: true
                });

                __createSendingListener(act);

            }
        });
    }

    function __createSendingListener(act){
        var btn = $("#js-btn-callback-send");

        if(btn.length > 0){

            btn.on('click', function(e){
                e.preventDefault();
                //console.log('yep');
                __sendConnectBoxForm(act);
            });

        }
    }

    function __sendConnectBoxForm(action){

        var $boxForm = $('#connect-box-form'),
            fdata = $boxForm.serializeArray(),
            target = $boxForm.find('input[name="target"]').val();

        //reviewId = $boxForm.find('input[name="review_id"]').val(),
        //reviewAnswerId = $boxForm.find('input[name="answer_review_id"]').val(),


        action = action || '';

        $.ajax({
            //url: ['/dialogs', action, target, reviewId, reviewAnswerId].filter(function(elem) {
            url: ['/dialogs', action, target].filter(function(elem) {
                return !!elem;
            }).join('/'),
            async: true,
            data: fdata,
            type: 'POST',
            success: function(msg){
                console.log(msg);
                $('#js-modal-form-content').html(msg);
                //$('.modal-body').append('<div class="btn-outer btn-outer-center"><button class="btn btn-gm " data-dismiss="modal" id="js-btn-callback-finish">Продолжить</button></div>');

                //__createSendingListener(action);
            }
        });

    }



    // Work with forms END


});