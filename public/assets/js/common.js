(function ($) {
    $('[data-toggle="tooltip"]').tooltip(); 
}) (jQuery);
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();            
        reader.onload = function (e) {
            $('#target').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

$(".filestyle").change(function(){
    readURL(this);
});
$(document).ready(function() {   
    var sideslider = $('[data-toggle=collapse-side]');
    var sel = sideslider.attr('data-target');
    var sel2 = sideslider.attr('data-target-2');
    sideslider.click(function(event){
        $(sel).toggleClass('in');
        $(sel2).toggleClass('out');
    });
});
$('input[type="radio"]').click(function(){
    if ($('#no').is(':checked'))
    {
        $('div.collapse').show('slow');
    }
    if ($('#si').is(':checked'))
    {
        $('div.collapse').hide('slow');
    }
});
$(window).scroll(function(){
    if($(this).scrollTop()!=0){
        $("#back-to-top").fadeIn()
    }else{
        $("#back-to-top").fadeOut()
    }
});
$("#back-to-top").click(function(){
    $("body,html").animate({scrollTop:0},800)
});
$(document).ready(function() {   
    var sideslider = $('[data-toggle=collapse-side]');
    var sel = sideslider.attr('data-target');
    var sel2 = sideslider.attr('data-target-2');
    sideslider.click(function(event){
        $(sel).toggleClass('in');
        $(sel2).toggleClass('out');
    });
});
$(function(){
    $('#form').validate({
        rules :{
            recibo : {
                required : true,
                number : true

            },
            monto : {
                required : true,
                number : true

            },
            fecha : {
                required : true,
                date : true

            },
            adjunto : {
                required : true
            },
            options : {
                required : true
            },
            /*if ($('#no').is(':checked')) {*/
                user_address : {
                    required : true,
                    maxlenght : 140
                },
                estado : {
                    required : true
                },
                municipio : {
                    required : true
                },
            /*}*/
        },
        messages : {
            recibo : {
                required : "Debe ingresar el numero del recibo",
                number    : "Solo puede ingresar caracteres numericos"
            },
            monto : {
                required : "Debe Ingresar el Monto de la Transferencia o Deposito",
                number    : "Solo puede ingresar caracteres numericos"
            },
            fecha : {
                required : "Debe Ingresar la fecha en la que realizo la Transferencia o Deposito",
                date : "El Formato debe Ser de Fecha"
            },
            adjunto : {
                required : "Debe subir una imagen"
            },
            options : {
                required : "Debe Seleccionar Si o No"
            },
            /*if ($('#no').is(':checked')) {*/
                user_address : {
                    required : "Este Campo es Obligatorio, debe ingresar su nueva dirección"
                },
                estados : {
                    required : "Seleccione el estado"
                },
                municipios : {
                    required : "Seleccione el municipio"
                },
            /*}*/
        }
    });    
});
//left side accordion
$(function() {
    $('#nav-accordion').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
        classExpand: 'dcjq-current-parent'
    });

});
var Script = function () {

    //  menu auto scrolling

    /*jQuery('#sidebar .sub-menu > a').click(function () {
        var o = ($(this).offset());
        diff = 80 - o.top;
        if(diff>0)
            $("#sidebar").scrollTo("-="+Math.abs(diff),500);
        else
            $("#sidebar").scrollTo("+="+Math.abs(diff),500);
    });*/

    // toggle bar

    $(function() {
        var wd;
        wd = $(window).width();
        function responsiveView() {
            var newd = $(window).width();
            if(newd==wd){
                return true;
            }else{
                wd = newd;
            }
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#sidebar').addClass('hide-left-bar');

            }
        else{
                $('#sidebar').removeClass('hide-left-bar');
            }

        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);




    });

    $('.sidebar-toggle-box .fa-bars').click(function (e) {
        $('#sidebar').toggleClass('hide-left-bar');
        $('#main-content').toggleClass('merge-left');
        e.stopPropagation();
        if( $('#container').hasClass('open-right-panel')){
            $('#container').removeClass('open-right-panel')
        }
        if( $('.right-sidebar').hasClass('open-right-bar')){
            $('.right-sidebar').removeClass('open-right-bar')
        }

        if( $('.header').hasClass('merge-header')){
            $('.header').removeClass('merge-header')
        }



    });
    $('.toggle-right-box .fa-bars').click(function (e) {
        $('#container').toggleClass('open-right-panel');
        $('.right-sidebar').toggleClass('open-right-bar');
        $('.header').toggleClass('merge-header');

        e.stopPropagation();
    });

    $('.header,#main-content,#sidebar').click(function () {
       if( $('#container').hasClass('open-right-panel')){
           $('#container').removeClass('open-right-panel')
       }
        if( $('.right-sidebar').hasClass('open-right-bar')){
            $('.right-sidebar').removeClass('open-right-bar')
        }

        if( $('.header').hasClass('merge-header')){
            $('.header').removeClass('merge-header')
        }


    });


   // custom scroll bar
    $("#sidebar").niceScroll({styler:"fb",cursorcolor:"#1FB5AD", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled:false, cursorborder: ''});
    $(".right-sidebar").niceScroll({styler:"fb",cursorcolor:"#1FB5AD", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled:false, cursorborder: ''});


   // widget tools

    jQuery('.panel .tools .fa-chevron-down').click(function () {
        var el = jQuery(this).parents(".panel").children(".panel-body");
        if (jQuery(this).hasClass("fa-chevron-down")) {
            jQuery(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.panel .tools .fa-times').click(function () {
        jQuery(this).parents(".panel").parent().remove();
    });

   // tool tips

    $('.tooltips').tooltip();

    // popovers

    $('.popovers').popover();

    /*==Collapsible==*/
    $(function() {
        $('.widget-head').click(function(e)
        {
            var widgetElem = $(this).children('.widget-collapse').children('i');

            $(this)
                .next('.widget-container')
                .slideToggle('slow');
            if ($(widgetElem).hasClass('ico-minus')) {
                $(widgetElem).removeClass('ico-minus');
                $(widgetElem).addClass('ico-plus');
            }
            else
            {
                $(widgetElem).removeClass('ico-plus');
                $(widgetElem).addClass('ico-minus');
            }
            e.preventDefault();
        });

    });
}();
