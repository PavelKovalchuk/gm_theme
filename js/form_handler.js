
jQuery.noConflict();

    var sendConnectBoxForm = function(self, action){

        var reviewflag = false,
            $boxForm = jQuery('#connect-box-form'),
            fdata = $boxForm.serializeArray(),
            target = $boxForm.find('input[name="target"]').val(),
            reviewId = $boxForm.find('input[name="review_id"]').val(),
            reviewAnswerId = $boxForm.find('input[name="answer_review_id"]').val(),
            id = jQuery(self).parents('#connect-box-form').parent().prop('id');
        action = action || '';


        jQuery.ajax({
            url: ['/dialogs', action, target, reviewId, reviewAnswerId].filter(function(elem) {
                return !!elem;
            }).join('/'),
            async: true,
            data: fdata,
            type: 'POST',
            success: function(msg){

                jQuery('#connect-box-form').html(msg);

            }
        });

    };

    function connectBoxClose() {

        jQuery('#js-modal-form').modal('hide');
    }

