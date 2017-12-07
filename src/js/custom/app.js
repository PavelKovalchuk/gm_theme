
var mainSiteBasePath = BLOGDATA.mainSiteBasePath;


//В этом фрагменте ваш код будет выполнен, когда страница полностью загрузится.
jQuery(document).ready(function($){
// Add your custom jQuery here





});

//Если нужно, чтобы код был выполнен сразу (без ожидания события «ready» в DOM)
(function($) {

    // внутри этой функции $ будет работать как jQuery



    enableLeftScrollNav();

    document.oncopy = addLink;

    //Enable tooltips everywhere
    $('[data-toggle="tooltip"]').tooltip();


    //__________________________________//

    function addLink() {
        var body_element = document.getElementsByTagName('body')[0];
        var selection;
        selection = window.getSelection();
        var pagelink = "<br /><br /> Источник: <a href='"+document.location.href+"'>"+document.location.href+"</a><br />© Интернет-магазин GreenMarket";
        var copytext = selection + pagelink;
        var newdiv = document.createElement('div');
        newdiv.style.position='absolute';
        newdiv.style.left='-99999px';
        body_element.appendChild(newdiv);
        newdiv.innerHTML = copytext;
        selection.selectAllChildren(newdiv);
        window.setTimeout(function() {
            body_element.removeChild(newdiv);
        },0);
    }


    function enableLeftScrollNav(){
        $('[data-toggle="slide-collapse"]').on('click', function() {
            $navMenuCont = $($(this).data('target'));
            $navMenuCont.animate({'width':'toggle'}, 280);
        });
    }


})(jQuery);