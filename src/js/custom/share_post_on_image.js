//В этом фрагменте ваш код будет выполнен, когда страница полностью загрузится.
jQuery(document).ready(function($){

    sharePostOnImage();


    function sharePostOnImage() {

        var articleContent = $('.js_post_item');

        //console.log(articleContent.length);
        $.each( articleContent, function( key, value ) {
            //console.log(value );

            __doShareArticle(value, articleContent.length);

        });

    }

    function __doShareArticle(post, numberItems){
        var article =  $(post);

        var articleImageShare = article.find('.js-article-share');

        if(numberItems === 1){
            articleImageShare.data('title', document.title);
            articleImageShare.data('description', $('meta[name="description"]').attr('content'));
            articleImageShare.data('url', location.href.replace(/\?.*$/, '').replace(/#.*$/, ''));
        }else if(numberItems > 1){

            var btnText =  article.find('.more-link').text();
            articleImageShare.data('url', article.find('.article-title a').attr('href').replace(/\?.*$/, '').replace(/#.*$/, ''));
            articleImageShare.data('title', article.find('.article-title').text());
            articleImageShare.data('description', article.find('.entry-content p').text().replace(btnText, ''));

        }else{
            return false;
        }


        articleImageShare.find('.js-button').click(function(ev) {
            Share[$(this).data('provider')](articleImageShare.data());
            ev.preventDefault();
            ev.stopPropagation();
        });

        article.find('.js-share-parent').on('mouseenter', function() {
            var item = $(this);

            if(item.hasClass('js-share-disable')){
                return;
            }

            item.append(articleImageShare);

            articleImageShare.data('image', item.find('img').attr('src'));
            articleImageShare.toggleClass('share-shown');
            //console.log(item);

        });

        article.find('.js-share-parent').on('mouseleave', function() {

            var item = $(this);

            if(item.hasClass('js-share-disable')){
                return;
            }

            articleImageShare.toggleClass('share-shown');
        });



        Share = {
            /*
            vk: function(data) {
                url  = 'http://vkontakte.ru/share.php?';
                url += 'url='          + encodeURIComponent(data.url);
                url += '&title='       + encodeURIComponent(data.title);
                url += '&description=' + encodeURIComponent(data.description);
                url += '&image='       + encodeURIComponent(data.image);
                url += '&noparse=true';
                Share.popup(url);
            },
            od: function(data) {
                url  = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
                url += '&st.comments=' + encodeURIComponent(data.description);
                url += '&st._surl='    + encodeURIComponent(data.url);
                Share.popup(url);
            },*/
            fb: function(data) {
                url  = 'http://www.facebook.com/sharer.php?s=100';
                url += '&p[title]='     + encodeURIComponent(data.title);
                url += '&p[summary]='   + encodeURIComponent(data.description);
                url += '&p[url]='       + encodeURIComponent(data.url);
                url += '&p[images][0]=' + encodeURIComponent(data.image);
                Share.popup(url);
            },
            tw: function(data) {
                url  = 'http://twitter.com/share?';
                url += 'text='      + encodeURIComponent(data.twitterTitle ? data.twitterTitle : data.title);
                url += '&url='      + encodeURIComponent(data.url);
                url += '&counturl=' + encodeURIComponent(data.url);
                Share.popup(url);
            },
            gp: function(data) {
                url  = 'https://plus.google.com/share?hl=ru';
                url += '&url='          + encodeURIComponent(data.url);
                Share.popup(url)
            },

            popup: function(url) {
                window.open(url,'','toolbar=0,status=0,width=626,height=436');
            }
        };

    }


});